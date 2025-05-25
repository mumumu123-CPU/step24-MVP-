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
        <input id="treatement-input-field" class="tag-input" type="text" placeholder="治療法を入力してEnter" />
        <input type="hidden" name="treatment" id="treatment-hidden-input">
        <div id="treatment-suggestions-data" style="display: none;">@json($treatments)</div>

        <label for="specialties-input-field">専門外来</label>
        <div id="specialties-display-area" class="tag-area"></div>
        <input id="specialties-input-field" class="tag-input" type="text" placeholder="専門外来を入力してEnter" />
        <input type="hidden" name="specialties" id="specialties-hidden-input">
        <div id="specialties-suggestions-data" style="display: none;">@json($specialties)</div>

        <label for="disorders-input-field">対象疾患</label>
        <div id="disorders-display-area" class="tag-area"></div>
        <input id="disorders-input-field" class="tag-input" type="text" placeholder="対象疾患を入力してEnter" />
        <input type="hidden" name="disorders" id="disorders-hidden-input">
        <div id="disorders-suggestions-data" style="display: none;">@json($disorders)</div>

        <label for="features-input-field">特徴タグ</label>
        <div id="features-display-area" class="tag-area"></div>
        <input id="features-input-field" class="tag-input" type="text" placeholder="特徴タグを入力してEnter" />
        <input type="hidden" name="features" id="features-hidden-input">
        <div id="features-suggestions-data" style="display: none;">@json($features)</div>

        <script>
            
            // まずはページ全体が読み込まれてから実行されるようにする。
            document.addEventListener('DOMContentLoaded',function(){
                console.log('読み込みOK');

                //　次にtreatment-suggestions-dataを取得してみる
                const treatmentData = document.getElementById('treatment-suggestions-data');
                const treatmentDisplay = document.getElementById('treatement-input-field');
                console.log(treatmentData,treatmentDisplay);

                //　クリックされたら、イベントが発動するようにする？
                treatmentDisplay.addEventListener('click',oneClick);

                //　動作の内容
                function oneClick() {
                    alert(treatmentData);
                }
                
            });

        </script>

            {{--
            //　ページ全体が読み込まれて時に実行されるようにする。
            document.addEventListener('DOMContentLoaded', function() {
                console.log('ページが読み込まれました！');
                //　書くタグフォームの初期化を行う共通関数
                function initTagEditor(fieldIdPrefix,initialSuggestions,initialSelectedTags = []) {
                    
                    console.log(`${fieldIdPrefix}`);
                    // 書くHTML要素を取得
                    const displayArea = document.getElementById(`${fieldIdPrefix}-display-area`);
                    const inputField = document.getElementById(`${fieldIdPrefix}-input-field`);
                    const hiddenInput = document.getElementById(`${fieldIdPrefix}-hidden-input`);

                   
                }
               
                initTagEditor();
            });
            */






            /*
            //　ページ全体が読み込まれた時に実行されるようにする
            document.addEventListener('DOMContentLoaded',function(){
                // 各HTML要素をJavaScriptで捕まえる、取得する
                const treatementInputField = document.getElementById('specialties-input-field'); //タグ入力欄
                const treatmentDisplayArea = document.getElementById('specialties-display-area'); //選択された表示エリア
                const treatmentHiddenInput = document.getElementById('specialties-hidden-input'); //フォーム送信用のかくしフィールド
                const treatmentSuggestionsDiv = document.getElementById('specialties-suggestions-data'); //タグ候補が入った隠しDiv

                
                //　タグ候補のデータを取得する。@json($treatments)で出力されたJSON文字列をJavaScriptのオブジェクトに変換。
                const allTreatmentSuggestions = JSON.parse(treatmentSuggestionsDiv.textContent);

                
                // 現在選択されているタグを保持する配列。初期は空っぽにしておく。
                let selectedTreatments = [];

                // イベントリスナーを設定。入力欄がクリックされたら、タグ候補を表示する関数を呼び出す。
                treatementInputField.addEventListener('click',function(){
                    displayTreatmentSuggestions(allTreatmentSuggestions);
                });

                // タグ候補を表示する関数
                function displayTreatmentSuggestions() {
                    alert('利用可能な治療法候補:' + allTreatmentSuggestions.join(','));
                }
                
               

            }); 
            --}}
            
        
    




        

       

        
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

