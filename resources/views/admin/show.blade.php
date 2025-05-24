{{-- resources/views/admin/show.blade.php --}}
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>管理者用病院詳細ページ</title>
    <style>
        body { font-family: sans-serif; background: #e0edff; }
        .header, .footer {
            background: #b0d0ff; padding: 10px; text-align: center;
            font-weight: bold;
        }
        .container {
            width: 90%; max-width: 1000px; margin: 20px auto; background: #fff; padding: 20px;
        }
        h2 { text-align: center; background: #ddd; padding: 10px; margin-bottom: 20px; }
        .info-section { display: flex; justify-content: space-between; }
        .left, .right { width: 48%; }
        .img-box, .map-box {
            width: 100%; height: 150px; background: #eee; display: flex; align-items: center; justify-content: center;
            margin-bottom: 15px;
        }
        .btns { display: flex; flex-direction: column; gap: 10px; margin-bottom: 20px; }
        .btns a {
            text-align: center; padding: 10px; border-radius: 4px; text-decoration: none;
        }
        .btn-edit { background: #ffd700; color: #000; }
        .btn-delete {
                background: #ff8080;
                color: white;
                padding: 10px;
                border-radius: 4px;
                text-align: center;
                display: block;
                text-decoration: none;
                width: 100%;
        }

        .label { font-weight: bold; }
        .review { background: #f6f6f6; margin: 5px 0; padding: 5px; border: 1px solid #ccc; }

    </style>
</head>
<body>

<div class="header">精神科評価サイト｜管理者ログアウト</div>

<div class="container">
    <h2>病院の詳細情報</h2>

    <div class="btns">
        <a href="{{ route('admin.hospitals.edit', $hospital->id) }}" class="btn-edit">✏️ 編集</a>
        <form method="POST" action="{{ route('admin.hospitals.destroy', $hospital->id) }}"
            onsubmit="return confirm('本当に削除しますか？');">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn-delete">🗑️ 削除</button>
      </form>
        </form>
    </div>

    <div class="info-section">
        <div class="left">
            <div class="img-box">病院の画像</div>

            <div class="label">診療時間</div>
                <table border="1" cellspacing="0" cellpadding="5" style="border-collapse: collapse; text-align: center;">
                    <tr style="background-color: #e0f0ff;">
                        <th></th>
                        @foreach (['月','火','水','木','金','土','日','祝'] as $day)
                            <th>{{ $day }}</th>
                        @endforeach
                    </tr>
                    <tr>
                        <td>{{ $hospital->am_open }}</td>
                        @foreach (['月','火','水','木','金','土','日','祝'] as $day)
                            <td>{{ str_contains($hospital->day_of_week, $day) ? '●' : '-' }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>{{ $hospital->pm_open }}</td>
                        @foreach (['月','火','水','木','金','土','日','祝'] as $day)
                            <td>{{ str_contains($hospital->day_of_week, $day) ? '●' : '-' }}</td>
                        @endforeach
                    </tr>
                </table>

            <div class="map-box">地図</div>
        </div>

        <div class="right">
            <p><span class="label">病院名：</span> {{ $hospital->name }}</p>
            <p><span class="label">所在地：</span> {{ $hospital->address }}</p>
            <p><span class="label">最寄駅：</span> {{ $hospital->station }}</p>
            <p><span class="label">電話番号：</span> {{ $hospital->phone }}</p>
            <p><span class="label">HP：</span> {{ $hospital->homepage_url }}</p>
            <p><span class="label">専門外来：</span> {{ $hospital->specialties->pluck('name')->join('、') }}</p>
            <p><span class="label">対象疾患：</span> {{ $hospital->disorders->pluck('name')->join('、') }}</p>
            <p><span class="label">治療法：</span> {{ $hospital->treatment }}</p>
            <p><span class="label">特徴：</span> {{ $hospital->feature }}</p>
            <p><span class="label">口コミ平均：</span> ★{{ number_format($hospital->reviews->avg('rating'), 1) }}（{{ $hospital->reviews->count() }}件）</p>

            @foreach ($hospital->reviews as $review)
                <div class="review">★{{ $review->rating }}<br>{{ $review->comment }}</div>
            @endforeach
        </div>
    </div>
</div>

<div class="footer">精神科評価サイト</div>

</body>
</html>