<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\ShippingDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class checkoutController extends Controller
{
    public function checkout(){
        $cart_details = $this->getCart();
        if ($cart_details != null){
            return view('pages.checkout',['cart' => $cart_details['cart'],'total' => $cart_details['total'],'main_images' => $cart_details['main_images']]);
        }
       return view('pages.checkout');
    }

//    public function checkoutWithMessage($message){
//        $cart_details = $this->getCart();
//        if ($cart_details != null){
//            return view('pages.checkout',['cart' => $cart_details['cart'],
//                'total' => $cart_details['total']])->withErrors($message,'error');
//        }
//        return view('pages.checkout');
//    }
    public function getCart(){
        $full_cart = array();
        if (session()->has('auth_user') && session()->get('auth_user') != null){
            $cart = Cart::select('cart')
                ->where('user_id', '=', session()->get('auth_user')->user_id)
                ->first();
            if ($cart == null){
                return null;
            }else{
                $total = 0;
                $main_images = [];
                foreach(json_decode($cart->cart) as $cart_item){
                    $item = Product::select('product_id', 'unit_price', 'name', 'main_image')
                        ->where('product_id', '=', $cart_item->product_id)
                        ->first();
                    $item['user_quantity'] = $cart_item->quantity;
                    $total+=$item['unit_price']*$item['user_quantity'];
                    array_push($full_cart,$item);
                    $product_temp = [];
                    $product_temp['product_id'] = $item['product_id'];
                    $product_temp['image'] = $item['main_image'];
                    array_push($main_images,$product_temp);
                }

                return ['cart' => $full_cart,'total' => $total,'main_images' => $main_images];
            }

        }elseif(isset($_COOKIE['cart']) && $_COOKIE['cart'] != null){
            $cart = $_COOKIE['cart'];
            $total = 0;
            $main_images = [];
            foreach(json_decode($cart) as $cart_item) {
                $item = Product::select('product_id', 'unit_price', 'name', 'main_image')
                    ->where('product_id', '=', $cart_item->product_id)
                    ->first();
                $item['user_quantity'] = $cart_item->quantity;
                $total+=$item['unit_price']*$item['user_quantity'];
                array_push($full_cart, $item);
                $product_temp['product_id'] = $item['product_id'];
                $product_temp['image'] = $item['main_image'];
                array_push($main_images,$product_temp);
            }
            return ['cart' => $full_cart,'total' => $total, 'main_images' => $main_images];
        }else{
            return null;
        }
    }

    public function checkoutComplete(Request $request){
        $validator = validator::make($request->all(),[
            'shipping_name' => 'required',
            'shipping_email' => 'required',
            'shipping_mobile' => 'required',
            'shipping_country' => 'required',
            'shipping_district' => 'required',
            'shipping_city' => 'required',
            'shipping_address1' => 'required',
            'shipping_postal_code' => 'required',
            'shipping_method' => 'required',
            'payment_method' => 'required',
        ]);
        if ($validator->fails()){
            if($validator->errors()->has('shipping_name')){
                return redirect()->route('checkout')->withErrors(['shipping_name' => 'Please enter order receiver\'s name'])->with(['notify_error' => 'Please enter order receiver\'s name']);
            }elseif($validator->errors()->has('shipping_email')){
                return redirect()->route('checkout')->withErrors(['shipping_email' => 'Please enter order receiver\'s email address'])->with(['notify_error' => 'Please enter order receiver\'s email address']);
            }elseif($validator->errors()->has('shipping_mobile')){
                return redirect()->route('checkout')->withErrors(['shipping_mobile' => 'Please enter order receiver\'s contact number'])->with(['notify_error' => 'Please enter order receiver\'s contact number']);
            }elseif($validator->errors()->has('shipping_country')){
                return redirect()->route('checkout')->withErrors(['shipping_country' => 'Please select order receiver\'s country'])->with(['notify_error' => 'Please select order receiver\'s country']);
            }elseif($validator->errors()->has('shipping_address1')){
                return redirect()->route('checkout')->withErrors(['shipping_address1' => 'Please Enter order receiver\'s address'])->with(['notify_error' => 'Please Enter order receiver\'s address']);
            }elseif($validator->errors()->has('shipping_district')){
                return redirect()->route('checkout')->withErrors(['shipping_district' => 'Please select order receiver\'s district'])->with(['notify_error' => 'Please select order receiver\'s district']);
            }elseif($validator->errors()->has('shipping_city')){
                return redirect()->route('checkout')->withErrors(['shipping_city' => 'Please select order receiver\'s city'])->with(['notify_error' => 'Please select order receiver\'s city']);
            }

        }
        $validated = $validator->validated();
//        dd($request->payment_same);
        if ($request->payment_same == 'on'){
            $validator = validator::make($request->all(),[
                'payment_name' => 'required',
                'payment_email' => 'required',
                'payment_mobile' => 'required',
                'payment_country' => 'required',
                'payment_city' => 'required',
                'payment_address' => 'required'
            ]);
            if ($validator->fails()){
                if($validator->errors()->has('payment_name')){
                    return redirect()->route('checkout',['payment_same' => 'on'])->withErrors(['payment_name' => 'Please enter order sender\'s name'])->with(['notify_error' => 'Please enter order sender\'s name']);
                }elseif($validator->errors()->has('payment_email')){
                    return redirect()->route('checkout',['payment_same' => 'on'])->withErrors(['payment_email' => 'Please enter order sender\'s name'])->with(['notify_error' => 'Please enter order sender\'s name']);
                }elseif($validator->errors()->has('payment_mobile')){
                    return redirect()->route('checkout',['payment_same' => 'on'])->withErrors(['payment_mobile' => 'Please enter order sender\'s contact number'])->with(['notify_error' => 'Please enter order sender\'s contact number']);
                }elseif($validator->errors()->has('payment_country')){
                    return redirect()->route('checkout',['payment_same' => 'on'])->withErrors(['payment_country' => 'Please select order sender\'s country'])->with(['notify_error' => 'Please select order sender\'s country']);
                }elseif($validator->errors()->has('payment_city')){
                    return redirect()->route('checkout',['payment_same' => 'on'])->withErrors(['payment_city' => 'Please enter order sender\'s city'])->with(['notify_error' => 'Please enter order sender\'s city']);
                }elseif($validator->errors()->has('payment_address')){
                    return redirect()->route('checkout',['payment_same' => 'on'])->withErrors(['payment_address' => 'Please enter order sender\'s address'])->with(['notify_error' => 'Please enter order sender\'s address']);
                }
            }
            $validated += $validator->validated();
        }
        $order = new Order();
        $order->shipping_method = $validated['shipping_method'];
        $order->shipping_name = $validated['shipping_name'];
        $order->shipping_email = $validated['shipping_email'];
        $order->shipping_mobile = $validated['shipping_mobile'];
        $order->shipping_country = $validated['shipping_country'];
        $order->shipping_district = $validated['shipping_district'];
        $order->shipping_city = $validated['shipping_city'];
        $order->shipping_postal_code = $validated['shipping_postal_code'];
        $order->shipping_address1 = $validated['shipping_address1'];
        $order->shipping_address2 = $request->shipping_address2;
        //shipping price
        if ($validated['shipping_method'] == '24_7_shipping'){
            $shipping_details = ShippingDetails::select('price')
                ->where('country', '=', strtolower($validated['country']))
                ->where('district', '=', strtolower($validated['district']))
                ->where('city', '=', strtolower($validated['city']))
                ->where('postal_code', '=', strtolower($validated['postal_code']))
                ->first();
            if($shipping_details == null){
                return redirect()->back()->with([['notify_error' => 'Can not find shipping details']]);
            }else{
                $order->shipping_price = $shipping_details->price;
            }
        }elseif($validated['shipping_method'] == 'free_shipping'){
            $order->shipping_price = 0;
        }
        //add shipping note
        if ($request->shipping_note != null){
            $order->shipping_note = $request->shipping_note;
        }
        $order->payment_method = $validated['payment_method'];
        if ($request->payment_same == 'on'){
            $order->payment_name = $validated['payment_name'];
            $order->payment_email = $validated['payment_email'];
            $order->payment_mobile = $validated['payment_mobile'];
            $order->payment_country = $validated['payment_country'];
            $order->payment_city = $validated['payment_city'];
            $order->payment_address = $validated['payment_address'];
        }else{
            $order->payment_name = $validated['shipping_name'];
            $order->payment_email = $validated['shipping_email'];
            $order->payment_mobile = $validated['shipping_mobile'];
            $order->payment_country = $validated['shipping_country'];
            $order->payment_city = $validated['shipping_city'];
            $order->payment_address = $validated['shipping_address1'];
        }

        //add cart
        if (session()->has('auth_user')){
            $cart = Cart::select('cart')->where('user_id', '=', session()->get('auth_user')->user_id )->first();
        }else{
            $cart = $_COOKIE['cart'];
        }
        $total = 0;
        if ($cart != null){
                $index = 0;
                $product = [];
                foreach(session()->has('auth_user')?json_decode($cart->cart):json_decode($cart) as $cart_item){
                    $item = Product::where('product_id', '=', $cart_item->product_id)
                        ->first();
                    if ($item->quantity >= $cart_item->quantity){
                        $total+=$item->unit_price * $cart_item->quantity;
                        $cart_item->unit_price = $item->unit_price;
                        $cart_item->name = $item->name;
                        $product[$index]=$cart_item;
                        $item->quantity -= $cart_item->quantity;
                        $item->save();
                        $index++;
                    }

                }
                $order->total = $total;
                $order->cart = json_encode($product);
        }else{
            return redirect()->back()->with(['notify_error' => 'Can not find cart details']);
        }

        //add and get payment
        if ( $validated['payment_method'] == 'cod'){
            $order->payment_status = 'pending';
            $order->order_status = 'pending';
        }elseif ($validated['payment_method'] == 'payhere'){
            $order->payment_status = $this->payhereGateway($cart->total);
            $order->order_status = 'pending';
        }
        if (session()->has('auth_user')){
            $order->user_id = session()->get('auth_user')->user_id;
            Cart::where('user_id', '=', session()->get('auth_user')->user_id)->delete();
        }else{
            setcookie('cart', '', time()-1, "/");
        }

        $order->save();
        return redirect()->route('order-success')->with(['order_id' => $order->id]);
    }

    public function payhereGateway($total){
        return 'success';
    }
}
