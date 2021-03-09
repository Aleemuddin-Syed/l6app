<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\UserProfile;
//use App\Mail\WelcomeEmail;  // Remove after add Event and Listener
//use Illuminate\Support\Facades\Mail;
use App\Events\UserRegisteredEvent;



class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        //return User::create([
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['name'],
            'password' => Hash::make($data['password']),
        ]);
        /*$roles =[
            'user_id' => $user->id,
            'role_id' => [2],
        ];*/

        // Event & Listener 
        /*$userProfile = new UserProfile([
            'user_id'=>$user->id,
            'country_id' => 1,
            'city'  =>  'default',
            'phone' =>  '098493853',
            'photo' =>  'profiles/dummy.jpg',
        ]);
        $user->profile()->save($userProfile);
        $user->roles()->attach(2);
        Mail::to($user)->send(new WelcomeEmail());*/

        event(new UserRegisteredEvent($user));
        return $user;
    }
}
