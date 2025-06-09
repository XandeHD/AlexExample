<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SampleLang;
use App\Models\SampleTests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function Panel(){
        return view('admin.panel');
    }

    public function Users(){
        return view('admin.users');
    }

    public function Samples(){
        return view('admin.sampletests');
    }

    public function FormSamples($id){

        $test_sample = SampleTests::find($id);

        $descriptions = SampleLang::where('code',$test_sample->code)->get(['description','lang'])->keyBy('lang')->toArray();
        $test_sample->descriptions = $descriptions;
        // dd($descriptions);

        // $description = ;

        dd($test_sample->descriptionByLocale()->first()?->description);

        return view('admin.Forms.sampletest',['test_sample'=>$test_sample]);
    }

    public function SaveSampleTest(Request $request){
        // return $request->all();


        $validdata = $request->validate([
            'code' => ['required','max:20','string'],
            'description' => ['required'],
            'status' => ['required','boolean'],
            'cost' => ['required','numeric','min:0'],
            'descriptions' => ['required','array','']
        ]);     

        // dd($validdata);


        DB::transaction(function () use ($validdata) {

            // SampleTests::findOrCreate()

            SampleTests::updateOrCreate(
                ['code'=>$validdata['code']],
                [
                    'code'=>$validdata['code'],
                    'cost'=>$validdata['cost'],
                    'description'=>$validdata['description'],
                    // 'status'=> $validdata['status'] <> NULL ?? 0,
                    'created_by'=>Auth::user()->username ?? 'Admin',
                    'updated_by'=>Auth::user()->username ?? 'Admin',
                ]);

            // Se existir alguma linguagem para ser guardada
            if(collect($validdata['descriptions'])->filter(fn(?string $value) => !is_null($value) && trim($value) !== '')->count() > 0){

                $descriptions = [];

                foreach ($validdata['descriptions'] as $key => $value) {
                    if (is_array($key)) {
                        $key = array_key_first($key); // Ou converter de alguma forma conhecida
                    }

                    $descriptions[$key] = $value;
                }

                // dd($validdata['descriptions']);
                
                foreach($descriptions as $key => $desc) {
                    if($desc !== null && trim($desc) !== '') {
                        SampleLang::updateOrCreate(
                            ['code' => $validdata['code'], 'lang' => $key],
                            [
                                'description' => $desc,
                                'created_by' => Auth::user()->username ?? 'Admin',
                                'updated_by' => Auth::user()->username ?? 'Admin',
                            ]
                        );
                    }
                }
            }
        });
        

        return redirect()->route('admin.samples')->with('success', 'Registo criado com sucesso.');

    }

}
