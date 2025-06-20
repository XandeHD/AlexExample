<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\ProductType;

class AnalysisController extends Controller
{
    //

    public function Analysis(){
        return view('client.analysis');
    }

    public function AnalysisForm($id){

        // $analysis =

        $categorys = ProductCategory::all();
        $types = ProductType::all();

        return view('client.Forms.analysis',['id'=>$id,'categorys'=>$categorys,'types'=>$types]);
    }

    public function AnalysisSave(){

        return redirect()->route('analysis');
    }




}
