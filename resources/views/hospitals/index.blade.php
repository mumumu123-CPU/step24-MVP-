<!DOCTYPE html>
<html lang="ja">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <title>精神科評価サイト</title>
    <style>
        body { background-color: #d1e7d5; font-family: sans-serif; }
        header, footer {
            background-color: #b0d0b0;
            padding: 10px;
            text-align: center;
            font-weight: bold;
        }
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            background: #f9fff9;
        }
        h2 {
            margin-top: 0;
            background: #ddd;
            padding: 10px;
        }
        form {
            margin: 20px 0;
            padding: 10px;
            background: #e0f5e0;
        }
        select, button {
            margin-right: 10px;
            padding: 5px;
        }
        .hospital-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
        .card {
            border: 1px solid #999;
            padding: 15px;
            background: white;
            border-radius: 5px;
        }
        .card h3 { margin: 0 0 10px; }
        .card p { margin: 5px 0; }
        .pagination {
            text-align: center;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <header>
        精神科評価サイト
    </header>

    <div class="container">
        <h2>検索結果</h2>

        <form method="GET" action="{{ route('hospital.index') }}">
            <select name="specialty_id">
                <option value="">専門外来</option>
                @foreach ($specialties as $specialty)
                    <option value="{{ $specialty->id }}" {{ request('specialty_id') == $specialty->id ? 'selected' : '' }}>{{ $specialty->name }}</option>
                @endforeach
            </select>
            <select name="disorder_id">
                <option value="">疾患</option>
                @foreach ($disorders as $disorder)
                    <option value="{{ $disorder->id }}" {{ request('disorder_id') == $disorder->id ? 'selected' : '' }}>{{ $disorder->name }}</option>
                @endforeach
            </select>
            <select name="prefecture">
                <option value="">都道府県</option>
                @foreach ($prefectures as $pref)
                    <option value="{{ $pref }}" {{ request('prefecture') == $pref ? 'selected' : '' }}>{{ $pref }}</option>
                @endforeach
            </select>
            <button type="submit">検索</button>
        </form>

        @if ($hospitals->isEmpty())
            <p style="color: red; font-weight: bold;">該当する病院は見つかりませんでした。</p>
        @endif

        <div class="hospital-grid">
            @foreach ($hospitals as $hospital)
                <div class="card">
                    <h3>{{ $hospital->name }}</h3>
                    <p><strong>所在地：</strong>{{ $hospital->address }}</p>
                    <p><strong>診療時間：</strong><br>AM：{{ $hospital->am_open }}<br>PM：{{ $hospital->pm_open }}</p>
                    <p><strong>対象疾患：</strong><br>
                        @foreach ($hospital->disorders as $disorder)
                            {{ $disorder->name }}{{ !$loop->last ? '、' : '' }}
                        @endforeach
                    </p>
                    <a href="{{ route('hospital.show', $hospital->id) }}">
                        <button>詳細はこちら</button>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="pagination justify-content-center mt-4">
            {{ $hospitals->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <footer>
        精神科評価サイト
    </footer>
</body>
</html>



{{--
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>精神科評価サイト</title>
</head>
<body>
    <!--検索フォーム-->
    <h2>病院検索フォーム</h2>

    <form method="GET" action="{{ route('hospital.index') }}">
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
                    <option value="{{ $disorder->id }}" {{ request('disorder_id') == $disorder->id ? 'selected' : '' }}>{{ $disorder->name }}</option>
                @endforeach
            </select>
        </label>
    
        <label>専門外来：
            <select name="specialty_id">
                <option value="">すべて</option>
                @foreach ($specialties as $specialty)
                    <option value="{{ $specialty->id }}" {{ request('specialty_id') == $specialty->id ? 'selected' : '' }}>{{ $specialty->name }}</option>
                @endforeach
            </select>
        </label>
    
        <button type="submit">検索する</button>
    </form>

    <!--病院を表示する-->
    <h1>病院一覧</h1>

    @if ($hospitals->isEmpty())
    <p style="color: red; font-weight: bold;">該当する病院は見つかりませんでした。</p>
    @endif

    @foreach ($hospitals as $hospital)
    <div style="border:1px solid #aaa; padding:10px; margin-bottom:15px;">
        <h2>{{ $hospital->name }}</h2>
        <p>住所：{{ $hospital->address }}</p>
        <p>診療時間：AM {{ $hospital->am_open }} / PM {{ $hospital->pm_open }}</p>

        <p>対象疾患：
            @foreach ($hospital->disorders as $disorder)
                {{ $disorder->name }}{{ !$loop->last ? '、' : '' }}
            @endforeach
        </p>

        <a href="{{ route('hospital.show', $hospital->id) }}">
            <button>詳細はこちら</button>
        </a>
    </div>
    @endforeach

</body>
</html>
--}}