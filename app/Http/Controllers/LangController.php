<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LangController extends Controller
{
    //

    public function ChangeLang($locale) {

        $languages = config('app.languages');

        if (in_array($locale, $languages)) {
            Session::put('locale', $locale);
        }

        return redirect()->back();
    }



}
