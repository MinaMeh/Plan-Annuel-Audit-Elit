<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SessionsController extends Controller
{
 
 	public function __construct()
 	{
 		$this->middleware('guest')->except('destroy');
 	}
    public function create()
    {
    	return view('auth.login');
    }
    public function destroy()
    {
    	auth()->logout();
    	return redirect('/');
    }
    public function store()
    {
    	if (!auth()->attempt([
    		'name'=>request('name'),
    		'password'=>request('password')
    	])){
    		return back();
    	}
    	return redirect('/plans');
    }
}
