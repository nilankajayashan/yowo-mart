<?php

namespace App\Http\Controllers;

use App\Mail\PasswordResetMail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Nette\Utils\Random;

class PasswordResetController extends Controller
{
    public function passwordResetPinSent(Request $request){
        $validator =  Validator::make($request->all(),[
            'email' => 'required|email|max:255',
        ]);
        if ($validator->fails()){
            if($validator->errors()->has('email')){
                return redirect()->back()->withErrors( ['email' => 'Please Check you entered Email again'])->with(['notify_error' => 'Please Check you entered Email again']);
            }
        }
        $validated = $validator->validated();
        try{
            $user = User::where('email','=', $validated['email'])->first();
            if($user != null){
                $pin = Random::generate(4,'0-9');
//                Mail::to($user->email)->send(new PasswordResetMail($pin));
//                if (Mail::failures()){
//                    return redirect()->back()->with(['notify_error' => 'Email sent failed']);
//                }else{
                    $user->reset_pin = $pin;
                    $user->save();
                    session()->put('reset_email' , $validated['email']);
                    return redirect()->route('password-reset-pin')->with(['success' => 'Password reset pin sent to your email, please check your email inboxes']);
//                }
            }else{
                return redirect()->back()->withErrors(['email' => 'You entered email address not registered'])->with(['notify_error' => 'You entered email address not registered']);
            }
        }catch (Exception $e){
            return redirect()->back()->with(['notify_error', $e->getMessage()]);
        }
    }

    public function passwordResetPinConform(Request $request){
        $validator =  Validator::make($request->all(),[
            'reset_pin' => 'required',
        ]);
        if ($validator->fails()){
            if($validator->errors()->has('reset_pin')){
                return redirect()->back()->with( ['notify_error' => 'Password reset pin is required']);
            }
        }
        $validated = $validator->validated();
        try{
            $user = User::where('email','=', session()->get('reset_email'))->first();
            if($user != null){
                if ($user->reset_pin == $validated['reset_pin']){
                    session()->put('reset_valid' , 'valid');
                    return redirect()->route('password-change');
                }else{
                    return redirect()->route('password-reset-pin')->with(['notify_error' => 'You entered password reset pin is wrong...!']);
                }
            }else{
                return redirect()->back()->with(['notify_error' => 'Can not identify account']);
            }
        }catch (Exception $e){
            return redirect()->back()->with(['notify_error', $e->getMessage()]);
        }
    }

    public function passwordUpdate(Request $request){
        $validator =  Validator::make($request->all(),[
            'password' => 'required',
        ]);
        if ($validator->fails()){
            if($validator->errors()->has('email')){
                return redirect()->back()->with(['notify_error' => 'Please Check you entered password again']);
            }
        }
        $validated = $validator->validated();
        try{
            $user = User::where('email','=', session()->get('reset_email'))->first();
            if($user != null){
                $user->reset_pin = null;
                $user->password = Hash::make($validated['password']);
                $user->save();
                session()->forget(['reset_email']);
                session()->flash('reset_email');
                session()->forget(['reset_valid']);
                session()->flash('reset_valid');
                return redirect()->route('login')->with(['success' => 'Password reset successfully...! try to login now']);
            }else{
                return redirect()->back()->with(['notify_error' => 'Can not identify account']);
            }
        }catch (Exception $e){
            return redirect()->back()->with(['notify_error', $e->getMessage()]);
        }
    }
}
