<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Post;
use App\Models\UserProfile;

class WelcomeController extends Controller
{
    public function index()
    {
    	//$user = User::all();
    	$user = User::with('profile')->get();
    	//dd($user);
		return view('welcome',compact('user'));
    }
}
