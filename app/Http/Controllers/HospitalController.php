<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\Disorder;
use App\Models\Specialty;

class HospitalController extends Controller
{
    public function index(Request $request)
    {
        $query = Hospital::with(['reviews', 'disorders', 'specialties']);

        // 検索条件がある場合は絞り込み
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

        // データ取得
        $hospitals = $query->paginate(20); 

        // ドロップダウン用データ
        $prefectures = json_decode(file_get_contents(storage_path('app/json/prefectures.json')), true);
        $disorders = Disorder::all();
        $specialties = Specialty::all();

        return view('hospitals.index', compact('hospitals', 'prefectures', 'disorders', 'specialties'));
    }

    public function show($id) {
        $hospital = Hospital::with(['reviews','disorders','specialties'])->findOrFail($id);
        return view('hospitals.show',compact('hospital'));
    }
    
}
