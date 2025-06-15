<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Client;

class ClientLoginController extends Controller
{
    public function showLoginForm()
    {
        if(Auth::guard('client')->check()){
            return redirect()->route('dashboard');
        }else if(Auth::guard('web')->check()){
            return redirect()->route('admin.panel');
        }else{
            return view('auth.client-login'); // Criar esta view
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        $client = Client::where('email',$credentials['email'])->first();

        if($client->status == 0){
            return back()->withErrors([
                'email' => __('messages.user-blocked'),
            ]);
        }

        if($client->approved == 0){
            return back()->withErrors([
                'email' => __('messages.waiting-admin'),
            ]);
        }

        if (Auth::guard('client')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'Credenciais inválidas.',
        ]);
    }

    public function logout(Request $request)
    {
        // dd($request);
        Auth::guard('client')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
