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

        
            {{--あとで解読
            <p><strong>特徴：</strong>{{ implode('、', $hospital->features ?? []) }}</p>
            <p><strong>治療法：</strong>{{ implode('、', $hospital->treatments ?? []) }}</p>
            --}}

</body>
</html>