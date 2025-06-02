<x-app-layout>
    <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-800">精神科評価サイト</h2>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="text-xl font-bold text-gray-600 underline hover:text-blue-600">管理者ログアウト</button>
                </form>
            </div>
    </x-slot>


    <div class="bg-blue-200 min-h-screen py-6 px-8">
        <!--検索フォーム-->
        <div class="w-full flex justify-center mb-6">
            <form method="GET" action="{{ route('admin.hospitals.index') }}" class="flex gap-4 mb-6">
                <select name="prefecture" class="border rounded px-4 py-1 w-40">
                    <option value="">都道府県</option>
                    @foreach ($prefectures as $pref)
                        <option value="{{ $pref }}" {{ request('prefecture') == $pref ? 'selected' : '' }}>{{ $pref }}</option>
                    @endforeach
                </select>
                <select name="disorder_id" class="border rounded px-2 py-1">
                    <option value="">疾患</option>
                    @foreach ($disorders as $disorder)
                        <option value="{{ $disorder->id }}" {{ request('disorder_id') == $disorder->id ? 'selected' : '' }}>{{ $disorder->name }}</option>
                    @endforeach
                </select>
                <select name="specialty_id" class="border rounded px-2 py-1">
                    <option value="">専門外来</option>
                    @foreach ($specialties as $specialty)
                        <option value="{{ $specialty->id }}" {{ request('specialty_id') == $specialty->id ? 'selected' : '' }}>{{ $specialty->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded">検索</button>
            </form>
        </div>
        <div class="mb-6">
            <a href="{{ route('admin.hospitals.create') }}" class="block bg-orange-400 text-white text-center py-2 rounded">病院を登録する</a>
        </div>

        <!-- ページネーション（上部）
        <div class="flex justify-center my-4">
            {{ $hospitals->links('vendor.pagination.tailwind') }}
        </div>
         -->

        <!-- 病院一覧テーブル -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded shadow">
                <thead class="bg-gray-200 text-gray-700">
                    <tr>
                        <th class="px-4 py-2">選択</th>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">病院名</th>
                        <th class="px-4 py-2">編集</th>
                        <th class="px-4 py-2">削除</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hospitals as $hospital)
                        <tr class="text-center border-b">
                            <td class="px-4 py-2">
                                <input type="checkbox" name="hospital_ids[]" value="{{ $hospital->id }}">
                            </td>
                            <td class="px-4 py-2">{{ $hospital->id }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('admin.hospitals.show', $hospital->id) }}" class="text-blue-600 underline">
                                    {{ $hospital->name }}
                                </a>
                            </td>
                            <td class="px-4 py-2">
                                <a href="{{ route('admin.hospitals.edit', $hospital->id) }}">✏️</a>
                            </td>
                            <td class="px-4 py-2">
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

        <!-- ページネーション（下部） -->
        <div class="flex justify-center my-4">
            {{ $hospitals->links('vendor.pagination.tailwind') }}
        </div>
    </div>
    <footer class="bg-blue-100 text-center py-4">
        <a href="{{ route('admin.hospitals.index') }}" class="text-gray-800 font-bold hover:underline">
            精神科評価サイト
        </a>
    </footer>
</x-app-layout>
<!--
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>管理者画面 - 病院一覧</title>
    <style>
        body { background-color: #e0f0ff; font-family: sans-serif; }
        header, footer { background-color: #cce0ff; padding: 1rem; text-align: center; }
        .site-title {font-weight: bold; font-size: 1.1rem}
        .logout-link a {text-decoration: none; color: #000; font-size: 0.95rem;}
        .logout-link a:hover {text-decoration: underline}
        .custom-header {display: flex; justify-content:  space-between; align-items: center;background-color: #cce0ff; padding: 1rem 2rem }
        .custom-footer {background-color: #cce0ff; text-align: center; padding: 1rem}
        .custom-footer a  {color: #000; text-decoration: none; font-weight: bold}
        .custom-footer a:hover {text-decoration: underline}
        .container { padding: 2rem; }
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th, td { border: 1px solid #666; padding: 0.5rem; text-align: center; }
        .actions { display: flex; justify-content: center; gap: 0.5rem; }
        button, select { padding: 0.4rem 0.8rem; margin-top: 0.5rem; }
        .search-bar { margin-bottom: 1rem; }
        .register-btn { background-color: orange; padding: 0.5rem 1rem; margin: 1rem 0; display: block; }
        .pagination { margin-top: 1rem; text-align: center; }
    </style>
</head>
<body>
    <h1 class="text-3xl font-bold text-red-500">
</h1>
    <header class="custom-header">
        <div class="site-title">精神科評価サイト</div>
        <div class="logout-link">
            <a href="">管理者ログアウト</a>{{--ルート設定を行う必要あり--}}
        </div>
    </header>

    <div class="container">
        <h3>病院検索フォーム</h3>
        {{--
        <form method="GET" action="{{ route('admin.hospitals.index') }}" class="search-bar">
            <label>都道府県：
                <select name="prefecture">
                    <option value="">すべて</option>
                    @foreach ($prefectures as $pref)
                        <option value="{{ $pref }}" {{ request('prefecture') == $pref ? 'selected' : '' }}>{{ $pref }}</option>
                    @endforeach
                </select>
            </label>

            <label>疾患：
                <select name="disorder_id">
                    <option value="">すべて</option>
                    @foreach ($disorders as $disorder)
                        <option value="{{ $disorder->id }}">{{ $disorder->name }}</option>
                    @endforeach
                </select>
            </label>

            <label>専門外来：
                <select name="specialty_id">
                    <option value="">すべて</option>
                    @foreach ($specialties as $specialty)
                        <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                    @endforeach
                </select>
            </label>

            <button type="submit">検索</button>
        </form>

        <a href="{{ route('admin.hospitals.create') }}" class="register-btn">病院を登録する</a>

        <p>{{ $hospitals->total() }}件中 {{ $hospitals->firstItem() }}〜{{ $hospitals->lastItem() }}件を表示</p>
        <div class="pagination">
    {{ $hospitals->links('vendor.pagination.tailwind') }}
</div>>
        

        <table>
            <thead>
                <tr>
                    <th><input type="checkbox"></th>
                    <th>ID</th>
                    <th>病院名</th>
                    <th>編集</th>
                    <th>削除</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hospitals as $hospital)
                    <tr>
                        <td><input type="checkbox" name="hospital_ids[]" value="{{ $hospital->id }}"></td>
                            <td>{{ $hospital->id }}</td>
                            <td>
                                <a href="{{ route('admin.hospitals.show', $hospital->id) }}">
                                    {{ $hospital->name }}
                                </a>
                            </td>
                        <td>
                            <a href="{{ route('admin.hospitals.edit', $hospital->id) }}">✏️</a>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('admin.hospitals.destroy', $hospital->id) }}"
                                onsubmit="return confirm('本当に削除しますか？');">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn-delete">🗑️ 削除</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        
    </div>

    <footer class="custom-footer">
        <a href="{{ route('admin.hospitals.index') }}">精神科評価サイト</a>
    </footer>
</body>
</html>
--}}
-->