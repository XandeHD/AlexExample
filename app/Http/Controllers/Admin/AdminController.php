<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sample_Test_Extra;
use App\Models\Sample_Test_Extra_Val;
use App\Models\SampleLang;
use App\Models\SampleTests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\map;

class AdminController extends Controller
{
    //
    public function Panel(){
        return view('admin.panel');
    }

    public function Users(){
        return view('admin.users');
    }

    public function Clients(){
        return view('admin.clients');
    }

    public function Samples(){
        return view('admin.sampletests');
    }

    public function FormSamples($id){

        $test_sample = SampleTests::find($id);

        if($test_sample){
            $descriptions = SampleLang::where('code',$test_sample->code)->get(['description','lang'])->keyBy('lang')->toArray();
            $test_sample->descriptions = $descriptions;

            $extrafields = Sample_Test_Extra::where('code',$test_sample->code)->get(['*']);
            $test_sample->extrafields = $extrafields;
        }

        // dd($test_sample);

        return view('admin.Forms.sampletest',['test_sample'=>$test_sample]);
    }

    public function SaveSampleTest(Request $request){
        $validdata = $request->validate([
            'code' => ['required','max:20','string'],
            // 'description'=> ['required'],
            'status' => ['required','boolean'],
            'cost' => ['required','numeric','min:0'],
            'descriptions' => ['required','array',''],
            'extrafields'=>['required','array',''],
        ]);  
        
        // dd($validdata);

        DB::transaction(function () use ($validdata) {

            SampleTests::updateOrCreate(
                ['code'=>$validdata['code']],
                [
                    'code'=>$validdata['code'],
                    'cost'=>$validdata['cost'],
                    // 'description'=>$validdata['description'],
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

            #### EXTRA FIELDS ####

            // Delete a todos os campos extras da Sample que não estão no formulario.
            if(collect($validdata['extrafields'])->count() > 0){

                $extKeep = array_column(collect($validdata['extrafields'])->where('id','<>',null)->select('id')->toArray(),'id');

                if(count($extKeep) == 0){
                    Sample_Test_Extra::where('code',$validdata['code'])->delete();
                    Sample_Test_Extra_Val::where('code',$validdata['code'])->delete();  
                }else{
                    $todelete = Sample_Test_Extra::whereNotIn('fieldid',$extKeep)->get(['*']);
                    foreach ($todelete as $field) {
                        Sample_Test_Extra_Val::where('fieldid',$field->fieldid)->where('code',$validdata['code'])->delete();
                        Sample_Test_Extra::where('fieldid',$field->fieldid)->delete();
                    }
                }

            }else{
                Sample_Test_Extra::where('code',$validdata['code'])->delete();
                Sample_Test_Extra_Val::where('code',$validdata['code'])->delete();
            }

            // Save Extra Fields
            if(collect($validdata['extrafields'])->count() > 0){

                foreach(collect($validdata['extrafields']) as $saveExt){
                    Sample_Test_Extra::updateOrCreate(
                            ['code' => $validdata['code'], 'fieldid' => $saveExt['id']],
                            [
                                'code'=> $validdata['code'],
                                'fieldname' => $saveExt['name'],
                                'fieldtype' => $saveExt['type'],
                                'created_by' => Auth::user()->username ?? 'Admin',
                                'updated_by' => Auth::user()->username ?? 'Admin',
                            ]
                        );
                }

            }   
        });
        

        return redirect()->route('admin.samples')->with('success', 'Registo criado com sucesso.');

    }

    

}
