<?php

namespace App\Http\Controllers;

use App\Mail\PasswordReset;
use App\Mail\PasswordResetMail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Nette\Utils\Random;

class LoginController extends Controller
{
    public function loginSubmit(Request $request){
        $validator =  Validator::make($request->all(),[
            'email' => 'required|email|max:255',
            'password' => 'required|max:32|min:8',
        ]);
        if ($validator->fails()){
            if($validator->errors()->has('email')){
                return redirect()->route('login')->withErrors( ['email' => 'Please Check you entered Email again'])->with( ['notify_error' => 'Please Check you entered Email again']);
            }elseif($validator->errors()->has('password')){
                return redirect()->route('login')->withErrors( ['password' => 'Please Check you entered password again'])->with( ['notify_error' => 'Please Check you entered password again']);
            }
        }
        $validated = $validator->validated();
        try{
            $user = User::where('email','=', $validated['email'])->first();
            if($user != null){
                if( Hash::check($validated['password'], $user->password)){
                    if ($request->remember == 'on'){
                        setcookie('email', $validated['email'], time() + (86400 * 30), "/");
                        setcookie('password', $validated['password'], time() + (86400 * 30), "/");
                    }
                    session()->put('auth_user', $user);
                    return redirect()->route('my_account', ['state' => 'my_account']);
                }else{
                    return redirect()->route('login')->withErrors(['password','Dear '. $validated['email'] .', you entered password is wrong'])->with(['notify_error','Dear '. $validated['email'] .', you entered password is wrong']);
                }
            }else{
                return redirect()->route('login')->withErrors(['email','You entered email address not registered'])->with(['notify_error','You entered email address not registered']);
            }
        }catch (Exception $e){
            return redirect()->back()->with(['notify_error', $e->getMessage()]);
        }
    }

    public function logout(){
        if (session()->has('auth_user')){
            $name = session()->get('auth_user')->name;
            session()->forget(['auth_user']);
            session()->flash('auth_user');
            return redirect()->route('index')
                ->with([
                    'success' => 'Dear '.$name.', You are logged out successfully...! Welcome back again...'
                ]);
        }
    }
}
