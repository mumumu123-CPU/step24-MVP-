<!-- resources/views/admin/edit.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            病院情報編集フォーム
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('admin.hospitals.update', $hospital->id) }}">
                        @csrf
                        @method('PUT')

                        <div>
                            <label>病院名：</label>
                            <input type="text" name="name" value="{{ $hospital->name }}" class="border rounded w-full">
                        </div>

                        <div class="mt-4">
                            <label>所在地：</label>
                            <input type="text" name="address" value="{{ $hospital->address }}" class="border rounded w-full">
                        </div>

                        <div class="mt-4">
                            <label>都道府県：</label>
                            <input type="text" name="prefecture" value="{{ $hospital->prefecture }}" class="border rounded w-full">
                        </div>

                        <div class="mt-4">
                            <label>最寄駅：</label>
                            <input type="text" name="station" value="{{ $hospital->station }}" class="border rounded w-full">
                        </div>

                        <div class="mt-4">
                            <label>診療日：</label>
                            <input type="text" name="day_of_week" value="{{ $hospital->day_of_week }}" class="border rounded w-full">
                        </div>

                        <div class="mt-4">
                            <label>午前診療時間：</label>
                            <input type="text" name="am_open" value="{{ $hospital->am_open }}" class="border rounded w-full">
                        </div>

                        <div class="mt-4">
                            <label>午後診療時間：</label>
                            <input type="text" name="pm_open" value="{{ $hospital->pm_open }}" class="border rounded w-full">
                        </div>

                        <div class="mt-4">
                            <label>特徴：</label>
                            <input type="text" name="feature" value="{{ $hospital->feature }}" class="border rounded w-full">
                        </div>

                        <div class="mt-4">
                            <label>治療法：</label>
                            <input type="text" name="treatment" value="{{ $hospital->treatment }}" class="border rounded w-full">
                        </div>

                        <div class="mt-4">
                            <label>HP URL：</label>
                            <input type="text" name="homepage_url" value="{{ $hospital->homepage_url }}" class="border rounded w-full">
                        </div>

                        <div class="mt-4">
                            <label>地図URL：</label>
                            <input type="text" name="map_url" value="{{ $hospital->map_url }}" class="border rounded w-full">
                        </div>

                        <div class="mt-4">
                            <label>電話番号：</label>
                            <input type="text" name="phone" value="{{ $hospital->phone }}" class="border rounded w-full">
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">更新する</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>




{{--
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>病院情報編集フォーム</title>
    <style>
        body {
            background-color: #f0f4ff;
            font-family: sans-serif;
        }
        .container {
            max-width: 600px;
            margin: 30px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
        }
        h2 {
            background: #ccc;
            padding: 10px;
            text-align: center;
        }
        label {
            display: block;
            margin-top: 15px;
        }
        input, select {
            width: 100%;
            padding: 6px;
            margin-top: 5px;
        }
        .btn {
            margin-top: 20px;
            text-align: center;
        }
        .btn button {
            background: orange;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>病院情報 編集フォーム</h2>
        <form method="POST" action="#">
            @csrf
            @method('PUT')

            <label>病院名</label>
            <input type="text" value="XXXX病院">

            <label>所在地</label>
            <input type="text" value="XXXX県XXXX市XXXX町1-2-3">

            <label>都道府県</label>
            <input type="text" value="XXXX県">

            <label>最寄駅</label>
            <input type="text" value="XXXX駅">

            <label>診療曜日</label>
            <input type="text" value="月火水木金">

            <label>診療時間（午前）</label>
            <input type="text" value="08:30〜12:00">

            <label>診療時間（午後）</label>
            <input type="text" value="13:00〜17:00">

            <label>治療法</label>
            <input type="text" value="通院、入院、カウンセリング">

            <label>特徴</label>
            <input type="text" value="完全予約制、女医在籍">

            <label>HP</label>
            <input type="text" value="https://xxxx.or.jp">

            <label>電話番号</label>
            <input type="text" value="000-0000-0000">

            <div class="btn">
                <button type="submit">更新する</button>
            </div>
        </form>
    </div>
</body>
</html>
--}}