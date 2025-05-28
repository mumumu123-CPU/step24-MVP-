<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>病院情報入力フォーム</title>
    <style>
        body { font-family: sans-serif; background-color: #e0f0ff; }
        header, footer { background-color: #cce0ff; padding: 1rem; text-align: center; }
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
<header>精神科評価サイト｜管理者ログアウト</header>
<div class="container">
    <h2>病院情報入力フォーム</h2>
    <div class="container">    
        {{-- バリデーションエラー表示 --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    
    <form method="POST" action="{{ route('admin.hospitals.store') }}">
        @csrf

        {{--アクセシビリティを高めるためにlabelタグを使用--}}
        <label for="hospitalName">病院名</label>
        <input type="text" id="hospitalName" name="name">

        <label for="address">所在地</label>
        <input type="text" id="address" name="address">

        <label for="prefecture">都道府県</label>
        <select id="prefecture" name="prefecture">
            @foreach ($prefectures as $pref)
                <option value="{{ $pref }}">{{ $pref }}</option>
            @endforeach
        </select>

        <label for="station">最寄駅</label>
        <input id="station" type="text" name="station">

        <label>病院タイプ</label>
        <label for="hospital">病院</label>
        <input id="hospital" type="radio" name="type" value="hospital">
        <label for="clinic">クリニック</label>
        <input id="clinic" type="radio" name="type" value="clinic" checked>{{--初期設定はclinic--}}
        

        <label for="day_of_week">診療曜日</label>
        <input id="day_of_week" type="text" name="day_of_week" placeholder="例: 月火水木金">

        <label for="am_open" >診療時間（午前）</label>
        <input id="am_open" type="text" name="am_open" placeholder="例: 08:30〜12:00">

        <label for="pm_open">診療時間（午後）</label>
        <input id="pm_open" type="text" name="pm_open" placeholder="例: 13:00〜17:00">

        <label for="treatment-input-field">治療法</label>
        <div id="treatment-display-area" class="tag-area"></div>
        <input id="treatment-input-field" class="tag-input" type="text" placeholder="タグをクリックしてください" />
        <input type="hidden" name="treatment" id="treatment-hidden-input">
        <div id="treatment-suggestions-data" style="display: none;">@json($treatments)</div> {{--画面には出してないけど、jsonデータが入ってる。--}}

        <label for="specialties-input-field">専門外来</label>
        <div id="specialties-display-area" class="tag-area"></div>
        <input id="specialties-input-field" class="tag-input" type="text" placeholder="タグをクリックしてください" />
        <input type="hidden" name="specialties" id="specialties-hidden-input">
        <div id="specialties-suggestions-data" style="display: none;">@json($specialties)</div>

        <label for="disorders-input-field">対象疾患</label>
        <div id="disorders-display-area" class="tag-area"></div>
        <input id="disorders-input-field" class="tag-input" type="text" placeholder="タグをクリックしてください" />
        <input type="hidden" name="disorders" id="disorders-hidden-input">
        <div id="disorders-suggestions-data" style="display: none;">@json($disorders)</div>

        <label for="feature-input-field">特徴タグ</label>
        <div id="feature-display-area" class="tag-area"></div>
        <input id="feature-input-field" class="tag-input" type="text" placeholder="タグをクリックしてください" />
        <input type="hidden" name="feature" id="feature-hidden-input">
        <div id="feature-suggestions-data" style="display: none;">@json($features)</div>

        <script>
        
            // まずはページ全体が読み込まれてから実行されるようにする。
            document.addEventListener('DOMContentLoaded',function(){
            // jsonからデータを取得する。　JSON .parseやtextContentが少々不明
                const treatmentSuggestions = JSON.parse(document.getElementById('treatment-suggestions-data').textContent);
                const specialtiesSuggestions = JSON.parse(document.getElementById('specialties-suggestions-data').textContent);
                const disordersSuggestions = JSON.parse(document.getElementById('disorders-suggestions-data').textContent);
                const featureSuggestions = JSON.parse(document.getElementById('feature-suggestions-data').textContent);


                    // 各タグを取得する共通化された関数を作成
                function initTagEditor(fieldIdPrefix,suggestions) {
                    // タグを取得していく
                    const displayArea = document.getElementById(`${fieldIdPrefix}-display-area`); // 表示エリア
                    const inputField = document.getElementById(`${fieldIdPrefix}-input-field`);
                    const hiddenInput = document.getElementById(`${fieldIdPrefix}-hidden-input`);

                    // ページ読み込み後、タグを表示させる
                    suggestions.forEach ( item => {
                        // 繰り返し処理で新しくタグを作成する
                        const tag = document.createElement('div');
                        //　定数tag（作成したdivタグ）にクラスメイをtagと命名
                        tag.classList.add('tag');
                        // tagのテキストにitem.nameを代入
                        tag.textContent = typeof item === 'string' ? item : item.name;

                        // クリックで選択欄に追加する
                        tag.addEventListener('click',function (){
                            const text = typeof item === 'string' ? item : item.name;

                            // filter(Boolean)でカンマの位置を制御？
                            const current = inputField.value.split(',').map(t => t.trim()).filter(Boolean);
                            if (!current.includes(text)) {
                                current.push(text);
                                inputField.value = current.join(',');
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

                        // 表示エリアに表示された'tag'を全て取得
                    const allTags = displayArea.querySelectorAll('.tag');
                        // そのtagを全て配列かして、、、処理内容不明。特にchildNodes[0].nodeValue.ここの部分。
                    const names = Array.from(allTags).map(tag => {
                        return tag.childNodes[0].nodeValue.trim();
                    });
                    
                    hiddenInput.value = names.join(',');
                    }

                    // 各タグ取得のために共通化された関数に各タグの情報を与える
                    initTagEditor('treatment',treatmentSuggestions);
                    initTagEditor('specialties',specialtiesSuggestions);
                    initTagEditor('disorders',disordersSuggestions);
                    initTagEditor('feature',featureSuggestions);
            
                });

        </script>

            <label for="homePage_url">HP</label>
            <input id="homePage_url" type="text" name="homepage_url">

            <label for="map_url">地図URL</label>
            <input id="map_url" type="text" name="map_url">

            <label for="phone">電話番号</label>
            <input id="phone" type="text" name="phone">

            <div style="text-align: center;">  
                <button type="submit" class="btn">保存する</button>
            </div>
    </form>
</div>
<footer>精神科評価サイト</footer>

</body>
</html>

