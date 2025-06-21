<x-app-layout>
    <!--　固定ヘッダー -->
    <div class="w-full fixed top-0 left-0 z-50 px-8 py-4 bg-white shadow-md flex justify-between items-center">
        <a href="{{ route('hospital.index') }}" class="text-base text-gray-800 font-bold hover:underline">
            精神科評価サイト
        </a>
        <a href="{{ route('admin.login.form') }}" class="text-base text-gray-800 font-bold hover:underline">
            管理者ログイン
        </a>
    </div>

    <div class="pt-28 pb-16 text-center bg-brand-500/50 border-b border-white rounded-lg">
        <p class="text-[32px] text-gray-800 font-semibold">検索結果</p>
        <p class="text-base text-gray-600 py-2">{{ $resultCount }}件の医療機関が見つかりました。</p>
    </div>


    <section
        class="max-w-screen text-center py-12  py-12 px-4 bg-brand-500/50 border-b border-white w-full">
        <h2 class="text-[32px] font-semibold text-gray-800 mb-4 mx-auto">病院を探す</h2>
        <p class="text-base text-gray-600 mb-6">
            条件を選んで、あなたに合った精神科・心療内科を検索しましょう。
        </p>
        <form method="GET" action="{{ route('hospital.result') }}"
            class="border-none p-4 flex flex-wrap justify-center gap-4 mb-6">
            <select name="specialty_id" class="border rounded px-4 py-2">
                <option value="">専門外来</option>
                @foreach ($specialties as $specialty)
                    <option value="{{ $specialty->id }}"
                        {{ request('specialty_id') == $specialty->id ? 'selected' : '' }}>{{ $specialty->name }}
                    </option>
                @endforeach
            </select>
            <select name="disorder_id" class="border rounded px-4 py-2">
                <option value="">疾患</option>
                @foreach ($disorders as $disorder)
                    <option value="{{ $disorder->id }}" {{ request('disorder_id') == $disorder->id ? 'selected' : '' }}>
                        {{ $disorder->name }}</option>
                @endforeach
            </select>

            <select name="prefecture" class="border rounded px-4 py-2 w-48">
                <option value="">都道府県</option>
                @foreach ($prefectures as $pref)
                    <option value="{{ $pref }}" {{ request('prefecture') == $pref ? 'selected' : '' }}>
                        {{ $pref }}</option>
                @endforeach
            </select>
            <button type="submit"
                class="bg-green-600 text-white text-base px-6 py-2 rounded hover:bg-green-700">検索</button>
        </form>
    </section>


    <div class="bg-brand-500/50 py-6 sm:py-8 lg:py-12">
        <div class="mx-auto max-w-screen-2xl px-4 md:px-8">

            <div class="pb-12 text-center">
                <h2 class="text-[32px] font-semibold text-gray-800 lg:text-3xl">病院一覧</h2>
                @if ($hospitals->isEmpty())
                    <p class="text-red-500 font-bold">該当する病院は見つかりませんでした。</p>
                @endif
            </div>

            <div class="grid gap-x-4 gap-y-8 sm:grid-cols-2 md:gap-x-6 lg:grid-cols-2 xl:grid-cols-3">
                @foreach ($hospitals as $hospital)
                    <div>
                        <a href="{{ route('hospital.show', $hospital->id) }}"
                            class="group relative mb-2 block h-64 overflow-hidden rounded-lg bg-gray-100 lg:mb-3">
                            <img src="https://picsum.photos/seed/{{ uniqid() }}/{{ rand(400, 800) }}/{{ rand(300, 600) }}"
                                alt="{{ $hospital->name }}"
                                class="h-full w-full object-cover object-center transition duration-200 group-hover:scale-105" />
                        </a>
                        <div>
                            <h3 class="text-2xl font-medium text-gray-800 mb-2">{{ $hospital->name }}</h3>
                            <p class="text-base text-gray-600 mb-2"><strong>所在地：</strong>{{ $hospital->address }}</p>
                            <p class="text-base text-gray-600 mb-2">
                                <strong>診療時間：</strong>{{ $hospital->am_display }} {{ $hospital->pm_display }}
                            </p>
                            <p class="text-base text-gray-600">
                                <strong>対象疾患：</strong>
                                @foreach ($hospital->disorders as $disorder)
                                    {{ $disorder->name }}{{ !$loop->last ? '、' : '' }}
                                @endforeach
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    <div class="bg-brand-500/50 py-10 flex justify-center">
        {{ $hospitals->appends(request()->query())->links('vendor.pagination.tailwind') }}
    </div>

    <footer class="bg-white py-16">
  <div class="max-w-3xl mx-auto text-center px-6">

    <!-- キャッチコピー -->
    <h2 class="text-2xl font-bold mb-2">あなたに合った精神科を</h2>
    <p class="text-base mb-6">
      精神科評価サイトは、全国の医療機関を比較しながら、<br>
      自分に合った病院を見つけられるサービスです。
    </p>

    <!-- このサイトについて -->
    <div class="text-base mb-10 leading-relaxed">
      <p>本サービスは、精神科を受診しようと考えている方が</p>
      <p>病院の特徴や雰囲気をあらかじめ知ることで、</p>
      <p>自分に合った医療機関を選ぶ手助けを目的としています。</p>
    </div>

   <div class="flex flex-wrap justify-center gap-6 text-base my-10">
  <a href="#features" class="hover:underline">特徴</a>
  <a href="#search" class="hover:underline">病院検索</a>
  <a href="#" class="hover:underline">プライバシーポリシー</a>
  <a href="#" class="hover:underline">利用規約</a>
</div>

    <!-- 注意事項 -->
    <div class="text-base mt-10 border-t border-gray-700 pt-4">
      <p class="mt-1 text-red-400">✳︎本サイトはポートフォリオ提出を目的として制作されたものであり、<br>
        掲載されている病院情報はすべて架空のデータです。
    </div>

  </div>
</footer>
    
    <div class="bg-brand-500/50 text-center py-6">
        <a href="{{ route('hospital.index') }}" class="text-base tetext-gray-800 font-bold hover:underline">
            精神科評価サイト
        </a>
    </div>
    
    </footer>
</x-app-layout>
