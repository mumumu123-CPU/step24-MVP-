<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>{{ $hospital->name }}｜詳細情報</title>
</head>
<body>
    <h1>{{ $hospital->name }}（詳細情報）</h1>

    <p><strong>所在地：</strong>{{ $hospital->address }}</p>
    <p><strong>最寄駅：</strong>{{ $hospital->station }}</p>
    <p><strong>診療時間：</strong>AM {{ $hospital->am_open }} ／ PM {{ $hospital->pm_open }}</p>
    <p><strong>診療日：</strong>{{ $hospital->day_of_week }}</p>

    <p><strong>対象疾患：</strong>
        @foreach ($hospital->disorders as $disorder)
            {{ $disorder->name }}{{ !$loop->last ? '、' : '' }}
        @endforeach
    </p>

    <p><strong>専門外来：</strong>
        @foreach ($hospital->specialties as $specialty)
            {{ $specialty->name }}{{ !$loop->last ? '、' : '' }}
        @endforeach
    </p>

    <p><strong>特徴：</strong>{{ implode('、', explode(', ', $hospital->feature)) }}</p>
    <p><strong>治療法：</strong>{{ implode('、', explode(', ', $hospital->treatment)) }}</p>

    <p><strong>ホームページ：</strong><a href="{{ $hospital->homepage_url }}" target="_blank">{{ $hospital->homepage_url }}</a></p>
    <p><strong>地図URL：</strong><a href="{{ $hospital->map_url }}" target="_blank">地図を開く</a></p>

    <hr>

    <h2>口コミ</h2>
    @foreach ($hospital->reviews as $review)
        <p>★{{ $review->rating }}：{{ $review->comment }}</p>
    @endforeach

    <a href="{{ route('hospital.index') }}">← 一覧に戻る</a>
</body>
</html>