<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        //dd($request->method());
        if($request->isMethod('post'))
        {
            $token = Str::random(60);
            $user = $request->user();
            $user->api_token = $token; // without hash convert
            // $user->api_token = hash('sha256', $token); //with hash convert
            $user->save();
            return redirect('/home');
            //return redirect('/home')->with('api_token',$token); // hash data move with redirect method
        }

        return view('home');
    }
}
