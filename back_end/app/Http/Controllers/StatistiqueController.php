<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatistiqueController extends Controller
{
    public function state()
    {
        $countusers = DB::table('users')->count();
        $countarticles = DB::table('articles')->count();
        $countcategories = DB::table('categories')->count();
        $articlesPerDay = DB::table('articles')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as articles'))
            ->groupBy('date')
            ->get();

        $labels = $articlesPerDay->pluck('date');
        $data = $articlesPerDay->pluck('articles');
        $radarLabels = ['LabelA', 'LabelB', 'LabelC'];
        $radarData = [50, 30, 70];

        return view('backOffice.statistique', compact('countusers', 'countarticles', 'countcategories', 'labels', 'data'));
    }
    
}
