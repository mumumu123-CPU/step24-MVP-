<x-app-layout>

 <!-- ✅ 固定ヘッダー（手動で配置） -->
  <div class="w-full fixed top-0 left-0 z-50 px-8 py-6 bg-transparent flex justify-end items-center">
    <a href="{{ route('admin.login.form') }}" class="text-lg font-bold hover:underline">
      管理者ログイン
    </a>
  </div>

  <!--　ヒーロー　-->
  <section class="relative bg-brand-500 min-h-screen text-white overflow-hidden">
    
    <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover z-0">
          <source src="{{ asset('assets/videos/hero3.mp4') }}" type="video/mp4">
    </video>
    <!-- 中央のテキスト -->
    <div class="relative z-10 flex flex-col items-center justify-start text-center px-4 pt-24">
      <p class="text-4xl font-extrabold mb-2">あなたに合った精神科を</p>
      <h1 class="text-6xl font-extrabold mb-2">精神科評価サイト</h1>
      
    </div>

  </section>

<div class="max-w-7xl mx-auto px-4 pt-16 mt-6">
  <div class="grid grid-cols-1 md:grid-cols-2 gap-x-24 items-center md:items-start py-16 my-6">
    
    <!-- 左：画像 -->
    <div>
      <img src="{{ asset('assets/images/image5.jpg') }}" alt="相談中の様子" class="rounded-xl w-full h-auto object-cover">
    </div>

   <!-- 右：テキスト -->
    <div class="text-gray-800 space-y-7 leading-loose text-2xl">

      <h2 class="text-4xl font-bold tracking-wide">
        精神的な不調を感じたとき、<br >
        「どの病院が自分に合うんだろう…？」<br>
        と悩む方は多いはず。
      </h2>

      <p>
        このサイトは、専門外来・対象疾患・地域から、<br>
        あなたに合った精神科・心療内科をスムーズに探せる検索サービスです。
      </p>

      <p>
        「どこに相談すればいいか分からない」<br>
        そんな不安を減らし、あなたが安心して一歩を踏み出せるようにサポートします。
      </p>

      <p>
        口コミや診療時間など、<br>
        気になる情報もひと目で確認できます。
      </p>

    </div>

  </div>
</div>

<!--　特徴カード　-->
<div class="bg-white rounded-lg shadow-lg p-8 mt-12 max-w-5xl mx-auto my-20 py-6">
  <h3 class="text-2xl font-bold text-gray-800 mb-6 text-center">このサイトの特徴</h3>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-gray-700 text-center">
    
    <!-- カード1 -->
    <div class="p-4 border rounded-lg hover:shadow transition">
      <div class="text-4xl mb-2">🔍</div>
      <h4 class="font-semibold text-xl mb-2">検索しやすい</h4>
      <p class="text-sm">専門外来・症状・地域などから、簡単に条件を絞り込めます。</p>
    </div>

    <!-- カード2 -->
    <div class="p-4 border rounded-lg hover:shadow transition">
      <div class="text-4xl mb-2">🗣️</div>
      <h4 class="font-semibold text-xl mb-2">リアルな口コミ</h4>
      <p class="text-sm">実際に受診した人の声を参考に、安心して選べます。</p>
    </div>

    <!-- カード3 -->
    <div class="p-4 border rounded-lg hover:shadow transition">
      <div class="text-4xl mb-2">⏰</div>
      <h4 class="font-semibold text-xl mb-2">情報が豊富</h4>
      <p class="text-sm">診療時間や予約の有無など、必要な情報を一目で確認できます。</p>
    </div>

  </div>
</div>


<!--
<div class="bg-white py-6 sm:py-8 lg:py-12">
  <div class="mx-auto max-w-screen-xl px-4 md:px-8">
    <div class="grid gap-8 md:grid-cols-2 lg:gap-12">
      <div>
        <div class="h-64 overflow-hidden rounded-lg bg-gray-100 shadow-lg md:h-auto">
          <img src="{{ asset('assets/images/image5.jpg') }}" loading="lazy" alt="Photo by Martin Sanchez" class="h-full w-full object-cover object-center" />
        </div>
      </div>

      <div class="md:pt-8">
        <p class="text-center font-bold text-indigo-500 md:text-left">Who we are</p>

        <h1 class="mb-4 text-center text-2xl font-bold text-gray-800 sm:text-3xl md:mb-6 md:text-left">Our competitive advantage</h1>

        <p class="mb-6 text-gray-500 sm:text-lg md:mb-8">
          This is a section of some simple filler text, also known as placeholder text. It shares some characteristics of a real written text but is random or otherwise generated. It may be used to display a sample of fonts or generate text for testing. Filler text is dummy text which has no meaning however looks very similar to real text.<br /><br />

          This is a section of some simple filler text, also known as placeholder text. It shares some characteristics of a real written text but is <a href="#" class="text-indigo-500 underline transition duration-100 hover:text-indigo-600 active:text-indigo-700">random</a> or otherwise generated. It may be used to display a sample of fonts or generate text for testing. Filler text is dummy text which has no meaning however looks very similar to real text.
        </p>

        <h2 class="mb-2 text-center text-xl font-semibold text-gray-800 sm:text-2xl md:mb-4 md:text-left">About us</h2>

        <p class="mb-6 text-gray-500 sm:text-lg md:mb-8">This is a section of some simple filler text, also known as placeholder text. It shares some characteristics of a real written text but is random or otherwise generated. It may be used to display a sample of fonts or generate text for testing. Filler text is dummy text which has no meaning however looks very similar to real text.</p>
      </div>
    </div>
  </div>
</div>
-->



<section class="max-w-5xl mx-auto text-center my-12 px-4">
  <h2 class="text-3xl font-bold text-gray-800 mb-4">病院を探す</h2>
  <p class="text-lg text-gray-600 mb-6">
    条件を選んで、あなたに合った精神科・心療内科を検索しましょう。
  </p>
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
</section>

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
  
<footer class="text-center py-4">
  <a href="{{ route('hospital.index') }}" class="text-2xl tetext-gray-800 font-bold hover:underline">
    精神科評価サイト
  </a>
</footer>
  
</x-app-layout>

