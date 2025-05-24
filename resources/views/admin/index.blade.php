<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>管理者画面 - 病院一覧</title>
    <style>
        body { background-color: #e0f0ff; font-family: sans-serif; }
        header, footer { background-color: #cce0ff; padding: 1rem; text-align: center; }
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
    <header>
        <h2>精神科評価サイト</h2>
        <div style="text-align: right;"><a href="{{ route('logout') }}">管理者ログアウト</a></div> {{--ログアウト後の処理を書かないといけない--}}
    </header>

    <div class="container">
        <h3>病院検索フォーム</h3>
        <form method="GET" action="{{ route('admin.hospitals.index') }}" class="search-bar">
            <label>都道府県：
                <select name="prefecture">
                    <option value="">すべて</option>
                    @foreach ($prefectures as $pref)
                        <option value="{{ $pref }}">{{ $pref }}</option>
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

        <div>
            <p>50件（1〜20件）表示</p>
            <p>&lt;&lt;前 1 2 3 4 5...次&gt;&gt;</p>
        </div>

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

        <div class="pagination">
            {{ $hospitals->links() }}
        </div>
    </div>

    <footer>
        <p>精神科評価サイト</p>
    </footer>
</body>
</html>