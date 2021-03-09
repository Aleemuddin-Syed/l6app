<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Role;
use App\Models\Country;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with(['profile','roles'])->get();
        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $country = Country::all();
        $roles  = Role::all();
        return view('dashboard.users.create',compact('country','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $users = [
            'username' => $request->username,
            'name'  =>  $request->name,
            'email' =>  $request->email,
            'password'=>bcrypt($request->password),
        ];
        $user = User::create($users);
        
        $filename = sprintf('profile_%s.jpg',$user->id);
        if($request->hasFile('photo'))
            $filename = $request->file('photo')->storeAs('profiles',$filename,'public');
        else
            $filename = 'profiles/dummy.jpg';
        
        if($user)
        {
          $profile = new \App\Models\UserProfile([
            'user_id'   =>  $user->id,
            'city'      =>  $request->city,
            'country_id'=>  $request->country,
            'photo'     =>  $filename,
            'phone'     =>  $request->phone,
          ]);  
        }

        $user->profile()->save($profile);
        $user->roles()->attach($request->roles);
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $data = User::find($id);
        return view('dashboard.users.edit',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //$user = User::where('id',$user->id)->first();
        $users = User::with(['profile','roles'])->where('id',$user->id)->first();
        $country = Country::all();
        $roles  = Role::all();
        return view('dashboard.users.edit',compact('country','roles','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name  =  $request->name;
        $user->email =  $request->email;
        
        $filename = sprintf('profile_%s.jpg',$user->id);
        if($request->hasFile('photo'))
            $filename = $request->file('photo')->storeAs('profiles',$filename,'public');
        else
            $filename = $user->profile->photo;
        
        if($user->save())
        {
          $profile = [
            'user_id'   =>  $user->id,
            'city'      =>  $request->city,
            'country_id'=>  $request->country,
            'photo'     =>  $filename,
            'phone'     =>  $request->phone,
          ];  
        }

        $user->profile()->update($profile);
        $user->roles()->sync($request->roles);
        return redirect()->route('users.index');      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->roles()->detach();
        $user->profile()->delete();
        $user->delete();
        return redirect()->route('users.index');
    }
}
