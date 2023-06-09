<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit(){
        $user = Auth::user();
        return view('dashboard.profile.edit',compact('user'));
    }
    public function update(Request $request){
        $request->validate([
            'first_name'=>'required|string|max:255',
             'last_name'=>'required|string|max:255',
            'birthday'=>'nullable|date|before:today',
            'gender'=>'in:male,female',
            'county'=>'required|string|size:2'
        ]);
       $user = $request->user();

       $user->profile->fill($request->all())->save();

       return redirect()->route('dashboard.profile.edit')->with('sucess','profile edite');
       //$profile = $user->profile;

    //    if($profile->user_id){
    //     $profile->update($request->all());
    //    }else{
    //     // $profile->merge([
    //     //     'user_id'=>$user->id
    //     // ]);
    //     // $profile->create($request->all());
    //     $user->profile()->create($request->all());
    //    }
    }
}
