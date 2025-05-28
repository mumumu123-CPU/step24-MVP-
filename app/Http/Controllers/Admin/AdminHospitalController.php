<?php

namespace App\Http\Controllers\Admin;

use App\Models\Hospital;
use App\Models\Disorder;
use App\Models\Specialty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; // ← これ抜けてること多いので注意！

class AdminHospitalController extends Controller
{

    //　管理者用の病院一覧を表示
    public function index(Request $request)
    {
        $query = Hospital::with(['reviews', 'disorders', 'specialties']);

        if ($request->filled('prefecture')) {
            $query->where('prefecture', $request->input('prefecture'));
        }

        if ($request->filled('disorder_id')) {
            $query->whereHas('disorders', function ($q) use ($request) {
                $q->where('disorders.id', $request->input('disorder_id'));
            });
        }

        if ($request->filled('specialty_id')) {
            $query->whereHas('specialties', function ($q) use ($request) {
                $q->where('specialties.id', $request->input('specialty_id'));
            });
        }

        $hospitals = $query->get();
        $prefectures = json_decode(file_get_contents(storage_path('app/json/prefectures.json')), true);
        $disorders = Disorder::all();
        $specialties = Specialty::all();
        $hospitals = Hospital::with(['reviews', 'disorders', 'specialties'])
        ->paginate(20); // ← ★これだけで20件ずつになる

        return view('admin.index', compact('hospitals', 'prefectures', 'disorders', 'specialties'));
        }
        // 病院詳細
        public function show($id)
        {
            //　病院の詳細データを表示する
            $hospital = Hospital::with(['disorders', 'specialties', 'reviews'])->findOrFail($id);

            //　診療曜日を表示する
            $openDays = preg_split('//u', $hospital->day_of_week, -1, PREG_SPLIT_NO_EMPTY);
            $days = ['月', '火', '水', '木', '金', '土', '日'];

            $amSlots = [];
            $pmSlots = [];

            foreach ($days as $day) {
                $amSlots[] = (in_array($day, $openDays) && !empty($hospital->am_open)) ? '◯' : '−';
                $pmSlots[] = (in_array($day, $openDays) && !empty($hospital->pm_open)) ? '◯' : '−';
            }

            return view('admin.show', compact('hospital', 'amSlots', 'pmSlots'));
        }

        // 病院登録フォーム
        public function create() {
            return view('admin.create', [
                'prefectures' => json_decode(file_get_contents(storage_path('app/json/prefectures.json')), true),
                'treatments' => json_decode(file_get_contents(storage_path('app/json/treatments.json')), true),
                'specialties' => json_decode(file_get_contents(storage_path('app/json/specialties.json')), true),
                'disorders' => json_decode(file_get_contents(storage_path('app/json/disorders.json')), true),
                'features' => json_decode(file_get_contents(storage_path('app/json/features.json')), true),
            ]);
        }

        public function store(Request $request)
        {
            //　一旦、入力された情報は全て保存する、バリデーションは後で行う
            $hospital = Hospital::create([
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'type' => $request->input('type'), 
                'homepage_url' => $request->input('homepage_url'), 
                'map_url' => $request->input('map_url'),
                'prefecture' => $request->input('prefecture'), 
                'station' => $request->input('station'), 
                'day_of_week' => $request->input('day_of_week'),
                'am_open' => $request->input('am_open'), 
                'pm_open' => $request->input('pm_open'), 
                'treatment' => $request->input('treatment'), 
                'feature' => $request->input('feature'),
                'phone' => $request->input('phone'),
            ]);

            return redirect()->route('admin.hospitals.index')->with('success','病院情報を登録しました');

            /*
            try {
                $validated = $request->validate([
                    'name' => 'required|string|max:255',
                    'address' => 'required|string',
                    'prefecture' => 'required|string',
                    'type' => 'required|string',
                    'station' => 'nullable|string',
                    'am_open' => 'nullable|string',
                    'pm_open' => 'nullable|string',
                    'day_of_week' => 'nullable|string',
                    'treatment' => 'nullable|string',
                    'feature' => 'nullable|string',
                    'homepage_url' => 'nullable|url',
                    'map_url' => 'nullable|url',
                    'phone' => 'nullable|string',
                    'disorders' => 'nullable|string',   // カンマ区切りで来る想定
                    'specialties' => 'nullable|string',
                    ]);
            } catch (\Illuminate\Validation\ValidationException $e) {
                dd($e->errors());
            }
        
        
            // 病院情報を登録
            $hospital = \App\Models\Hospital::create($validated);
            dd('テスト3');
            
            // カンマ区切りを → 配列 → IDに変換
            $disorderNames = explode(',', $request->input('disorders')); // 例: ['うつ病', 'パニック障害']
            $specialtyNames = explode(',', $request->input('specialties')); // 例: ['うつ病外来', 'トラウマ外来']
        
            $disorderIds = \App\Models\Disorder::whereIn('name', $disorderNames)->pluck('id')->toArray();
            $specialtyIds = \App\Models\Specialty::whereIn('name', $specialtyNames)->pluck('id')->toArray();
        
            // 中間テーブルに保存
            $hospital->disorders()->sync($disorderIds);
            $hospital->specialties()->sync($specialtyIds);
        
            return redirect()->route('admin.hospitals.index')->with('success', '病院を登録しました！');
            */
        }


        // 病院削除処理
        public function destroy($id)
        {
            $hospital = Hospital::findOrFail($id);
            $hospital->delete();

            return redirect()->route('admin.hospitals.index')->with('success', '病院を削除しました');
        }

        // 病院編集フォーム
        public function edit($id) {
            $hospital = Hospital::findOrFail($id); // ← これがないと$hospitalが定義されない
            return view('admin.edit', compact('hospital'));
        }

        //　更新機能
        public function update(Request $request, $id) {
            $hospital = Hospital::findOrFail($id);

            // ここでバリデーション（オススメ！）
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'prefecture' => 'required|string|max:255',
                'station' => 'nullable|string|max:255',
                'day_of_week' => 'nullable|string|max:255',
                'am_open' => 'nullable|string|max:255',
                'pm_open' => 'nullable|string|max:255',
                'treatment' => 'nullable|string|max:255',
                'feature' => 'nullable|string|max:255',
                'homepage_url' => 'nullable|url',
                'phone' => 'nullable|string|max:20',
            ]);

            // 更新
            $hospital->update($validated);

            return redirect()->route('admin.hospitals.show', $hospital->id)
                ->with('success', '更新が完了しました');
        }
}