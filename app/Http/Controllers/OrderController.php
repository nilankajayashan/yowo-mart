<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function viewOrder(Request $request){
        $validator = Validator::make($request->all(), [
            'order-id' => 'required',
        ]);
        if ($validator->fails()){
            if ($validator->errors()->has('order-id')){
                return redirect()->back()->with(['notify_error' => 'Can not identify order']);
            }else{
                return redirect()->back()->with(['notify_error' => 'Something went wrong!, please try again']);
            }
        }
        $validated = $validator->validated();
        $order = Order::where('id', '=', $validated['order-id'])->where('user_id', '=', session()->get('auth_user')->user_id)->first();
        if ($order == null){
            return redirect()->back()->with(['notify_error' => 'can not identify order']);
        }else{
            return view('pages.user_account.order_view', ['order' => $order]);
        }
    }

    public function trackOrder(Request $request){
        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
            'email' => 'required',
        ]);
        if ($validator->fails()){
            if ($validator->errors()->has('order_id')){
                return redirect()->back()->with(['notify_error' => 'Order ID is required to track order']);
            }elseif ($validator->errors()->has('email')){
                return redirect()->back()->with(['notify_error' => 'Email is required to track order']);
            }else{
                return redirect()->back()->with(['notify_error' => 'Something went wrong!, please try again']);
            }
        }
        $validated = $validator->validated();
       try{
           $user = User::where('email', '=', $validated['email'])->first();
           $order = Order::where('user_id', '=', $user->user_id)->where('id', '=', $validated['order_id'])->first();
           if ($order == null){
               return redirect()->back()->with(['notify_error' => 'Can not identify order']);
           }
           return redirect()->back()->with(['success' => 'Order ID: '.$order->id .' is now '. $order->order_status ]);
       }catch (Exception $exception){
           return redirect()->back()->with(['notify_error' => 'Something went wrong']);
       }
    }
}
