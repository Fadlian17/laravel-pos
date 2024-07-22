<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use \App\User;
use Illuminate\Http\Request;
use Auth;

class PagesController extends Controller
{
    public function login() {
    	return view('pages.login');
    }

    public function proses_login(Request $r) {
    	$email = $r->email;
    	$password = $r->password;
    	if (Auth::attempt(['email' => $email, 'password' => $password])){
    		if (Auth::user()->role == "0"){
    			return redirect('/kasir');
    		}
    		if (Auth::user()->role == "1"){
    			return redirect('/admin');
    		}
    		if (Auth::user()->role == "2"){
    			return redirect('/superadmin');
    		}
    	}
    	return redirect(route('login'))->with('sukses', 'Email / Password Anda Salah!');
    }

    public function logout(){
        Auth::logout();
        return redirect('/login')->with('sukses', 'Anda Berhasil Logout!');
    }

	public function userLogin() {
    	return view('pelanggan.sign-in-screen');
    }

	public function proses_userLogin(Request $request){
		$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

		// Jika validasi gagal, kembalikan dengan pesan error
		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
			if (Auth::user()->role == "0"){
    			return redirect('/kasir');
    		}elseif(Auth::user()->role == "1"){
    			return redirect('/admin');
    		}elseif(Auth::user()->role == "2"){
    			return redirect('/superadmin');
    		}else{
				return redirect()->intended('/');
			}
        } else {
            // Autentikasi gagal
            return redirect()->back()->withErrors(['mismatch' => 'Email / Password Anda Salah!']);
        }
	}

	public function userRegister() {
    	return view('pelanggan.sign-up-screen');
    }

	public function proses_userRegister(Request $r){
		$validator = Validator::make($r->all(), [
			'name' => 'required',
            'email' => 'required|email',
			'phone' => 'required',
            'password' => 'required', 'min:8',
			'confpassword' => ['required', 'min:8', 'same:password'],
        ],[
			'password.min' => 'Password must be at least 8 characters long.',
			'confpassword.same' => 'The password confirmation does not match.',
		]);

		// Jika validasi gagal, kembalikan dengan pesan error
		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$pengguna = new User;
		$pengguna->name = $r->name;
		$pengguna->email = $r->email;
		$pengguna->phone = $r->phone;
		$pengguna->password = bcrypt($r->password);
		$pengguna->role = '3';
		$pengguna->save();
		return redirect(route('userLogin'))->with('sukses', 'Data Berhasil Ditambah!');
	}

	public function userLogout(){
        Auth::logout();
        return redirect('/')->with('sukses', 'Anda Berhasil Logout!');
    }
}
