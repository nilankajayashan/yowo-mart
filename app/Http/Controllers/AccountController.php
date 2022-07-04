<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function accountDashboard(Request $request){
        if (isset($request->state)){
            $counter = [];
            $orders = Order::where('user_id', '=', session()->get('auth_user')->user_id)->get();
            $wishlist = Wishlist::where('user_id', '=', session()->get('auth_user')->user_id)->first();
            $address = UserAddress::where('user_id', '=', session()->get('auth_user')->user_id)->get();
            $counter['orders'] = count($orders);
            $counter['payments'] = count($orders);
            $counter['wishlist_products'] = $wishlist != null?count(json_decode($wishlist->wishlist)):0;
            $counter['address'] = $address != null?count($address):0;
            switch ($request->state){
                case 'my_account':
                    $orders = Order::where('user_id','=',session()->get('auth_user')->user_id)->get();
                    return view('pages.my_account', ['state' => 'my_account','orders' => $orders])->with(['counter' => $counter]);
                    break;
                case 'orders':
                    $orders = Order::where('user_id', '=', session()->get('auth_user')->user_id)->get();
                    return view('pages.my_account', ['state' => 'orders'])->with(['counter' => $counter,'orders' => count($orders)>0? $orders: null]);
                    break;
                case 'wishlist':
                    $wishlist = Wishlist::where('user_id', '=', session()->get('auth_user')->user_id)->first();
                    $wishlist_products = $wishlist != null?Product::whereIn('product_id', json_decode($wishlist->wishlist))->get():null;
                    return view('pages.my_account', ['state' => 'wishlist'])->with(['counter' => $counter, 'wishlist_products' => $wishlist_products != null?$wishlist_products:null]);
                    break;
                case 'info':
                    $user = User::select('name', 'mobile')->where('user_id', '=', session()->get('auth_user')->user_id)->first();
                    return view('pages.my_account', ['state' => 'info'])->with(['counter' => $counter, 'user' => $user]);
                    break;
                case 'addresses':
                    $addresses = UserAddress::where('user_id', '=', session()->get('auth_user')->user_id)->get();
                    return view('pages.my_account', ['state' => 'addresses'])->with(['counter' => $counter, 'addresses' => $addresses]);
                    break;
                case 'payment':
                    $payment_counts = [];
                    $payment_counts['failed'] = 0;
                    $payment_counts['pending'] = 0;
                    $payment_counts['success'] = 0;
                    $payment_counts['others'] = 0;
                    $payments = Order::where('user_id', '=', session()->get('auth_user')->user_id)->get();
                    foreach ($payments as $payment){
                        switch ($payment->payment_status){
                            case 'failed':
                                $payment_counts['failed']++;
                                break;
                            case 'pending':
                                $payment_counts['pending']++;
                                break;
                            case 'success':
                                $payment_counts['success']++;
                                break;
                            default:
                                $payment_counts['others']++;
                                break;
                        }
                    }
                    return view('pages.my_account', ['state' => 'payment'])->with(['counter' => $counter, 'payment_counts' => $payment_counts,'payments' => count($payments)>0?$payments:null]);
                    break;
                default:
                    return view('pages.my_account', ['state' => '401']);
                    break;

            }
        }else{
            return view('pages.my_account', ['state' => '401']);
        }

    }

    public function updateProfile(Request $request){
        //update name
        if($request->name != null){
            $validator = validator::make($request->all(),[
                'name' => 'required|max:255',
            ]);
            if ($validator->fails()){
                if($validator->errors()->has('name')){
                    return redirect()->route('my_account', ['state' => 'info'])->withErrors( ['name' => 'Your name is required and it can not be grater than 255 letters']);
                }else{
                    return redirect()->route('my_account', ['state' => 'info'])->with( ['notify_error' => 'Sorry...! can not update your name, please try again']);
                }
            }
            $validated = $validator->validated();
            User::where('user_id', '=', session()->get('auth_user')->user_id)
                ->update(['name' => $validated['name']]);
        }
        //update mobile
        if($request->name != null){
            $validator = validator::make($request->all(),[
                'mobile' => 'max:10',
            ]);
            if ($validator->fails()){
                if($validator->errors()->has('name')){
                    return redirect()->route('my_account', ['state' => 'info'])->withErrors( ['name' => 'Your mobile number can not be grater than 10 numbers']);
                }else{
                    return redirect()->route('my_account', ['state' => 'info'])->with( ['notify_error' => 'Sorry...! can not update your mobile number, please try again']);
                }
            }
            $validated = $validator->validated();
            User::where('user_id', '=', session()->get('auth_user')->user_id)
                ->update(['mobile' => $validated['mobile']]);
        }
        if ($request->password != null){
            $validator = validator::make($request->all(),[
                'password' => 'min:8|max:64',
            ]);
            if ($validator->fails()){
                if($validator->errors()->has('name')){
                    return redirect()->route('my_account', ['state' => 'info'])->withErrors( ['password' => 'Your password must be grater than 8 characters and can not be grater than 64 characters']);
                }else{
                    return redirect()->route('my_account', ['state' => 'info'])->with( ['notify_error' => 'Sorry...! can not update your password, please try again']);
                }
            }
            $validated = $validator->validated();
            User::where('user_id', '=', session()->get('auth_user')->user_id)
                ->update([
                    'password' => Hash::make($validated['name']),
                ]);
        }
        $user = User::where('user_id', '=', session()->get('auth_user')->user_id)->where('email', '=', session()->get('auth_user')->email)->first();
        session()->put('auth_user', $user);
        return redirect()->route('my_account', ['state' => 'info'])->with( ['success' => 'Your Profile Updated Successfully']);

    }
}
