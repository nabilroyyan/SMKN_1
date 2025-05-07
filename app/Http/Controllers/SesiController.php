<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    function index ()
    {
        return view('seassion.login');;//ketikda mengases sesicontroller maka akan ter terdireck ke views login.blade.php
    }

    function login(Request $request){
        //menampilkan errors
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ],[
            'email.required'=>'Email wajib di isi',
            'password.required'=>'password wajib di isi',
        ]);
    
        //buat login pengecekan email dan password
        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(Auth::attempt($infologin)){
            if (Auth::user()->role == 'superadmin') {
                return redirect('dashboard');//mengalihkan url yang ada di web roter
            } elseif (Auth::user()->role == 'guru') {
                return redirect('admin/guru');
            } elseif (Auth::user()->role == 'siswa') {
                return redirect('admin/siswa');
            }
        }else{
            return redirect('')->withErrors('username dan password yang di masukkan tidak sesuai')->withInput();
        }
    }    


    //controller logout
    function logout(){ 
    Auth::logout();
    return redirect('');
    }
}
