<x-app-layout>
  <x-slot name="header">
    <header class="px-6 py-4 flex justify-between items-center">
        <a href="{{ route('admin.hospitals.index') }}" class="text-lg font-bold text-gray-800 hover:underline">精神科評価サイト</a>
        <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="text-xl font-bold text-gray-600 underline hover:text-blue-600">管理者ログアウト</button>
        </form>
    </header>
  </x-slot>

  @if (session('success'))
    <div class="bg-green-100 text-green-800 border border-green-400 p-4 rounded mb-4 text-center">
        {{ session('success') }}
    </div>
    @endif

  <h2 class="text-xl font-bold text-center text-gray-800 mt-6 mb-4">病院情報入力フォーム</h2>

  <div class="bg-blue-200 min-h-screen py-6 px-4">
    <div class="bg-white rounded-lg shadow-md max-w-2xl mx-auto p-6">
      @if ($errors->any())
        <div class="bg-red-100 text-red-800 text-sm p-4 mb-4 rounded">入力に誤りがあります。内容をご確認ください。</div>
      @endif

      <form method="POST" action="{{ route('admin.hospitals.store') }}">
        @csrf

        <!-- 病院名 -->
        <label class="block font-medium">病院名</label>
        <input type="text" name="name" value="{{ old('name') }}" class="w-full border px-3 py-2 rounded mt-1 @error('name') border-red-500 @enderror">
        @error('name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror

        <!-- 所在地 -->
        <label class="block font-medium mt-4">所在地</label>
        <input type="text" name="address" value="{{ old('address') }}" class="w-full border px-3 py-2 rounded mt-1">
        @error('address')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror

        <!-- 都道府県 -->
        <label class="block font-medium mt-4">都道府県</label>
        <select name="prefecture" class="w-full border px-3 py-2 rounded mt-1">
          @foreach ($prefectures as $pref)
            <option value="{{ $pref }}" {{ old('prefecture') == $pref ? 'selected' : '' }}>{{ $pref }}</option>
          @endforeach
        </select>

        <!-- 最寄駅 -->
        <label class="block font-medium mt-4">最寄駅</label>
        <input type="text" name="station" value="{{ old('station') }}" class="w-full border px-3 py-2 rounded mt-1" placeholder="例: ○○駅">


        <!-- 病院タイプ -->
        <label class="block font-medium mt-4">病院タイプ</label>
        <div class="flex gap-6 mt-2">
          <label><input type="radio" name="type" value="hospital"> 病院</label>
          <label><input type="radio" name="type" value="clinic" checked> クリニック</label>
        </div>

        <!-- 診療曜日/時間 -->
        <label class="block font-medium mt-4">診療曜日</label>
        <input type="text" name="day_of_week" value="{{ old('day_of_week') }}" placeholder="例: 月火水木金" class="w-full border px-3 py-2 rounded mt-1">
        @error('day_of_week')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror

        <label class="block font-medium mt-4">診療時間（午前）</label>
        <input type="text" name="am_open" value="{{ old('am_open') }}" placeholder="例: 08:30〜12:00" class="w-full border px-3 py-2 rounded mt-1">
        @error('am_open')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror

        <label class="block font-medium mt-4">診療時間（午後）</label>
        <input type="text" name="pm_open" value="{{ old('pm_open') }}" placeholder="例: 13:00〜17:00" class="w-full border px-3 py-2 rounded mt-1">
        @error('pm_open')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror

        <!-- 治療法 -->
        <label class="block font-medium mt-6">治療法</label>
        <div id="treatment-display-area" class="tag-area border p-2 bg-gray-100 rounded mb-2"></div>
        <input id="treatment-input-field" type="text" value="{{ old('treatment') }}" placeholder="タグをクリックしてください"  class="w-full tag-input border px-3 py-2 rounded">
        <input type="hidden" name="treatment" value="{{ old('treatment') }}" id="treatment-hidden-input">
        <div id="treatment-suggestions-data" style="display:none">@json($treatments)</div>

        <!-- 専門分野 -->
        <label class="block font-medium mt-6">専門分野</label>
        <div id="specialties-display-area" class="tag-area border p-2 bg-gray-100 rounded mb-2"></div>
        <input id="specialties-input-field" type="text" value="{{ old('specialties') }}" placeholder="タグをクリックしてください"  class="w-full tag-input border px-3 py-2 rounded">
        <input type="hidden" name="specialties" value="{{ old('specialties') }}" id="specialties-hidden-input">
        <div id="specialties-suggestions-data" style="display:none">@json($specialties)</div>
        @error('specialties')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror

        <!-- 対象疾患 -->
        <label class="block font-medium mt-6">対象疾患</label>
        <div id="disorders-display-area" class="tag-area border p-2 bg-gray-100 rounded mb-2"></div>
        <input id="disorders-input-field" type="text" value="{{ old('disorders') }}" placeholder="タグをクリックしてください"  class="w-full tag-input border px-3 py-2 rounded">
        <input type="hidden" name="disorders" value="{{ old('disorders') }}" id="disorders-hidden-input">
        <div id="disorders-suggestions-data" style="display:none">@json($disorders)</div>
        @error('disorders')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror

        <!-- 特徴タグ -->
        <label class="block font-medium mt-6">特徴タグ</label>
        <div id="feature-display-area" class="tag-area border p-2 bg-gray-100 rounded mb-2"></div>
        <input id="feature-input-field" type="text" value="{{ old('feature') }}" placeholder="タグをクリックしてください"  class="w-full tag-input border px-3 py-2 rounded">
        <input type="hidden" name="feature" value="{{ old('feature') }}" id="feature-hidden-input">
        <div id="feature-suggestions-data" style="display:none">@json($features)</div>

        <script>
        
            // まずはページ全体が読み込まれてから実行されるようにする。
            document.addEventListener("DOMContentLoaded",function(){
            // jsonからデータを取得する。　JSON .parseやtextContentが少々不明
                const treatmentSuggestions = JSON.parse(document.getElementById("treatment-suggestions-data").textContent);
                const specialtiesSuggestions = JSON.parse(document.getElementById("specialties-suggestions-data").textContent);
                const disordersSuggestions = JSON.parse(document.getElementById("disorders-suggestions-data").textContent);
                const featureSuggestions = JSON.parse(document.getElementById("feature-suggestions-data").textContent);


                    // 各タグを取得する共通化された関数を作成
                function initTagEditor(fieldIdPrefix,suggestions) {
                    // タグを取得していく
                    const displayArea = document.getElementById(`${fieldIdPrefix}-display-area`); // 表示エリア
                    const inputField = document.getElementById(`${fieldIdPrefix}-input-field`);
                    const hiddenInput = document.getElementById(`${fieldIdPrefix}-hidden-input`);

                    // ページ読み込み後、タグを表示させる
                    suggestions.forEach ( item => {
                        // 繰り返し処理で新しくタグを作成する
                        const tag = document.createElement("div");
                        //　定数tag（作成したdivタグ）にクラスメイをtagと命名
                        tag.classList.add("tag");
                        // tagのテキストにitem.nameを代入
                        tag.textContent = typeof item === "string" ? item : item.name;

                        // クリックで選択欄に追加する
                        tag.addEventListener("click",function (){
                            const text = typeof item === "string" ? item : item.name;

                            // filter(Boolean)でカンマの位置を制御？
                            const current = inputField.value.split(",").map(t => t.trim()).filter(Boolean);
                            if (!current.includes(text)) {
                                current.push(text);
                                inputField.value = current.join(",");
                                hiddenInput.value = inputField.value;
                            }
                            
                       
                        });

                            // 画面に表示する
                            displayArea.appendChild(tag);
                    });
                }
                    // hidden-input(データ送信を行うため)を更新するための関数を共通化
                function updateHiddenInput(fieldIdPrefix) {
                    const displayArea = document.getElementById(`${fieldIdPrefix}-display-area`); // 表示エリア
                    const hiddenInput = document.getElementById(`${fieldIdPrefix}-hidden-input`); // 送信エリア

                        // 表示エリアに表示された"tag"を全て取得
                    const allTags = displayArea.querySelectorAll(".tag");
                        // そのtagを全て配列かして、、、処理内容不明。特にchildNodes[0].nodeValue.ここの部分。
                    const names = Array.from(allTags).map(tag => {
                        return tag.childNodes[0].nodeValue.trim();
                    });
                    
                    hiddenInput.value = names.join(",");
                    }

                    // 各タグ取得のために共通化された関数に各タグの情報を与える
                    initTagEditor("treatment",treatmentSuggestions);
                    initTagEditor("specialties",specialtiesSuggestions);
                    initTagEditor("disorders",disordersSuggestions);
                    initTagEditor("feature",featureSuggestions);

                    // 既存の initTagEditor 呼び出しの後にコレを追加！👇
                    if (treatmentSuggestions && document.getElementById('treatment-hidden-input')) {
                        const hiddenInput = document.getElementById('treatment-hidden-input');
                        const displayArea = document.getElementById('treatment-display-area');

                        if (hiddenInput.value) {
                            const tags = hiddenInput.value.split(',');
                            tags.forEach(tag => {
                                const tagElem = document.createElement('div');
                                tagElem.classList.add("tag");
                                tagElem.textContent = tag;
                                displayArea.appendChild(tagElem);
                            });
                        }
                    }            
                });

        </script>


        <!-- その他情報 -->
        <label class="block font-medium mt-6">HP</label>
        <input type="text" name="homepage_url" value="{{ old('homepage_url') }}" class="w-full border px-3 py-2 rounded mt-1">
        @error('homepage_url')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror

        <label class="block font-medium mt-4">地図URL</label>
        <input type="text" name="map_url" value="{{ old('map_url') }}" class="w-full border px-3 py-2 rounded mt-1">
        @error('map_url')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror

        <label class="block font-medium mt-4">電話番号</label>
        <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border px-3 py-2 rounded mt-1">
        @error('phone')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror

        <div class="text-center mt-6">
          <button type="submit" class="bg-orange-500 text-white px-6 py-2 rounded">保存する</button>
        </div>
      </form>
    </div>
  </div>

  <footer class="text-center py-4">
    <a href="{{ route('admin.hospitals.index') }}" class="font-bold text-gray-800 hover:underline">
        精神科評価サイト
    </a>
  </footer>
  
</x-app-layout>



<!--
<!DOCTYPE html>
<html lang="ja">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <title>病院情報入力フォーム</title>
    <style>
        body { font-family: sans-serif; background-color: #e0f0ff; }
        header, footer { background-color: #cce0ff; padding: 1rem; text-align: center; }
        .site-title {font-weight: bold; font-size: 1.1rem}
        .logout-link a {text-decoration: none; color: #000; font-size: 0.95rem;}
        .logout-link a:hover {text-decoration: underline}
        .custom-header {display: flex; justify-content:  space-between; align-items: center;background-color: #cce0ff; padding: 1rem 2rem }
        .custom-footer {background-color: #cce0ff; text-align: center; padding: 1rem}
        .custom-footer a  {color: #000; text-decoration: none; font-weight: bold}
        .custom-footer a:hover {text-decoration: underline}
        .container { padding: 2rem; width: 90%; max-width: 700px; margin: auto; background: white; border-radius: 8px; }
        h2 { background-color: #ddd; padding: 10px; text-align: center; }
        label { display: block; margin-top: 15px; }
        input, select, textarea { width: 100%; padding: 8px; margin-top: 5px; }
        .tag {cursor: pointer;}
        .tag-area { border: 1px solid #ccc; padding: 8px; min-height: 40px; background: #f9f9f9; cursor: text; }
        .tag { display: inline-block; background: #5cb85c; color: white; padding: 5px 10px; margin: 2px; border-radius: 4px; }
        .tag button { background: none; border: none; color: white; margin-left: 5px; cursor: pointer; }
        .tag-list { margin-bottom: 5px; }
        .tag-input { margin-top: 5px; width: 100%; padding: 6px; }
        .btn { background-color: orange; color: white; padding: 10px 20px; border: none; margin-top: 20px; }
        .radio-box { margin-top: 10px; }
    </style>
</head>
<body>
<header class="custom-header">
    <div class="site-title">精神科評価サイト</div>
    <div class="logout-link">
        <a href="">管理者ログアウト</a>{{--ルート設定を行う必要あり--}}
    </div>
</header>
<div class="container">
    <h2>病院情報入力フォーム</h2>
    
        {{-- バリデーションエラー表示 --}}
        
        @if ($errors->any())
            <div class="alert alert-danger">
                入力に誤りがあります。内容をご確認ください。
            </div>
        @endif
    {{--送信結果はadmin.hospitals.storeに送る--}}
    <form method="POST" action="{{ route("admin.hospitals.store") }}">
        @csrf

        {{--アクセシビリティを高めるためにlabelタグを使用--}}
        <label for="hospitalName">病院名</label>
        <input type="text" id="hospitalName" name="name"
            class="@error("name") is-invalid @enderror"
            value="{{ old("name") }}">
        @error("name")
            <div style="color: red; font-size: 0.9rem; margin-top: 4px;">
                {{ $message }}
            </div>
        @enderror

        <label for="address">所在地</label>
        <input type="text" id="address" name="address" value="{{ old("address") }}">

        <label for="prefecture">都道府県</label>
        <select id="prefecture" name="prefecture" class="@error("prefecture") is-invalid @enderror">
            @foreach ($prefectures as $pref)
                <option value="{{ $pref }}" {{ old("prefecture") == $pref ? "selected" : "" }}>{{ $pref }}</option>
            @endforeach
        </select>
        @error("prefecture")
            <div style="color: red; font-size: 0.9rem; margin-top: 4px;">
                {{ $message }}
            </div>
        @enderror

        <label for="station">最寄駅</label>
        <input id="station" type="text" name="station" placeholder="例: ⚪︎⚪︎駅" value="{{ old("station") }}">

        <label>病院タイプ</label><br>
        <label for="hospital">病院</label>
        <input type="radio" name="type" value="hospital" id="hospital"><br>

        <label for="clinic">クリニック</label>
        <input type="radio" name="type" value="clinic" id="clinic" checked>{{--初期値はクリニック--}}
        

        <label for="day_of_week">診療曜日</label>
        <input id="day_of_week" type="text" name="day_of_week" placeholder="例: 月火水木金"
            class="@error("day_of_week") is-invalid @enderror"
            value="{{ old("day_of_week") }}">
        @error("day_of_week")
            <div style="color: red; font-size: 0.9rem; margin-top: 4px;">
                {{ $message }}
            </div>
        @enderror

        <label for="am_open">診療時間（午前）</label>
        <input id="am_open" type="text" name="am_open" placeholder="例: 08:30〜12:00"
            class="@error("am_open") is-invalid @enderror"
            value="{{ old("am_open") }}">

        @error("am_open")
            <div style="color: red; font-size: 0.9rem; margin-top: 4px;">
                {{ $message }}
            </div>
        @enderror

        <label for="pm_open">診療時間（午後）</label>
        <input id="pm_open" type="text" name="pm_open" placeholder="例: 13:00〜17:00"
            class="@error("pm_open") is-invalid @enderror"
            value="{{ old("pm_open") }}">

        @error("pm_open")
            <div style="color: red; font-size: 0.9rem; margin-top: 4px;">
                {{ $message }}
            </div>
        @enderror

        <label for="treatment-input-field">治療法</label>
        <div id="treatment-display-area" class="tag-area"></div>
        <input id="treatment-input-field" class="tag-input" type="text" placeholder="タグをクリックしてください" readonly />
        <input type="hidden" name="treatment" id="treatment-hidden-input">
        <div id="treatment-suggestions-data" style="display: none;">@json($treatments)</div> {{--画面には出してないけど、jsonデータが入ってる。--}}

        <label for="specialties-input-field">専門外来</label>
        <div id="specialties-display-area" class="tag-area @error("specialtiesf") is-invalid @enderror"></div>
        <input id="specialties-input-field" class="tag-input" type="text" placeholder="タグをクリックしてください" readonly /> {{--readonlyで手入力不可にする--}}
        <input type="hidden" name="specialties" id="specialties-hidden-input" value="{{ old("specialties") }}">
        <div id="specialties-suggestions-data" style="display: none;">@json($specialties)</div>
        @error("specialties")
            <div style="color: red; font-size: 0.9rem; margin-top: 4px;">
                {{ $message }}
            </div>
        @enderror

        <label for="disorders-input-field">対象疾患</label>
        <div id="disorders-display-area" class="tag-area @error("disorders") is-invalid @enderror"></div>
        <input id="disorders-input-field" class="tag-input" type="text" placeholder="タグをクリックしてください" readonly />
        <input type="hidden" name="disorders" id="disorders-hidden-input" value="{{ old("disorders") }}">
        <div id="disorders-suggestions-data" style="display: none;">@json($disorders)</div>
        @error("disorders")
            <div style="color: red; font-size: 0.9rem; margin-top: 4px;">
                {{ $message }}
            </div>
        @enderror


        <label for="feature-input-field">特徴タグ</label>
        <div id="feature-display-area" class="tag-area"></div>
        <input id="feature-input-field" class="tag-input" type="text" placeholder="タグをクリックしてください" readonly />
        <input type="hidden" name="feature" id="feature-hidden-input">
        <div id="feature-suggestions-data" style="display: none;">@json($features)</div>

        <script>
        
            // まずはページ全体が読み込まれてから実行されるようにする。
            document.addEventListener("DOMContentLoaded",function(){
            // jsonからデータを取得する。　JSON .parseやtextContentが少々不明
                const treatmentSuggestions = JSON.parse(document.getElementById("treatment-suggestions-data").textContent);
                const specialtiesSuggestions = JSON.parse(document.getElementById("specialties-suggestions-data").textContent);
                const disordersSuggestions = JSON.parse(document.getElementById("disorders-suggestions-data").textContent);
                const featureSuggestions = JSON.parse(document.getElementById("feature-suggestions-data").textContent);


                    // 各タグを取得する共通化された関数を作成
                function initTagEditor(fieldIdPrefix,suggestions) {
                    // タグを取得していく
                    const displayArea = document.getElementById(`${fieldIdPrefix}-display-area`); // 表示エリア
                    const inputField = document.getElementById(`${fieldIdPrefix}-input-field`);
                    const hiddenInput = document.getElementById(`${fieldIdPrefix}-hidden-input`);

                    // ページ読み込み後、タグを表示させる
                    suggestions.forEach ( item => {
                        // 繰り返し処理で新しくタグを作成する
                        const tag = document.createElement("div");
                        //　定数tag（作成したdivタグ）にクラスメイをtagと命名
                        tag.classList.add("tag");
                        // tagのテキストにitem.nameを代入
                        tag.textContent = typeof item === "string" ? item : item.name;

                        // クリックで選択欄に追加する
                        tag.addEventListener("click",function (){
                            const text = typeof item === "string" ? item : item.name;

                            // filter(Boolean)でカンマの位置を制御？
                            const current = inputField.value.split(",").map(t => t.trim()).filter(Boolean);
                            if (!current.includes(text)) {
                                current.push(text);
                                inputField.value = current.join(",");
                                hiddenInput.value = inputField.value;
                            }
                            
                       
                        });

                            // 画面に表示する
                            displayArea.appendChild(tag);
                    });
                }
                    // hidden-input(データ送信を行うため)を更新するための関数を共通化
                function updateHiddenInput(fieldIdPrefix) {
                    const displayArea = document.getElementById(`${fieldIdPrefix}-display-area`); // 表示エリア
                    const hiddenInput = document.getElementById(`${fieldIdPrefix}-hidden-input`); // 送信エリア

                        // 表示エリアに表示された"tag"を全て取得
                    const allTags = displayArea.querySelectorAll(".tag");
                        // そのtagを全て配列かして、、、処理内容不明。特にchildNodes[0].nodeValue.ここの部分。
                    const names = Array.from(allTags).map(tag => {
                        return tag.childNodes[0].nodeValue.trim();
                    });
                    
                    hiddenInput.value = names.join(",");
                    }

                    // 各タグ取得のために共通化された関数に各タグの情報を与える
                    initTagEditor("treatment",treatmentSuggestions);
                    initTagEditor("specialties",specialtiesSuggestions);
                    initTagEditor("disorders",disordersSuggestions);
                    initTagEditor("feature",featureSuggestions);
            
                });

        </script>

            <label for="homePage_url">HP</label>
            <input id="homePage_url" type="text" name="homepage_url" value="{{ old("homepage_url") }}">

            <label for="map_url">地図URL</label>
            <input id="map_url" type="text" name="map_url" value="{{ old("map_url") }}">

            <label for="phone">電話番号</label>
            <input id="phone" type="text" name="phone" value="{{ old("phone") }}" >

            <div style="text-align: center;">  
                <button type="submit" class="btn">保存する</button>
            </div>
    </form>
</div>
<footer class="custom-footer">
  <a href="{{ route('admin.hospitals.index') }}">精神科評価サイト</a>
</footer>
</body>
</html>
-->