<x-app-layout>
    <!--　固定ヘッダー -->
    <header class="w-full fixed top-0 left-0 z-50 px-8 py-4 bg-white shadow-md flex justify-between items-center">
        <a href="{{ route('admin.hospitals.index') }}"
            class="text-base font-bold text-gray-800 hover:underline">精神科評価サイト</a>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="text-base font-bold text-gray-800 hover:underline">管理者ログアウト</button>
        </form>
    </header>

    <!--検索フォーム-->
    <section class="max-w-screen text-center py-12  pt-24 px-4 bg-blue-soft-100/80  w-full">
        <h2 class="text-3xl font-semibold text-gray-800 mb-4 mx-auto">管理者画面</h2>
        <form method="GET" action="{{ route('admin.hospitals.index') }}"
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
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">検索</button>
        </form>
    </section>



    <!-- 医療機関一覧 -->
    <div class="bg-blue-soft-100/80 pt-8 pb-6 px-4">

        <!-- 白枠カード部分 -->
        <div class="bg-white rounded-lg shadow-lg p-8 max-w-6xl mx-auto">

            <div class="mb-6">
                <a href="{{ route('admin.hospitals.create') }}"
                    class="block bg-orange2-100 text-white text-center py-2 rounded hover:bg-orange2-200">病院を登録する</a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded shadow">
                    <thead class="bg-gray-200 text-gray-700">
                        <tr class="text-center">
                            <th class="w-12 px-2 py-2">選択</th>
                            <th class="w-16 px-2 py-2">ID</th>
                            <th class="px-4 py-2 text-lg">病院名</th> <!-- ← 文字大きめ -->
                            <th class="w-16 px-2 py-2">編集</th>
                            <th class="w-16 px-2 py-2">削除</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hospitals as $hospital)
                            <tr class="text-center border-b">
                                <td class="w-12 px-2 py-2">
                                    <input type="checkbox" name="hospital_ids[]" value="{{ $hospital->id }}">
                                </td>
                                <td class="w-16 px-2 py-2">{{ $hospital->id }}</td>
                                <td class="px-4 py-2 text-base font-medium">
                                    <a href="{{ route('admin.hospitals.show', $hospital->id) }}"
                                        class="hover:text-blue-600">
                                        {{ $hospital->name }}
                                    </a>
                                </td>
                                <td class="w-16 px-2 py-2">
                                    <a href="{{ route('admin.hospitals.edit', $hospital->id) }}">✏️</a>
                                </td>
                                <td class="w-16 px-2 py-2">
                                    <form method="POST" action="{{ route('admin.hospitals.destroy', $hospital->id) }}"
                                        onsubmit="return confirm('本当に削除しますか？');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">🗑️</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>


    </div>

    <div class="bg-blue-soft-100/80 py-10 flex justify-center">
        {{ $hospitals->appends(request()->query())->links('vendor.pagination.tailwind') }}
    </div>

    <footer class="bg-white text-center py-6">
        <a href="{{ route('admin.hospitals.index') }}" class="text-base tetext-gray-800 font-bold hover:underline">
            精神科評価サイト
        </a>
    </footer>
</x-app-layout>
