<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
        <a href="{{ route('hospital.index') }}" class="text-lg text-gray-800 font-bold hover:underline">精神科評価サイト</a>
        <a href="{{ route('admin.login.form') }}" class="text-lg text-gray-700 font-bold hover:underline">管理者ログイン</a>
        </div>
    </x-slot>

    <div class="bg-green-100 bg-opacity-50 py-12 min-h-screen">
        <div class="max-w-full mx-auto px-4">
        <div class="relative overflow-hidden bg-green-800 bg-opacity-40 p-6 rounded mb-6 shadow min-h-[700px]">
            <!--背景動画-->
            <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover z-0">
            <source src="{{ asset('assets/hero2.mp4') }}" type="video/mp4"></video>

            <!--前面のテキスト（動画の上に表示）-->
            <div class="relative z-10 flex items-center justify-center h-full">
            <h1 class="text-5xl font-bold text-white text-center">病院の詳細情報</h1>
            </div>
        </div>
    </div>

    <div class="bg-green-100 min-h-screen py-10 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white shadow rounded-lg p-6 mb-6">
                <div class="flex lg:flex-row gap-6">
                    <!-- 左側 -->
                    <div class="lg:w-1/2 space-y-6">
                        <h1 class="text-2xl font-bold text-center text-gray-800 my-6">{{ $hospital->name }}</h1>
                        <!--ダミー画像。画像のサイズを固定。はみ出た部分は表示しない。-->
                        <div class="bg-gray-200 w-[500px] h-[300px] flex items-center justify-center mx-auto overflow-hidden rounded">
                            <img src="https://picsum.photos/seed/{{ uniqid() }}/{{ rand(400, 800) }}/{{ rand(300, 600) }}" class="object-cover w-full h-full"/></div>
                        <div>
                            <p class="font-semibold mb-2 text-center">診療時間</p>
                            <table class="table-auto w-[500px] text-center border border-gray-400 mx-auto">
                                <thead class="bg-blue-100">
                                    <tr>
                                        <th></th>
                                        @foreach (["月","火","水","木","金","土","日","祝"] as $day)
                                            <th>{{ $day }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $hospital->am_open }}</td>
                                        @foreach (["月","火","水","木","金","土","日","祝"] as $day)
                                            <td>{{ str_contains($hospital->day_of_week, $day) ? '●' : '-' }}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>{{ $hospital->pm_open }}</td>
                                        @foreach (["月","火","水","木","金","土","日","祝"] as $day)
                                            <td>{{ str_contains($hospital->day_of_week, $day) ? '●' : '-' }}</td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="bg-gray-200 w-[500px] h-[400px] flex items-center justify-center mx-auto">
                            <iframe class="" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7133.418955402901!2d139.76447358931546!3d35.68110313679508!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188bfbd89f700b%3A0x277c49ba34ed38!2z5p2x5Lqs6aeF!5e0!3m2!1sja!2sjp!4v1748863094072!5m2!1sja!2sjp" width="500" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>

                    <!-- 右側 -->
                    <div class="lg:w-1/2 space-y-4 text-sm text-gray-700 mt-16">
                        <p class="text-lg"><span class="text-lg font-semibold">病院名：</span>{{ $hospital->name }}</p>
                        <p class="text-lg"><span class="font-semibold text-lg">所在地：</span>{{ $hospital->address }}</p>
                        <p class="text-lg"><span class="font-semibold text-lg">最寄駅：</span>{{ $hospital->station }}</p>
                        <p class="text-lg"><span class="font-semibold text-lg">電話番号：</span>{{ $hospital->phone }}</p>
                        <p class="text-lg"><span class="font-semibold text-lg">HP：</span>{{ $hospital->homepage_url }}</p>
                        <p class="text-lg"><span class="font-semibold text-lg">専門外来：</span>{{ $hospital->specialties->pluck('name')->join('、') }}</p>
                        <p class="text-lg"><span class="font-semibold text-lg">対象疾患：</span>{{ $hospital->disorders->pluck('name')->join('、') }}</p>
                        <p class="text-lg"><span class="font-semibold text-lg">治療法：</span>{{ $hospital->treatment }}</p>
                        <p class="text-lg"><span class="font-semibold text-lg">特徴：</span>{{ $hospital->feature }}</p>
                        <p class="text-lg"><span class="font-semibold text-lg">口コミ平均：</span>★{{ number_format($hospital->reviews->avg('rating'), 1) }}（{{ $hospital->reviews->count() }}件）</p>

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

    <footer class="text-center py-4">
         <a href="{{ route('hospital.index') }}" class="text-2xl text-gray-800 font-bold hover:underline">
            精神科評価サイト
        </a>
    </footer>
</x-app-layout>