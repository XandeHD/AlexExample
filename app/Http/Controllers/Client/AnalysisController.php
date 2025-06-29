<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\ProductType;
use App\Models\Sample_Test_Extra;
use App\Models\SampleTests;

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
        $test_samples = SampleTests::where('status',1)->with('extras')->get();

        // dd($test_samples);

        return view('client.Forms.analysis',['id'=>$id,'categorys'=>$categorys,'types'=>$types,'test_samples'=>$test_samples]);
    }

    public function AnalysisSave(){

        return redirect()->route('analysis');
    }




}
