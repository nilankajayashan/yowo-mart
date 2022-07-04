<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function registerSubmit(Request $request){
        $validator = validator::make($request->all(),[
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|max:32|min:8',
        ]);
        if ($validator->fails()){
            if($validator->errors()->has('name')){
                return redirect()->route('register')->withErrors( ['name' => 'Please Check your name again'])->with( ['notify_error' => 'Please Check your name again']);
            }elseif($validator->errors()->has('email')){
                return redirect()->route('register')->withErrors( ['email' => 'Please Check you entered Email again'])->with( ['notify_error' => 'Please Check you entered Email again']);
            }elseif($validator->errors()->has('password')){
                return redirect()->route('register')->withErrors( ['password' => 'Please Check you entered password again'])->with( ['notify_error' => 'Please Check you entered password again']);
            }
        }
        $validated = $validator->validated();
        $exists = User::where('email', '=', $validated['email'])->first();
        if ($exists != null){
            return redirect()->route('register')->withErrors( ['email' => 'Your Email is already registered...! Try to login now'])->with( ['notify_error' => 'Your Email is already registered...! Try to login now']);
        }
        try{
            $user = new User();
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->password = Hash::make( $validated['password']);
            $user->save();
            return redirect()->route('login')->with([
                'success' => 'Dear '.$validated['name'].', Thank you join with us...! your account created successfully... Now You can login using you entered email and password'
            ]);
        }catch (Exception $e){
            return redirect()->back()->with(['notify_error' => 'Something went wrong please try again later...!']);
        }


    }
}
