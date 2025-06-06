<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between items-center">
      <a href="{{ route('hospital.index') }}" class="text-lg text-gray-800 font-bold hover:underline">精神科評価サイト</a>
      <a href="{{ route('admin.login.form') }}" class="text-lg text-gray-700 font-bold hover:underline">管理者ログイン</a>
    </div>
  </x-slot>


  <div class="bg-vanilla-haze bg-opacity-50 py-12 min-h-screen">
    <div class="max-w-full mx-auto px-4">
      <div class="relative overflow-hidden bg-green-800 bg-opacity-40 p-6 rounded mb-6 shadow min-h-[700px]">
        <!--背景動画-->
        <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover z-0">
          <source src="{{ asset('assets/hero2.mp4') }}" type="video/mp4"></video>

        <!--前面のテキスト（動画の上に表示）-->
        <div class="relative z-10 flex items-center justify-center h-full">
          <h1 class="text-5xl font-bold text-white text-center">
            あなたに合った<br>精神科を探しやすく。
          </h1>
        </div>
      </div>
    </div>

    <div class="bg-green-500  bg-opacity-30 p-6 rounded-lg shadow-md mb-6">
        <p class="text-center font-semibold text-gray-800 mb-2 text-4xl">
            精神的な不調を感じたとき、<br>
            「どの病院が自分に合うんだろう…？」と悩む方は多いはず。
        </p>
        <p class="text-center font-semibold text-gray-800 mb-2 leading-relaxed text-2xl">
            このサイトは、専門外来・対象疾患・地域から、あなたに合った精神科・心療内科をスムーズに探せる検索サービスです。
        </p>
        <p class="text-center font-semibold text-gray-900 mb-4 text-2xl">
            口コミや診療時間など、気になる情報もひと目で確認できます。
        </p>
            <div class="flex justify-center">
              <ul class="font-semibold list-disc list-outside text-2xl text-gray-700 pl-4">
                  <li>専門外来・症状・地域で簡単検索</li>
                  <li>実際の口コミもチェック可能</li>
                  <li>診療時間・予約の要否など詳細情報も掲載</li>
              </ul>
            </div>
    </div>

      <form method="GET" action="{{ route('hospital.result') }}" class="bg-white shadow rounded-lg p-4 flex flex-wrap justify-center gap-4 mb-6">
        <select name="specialty_id" class="border rounded px-4 py-2">
          <option value="">専門外来</option>
          @foreach ($specialties as $specialty)
            <option value="{{ $specialty->id }}" {{ request('specialty_id') == $specialty->id ? 'selected' : '' }}>{{ $specialty->name }}</option>
          @endforeach
        </select>
        <select name="disorder_id" class="border rounded px-4 py-2">
          <option value="">疾患</option>
          @foreach ($disorders as $disorder)
            <option value="{{ $disorder->id }}" {{ request('disorder_id') == $disorder->id ? 'selected' : '' }}>{{ $disorder->name }}</option>
          @endforeach
        </select>
        <select name="prefecture" class="border rounded px-4 py-2 w-48">
          <option value="">都道府県</option>
          @foreach ($prefectures as $pref)
            <option value="{{ $pref }}" {{ request('prefecture') == $pref ? 'selected' : '' }}>{{ $pref }}</option>
          @endforeach
        </select>
        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">検索</button>
      </form>

      @if ($hospitals->isEmpty())
        <p class="text-red-500 font-bold mb-6">該当する病院は見つかりませんでした。</p>
      @endif

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($hospitals as $hospital)
          <div class="bg-white rounded shadow p-4">
            <h3 class="text-lg font-bold mb-1">{{ $hospital->name }}</h3>
            <p class="text-sm text-gray-700 mb-1"><strong>所在地：</strong>{{ $hospital->address }}</p>
            <p class="text-sm text-gray-700 mb-1">
              <strong>診療時間：</strong>
              {{ $hospital->am_display }}
              {{ $hospital->pm_display }}
            </p>
            <p class="text-sm text-gray-700 mb-2">
              <strong>対象疾患：</strong>
              @foreach ($hospital->disorders as $disorder)
                {{ $disorder->name }}{{ !$loop->last ? '、' : '' }}
              @endforeach
            </p>
            <a href="{{ route('hospital.show', $hospital->id) }}" class="inline-block bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600 text-sm">詳細はこちら</a>
          </div>
        @endforeach
      </div>

      <div class="mt-6 flex justify-center">
        {{ $hospitals->links('vendor.pagination.tailwind') }}
      </div>
    </div>
  

  
    <footer class="text-center py-4">
        <a href="{{ route('hospital.index') }}" class="text-2xl tetext-gray-800 font-bold hover:underline">
            精神科評価サイト
        </a>
    </footer>
  
</x-app-layout>

