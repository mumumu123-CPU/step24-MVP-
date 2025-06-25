<x-app-layout>
    <!--　固定ヘッダー -->
    <div class="w-full fixed top-0 left-0 z-50 px-8 py-4 bg-white shadow-md flex justify-between items-center">
        <a href="{{ route('admin.hospitals.index') }}"
            class="text-base font-bold text-gray-800 hover:underline">精神科評価サイト</a>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="text-base font-bold text-gray-800 hover:underline">管理者ログアウト</button>
        </form>
    </div>


    <div class="py-28 pb-14 text-center bg-blue-soft-100/80 rounded-lg">
        <p class="text-[32px] text-gray-800 font-semibold">医療機関の詳細情報</p>
    </div>


    <div class="bg-blue-soft-100/80 pb-20">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white bg-transparent shadow rounded-lg p-6 mb-6">
                <div class="flex lg:flex-row gap-6">
                    <!-- 左側 -->
                    <div class="lg:w-1/2 space-y-10">
                        <!--編集・削除ボタン-->
                        <div class="flex gap-4">
                            <a href="{{ route('admin.hospitals.edit', $hospital->id) }}"
                                class="bg-yellow-400 hover:bg-yellow-500 text-black font-bold py-2 px-4 rounded">✏
                                編集</a>
                            <form method="POST" action="{{ route('admin.hospitals.destroy', $hospital->id) }}"
                                onsubmit="return confirm('本当に削除しますか？');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">🗑
                                    削除</button>
                            </form>
                        </div>
                        <h1 class="text-[32px] font-bold text-center text-gray-800 my-6">{{ $hospital->name }}</h1>
                        <!--ダミー画像。画像のサイズを固定。はみ出た部分は表示しない。-->
                        <div
                            class="group bg-gray-200 w-[500px] h-[400px] flex items-center justify-center mx-auto overflow-hidden rounded">
                            <img src="{{ asset('assets/images2/' . $randomImage) }}"
                                class="h-full w-full object-cover object-center transition duration-200 group-hover:scale-105" />
                        </div>
                        <div>
                            <p class="text-2xl font-bold mb-4 text-center">診療時間</p>
                            <table class="table-auto w-[500px] text-center border border-gray-400 mx-auto">
                                <thead class="bg-blue-100">
                                    <tr>
                                        <th></th>
                                        @foreach (['月', '火', '水', '木', '金', '土', '日', '祝'] as $day)
                                            <th>{{ $day }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                     @if (!empty($hospital->am_open))
                                        <tr>
                                            <td>{{ $hospital->am_open }}</td>
                                            @foreach (['月', '火', '水', '木', '金', '土', '日', '祝'] as $day)
                                                <td>{{ str_contains($hospital->day_of_week, $day) ? '●' : '-' }}</td>
                                            @endforeach
                                        </tr>
                                    @endif

                                    @if (!empty($hospital->pm_open))
                                        <tr>
                                            <td>{{ $hospital->pm_open }}</td>
                                            @foreach (['月', '火', '水', '木', '金', '土', '日', '祝'] as $day)
                                                <td>{{ str_contains($hospital->day_of_week, $day) ? '●' : '-' }}</td>
                                            @endforeach
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <div class="bg-gray-200 w-[500px] h-[400px] flex items-center justify-center mx-auto">
                            <iframe class=""
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7133.418955402901!2d139.76447358931546!3d35.68110313679508!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188bfbd89f700b%3A0x277c49ba34ed38!2z5p2x5Lqs6aeF!5e0!3m2!1sja!2sjp!4v1748863094072!5m2!1sja!2sjp"
                                width="500" height="400" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>

                    <!-- 右側。ここの箇所のみ8の倍数以外を使用しています。８の倍数だと大きすぎたり、小さすぎたりといい塩梅のサイズ感にならなかったためです。 -->
                    <div class="lg:w-1/2 space-y-6 text-base text-gray-700 mt-16">
                        <p class="text-lg"><span class="font-semibold text-lg">病院名：</span>{{ $hospital->name }}</p>
                        <p class="text-lg"><span class="font-semibold text-lg">所在地：</span>{{ $hospital->address }}</p>
                        <p class="text-lg"><span class="font-semibold text-lg">最寄駅：</span>{{ $hospital->station }}</p>
                        <p class="text-lg"><span class="font-semibold text-lg">電話番号：</span>{{ $hospital->phone }}</p>
                        <p class="text-lg"><span class="font-semibold text-lg">HP：</span>{{ $hospital->homepage_url }}
                        </p>
                        <p class="text-lg"><span
                                class="font-semibold text-lg">専門外来：</span>{{ $hospital->specialties->pluck('name')->join('、') }}
                        </p>
                        <p class="text-lg"><span
                                class="font-semibold text-lg">対象疾患：</span>{{ $hospital->disorders->pluck('name')->join('、') }}
                        </p>
                        <p class="text-lg"><span class="font-semibold text-lg">治療法：</span>{{ $hospital->treatment }}
                        </p>
                        <p class="text-lg"><span class="font-semibold text-lg">特徴：</span>{{ $hospital->feature }}</p>
                        <p class="text-lg"><span
                                class="font-semibold text-lg">口コミ平均：</span>★{{ number_format($hospital->reviews->avg('rating'), 1) }}（{{ $hospital->reviews->count() }}件）
                        </p>

                        @foreach ($hospital->reviews as $review)
                            <div class="bg-gray-100 border border-gray-300 p-2 rounded">
                                <p>★{{ $review->rating }}</p>
                                <p>{{ $review->comment }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-blue-soft-100/80 pb-16 flex justify-center">
        <a href="{{ route('admin.hospitals.index') }}" class="px-10 py-4 bg-white font-semibold rounded shadow hover:bg-gray-200 transition">
            戻る
        </a>
    </div>

 <section class="bg-white py-16">
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
  <a href="{{ route('hospital.index') }}#features" class="hover:underline">特徴</a>
  <a href="{{ route('hospital.index') }}#search" class="hover:underline">病院検索</a>
  <a href="#" class="hover:underline">プライバシーポリシー</a>
  <a href="#" class="hover:underline">利用規約</a>
</div>

    <!-- 注意事項 -->
    <div class="text-base mt-10 border-t border-gray-700 pt-4">
      <p class="mt-1 text-red-400">✳︎本サイトはポートフォリオ提出を目的として制作されたものであり、<br>
        掲載されている病院情報はすべて架空のデータです。
    </div>

  </div>
</section>
    
    <footer class="bg-blue-soft-100/80 text-center py-6">
        <a href="{{ route('admin.hospitals.index') }}" class="text-base tetext-gray-800 font-bold hover:underline">
            精神科評価サイト
        </a>
    </footer>

</x-app-layout>
