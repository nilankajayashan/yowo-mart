<?php

namespace App\Http\Controllers;


use App\Models\Cart;
use App\Models\Product;
use App\Models\ShippingDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\True_;
use function MongoDB\BSON\toJSON;
use function PHPUnit\Framework\isEmpty;

class CartController extends Controller
{
    public function getCart(){
        $full_cart = array();
        if (session()->has('auth_user') && session()->get('auth_user') != null){
            $cart = Cart::select('cart')
                ->where('user_id', '=', session()->get('auth_user')->user_id)
                ->first();
            if ($cart == null){
                return view('pages.cart');
            }else{
                $total = 0;
                $main_images = [];
                foreach(json_decode($cart->cart) as $cart_item){
                    $item = Product::select('product_id', 'unit_price', 'name','main_image')
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

                return view('pages.cart',['cart' => $full_cart,'total' => $total,'main_images' => $main_images]);
            }

        }elseif(isset($_COOKIE['cart']) && $_COOKIE['cart'] != null){
            $cart = $_COOKIE['cart'];
            $total = 0;
            $main_images = [];
            foreach(json_decode($cart) as $cart_item) {
                $item = Product::select('product_id', 'unit_price', 'name','main_image')
                    ->where('product_id', '=', $cart_item->product_id)
                    ->first();
                $item['user_quantity'] = $cart_item->quantity;
                $total+=$item['unit_price']*$item['user_quantity'];
                array_push($full_cart, $item);
                $product_temp = [];
                $product_temp['product_id'] = $item['product_id'];
                $product_temp['image'] = $item['main_image'];
                array_push($main_images,$product_temp);
            }
            return view('pages.cart',['cart' => $full_cart, 'total' => $total, 'main_images' => $main_images]);
        }else{
            return view('pages.cart');
        }
    }


    public function addToCart(Request $request){
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'quantity' => 'required',
        ]);
        if($validator->fails()){
            if($validator->errors()->has('product_id')){
                return redirect()->back()->with(['notify_error' => 'can not identify product']);
            }elseif( $validator->errors()->has('quantity')){
                return redirect()->back()->with(['notify_error' => 'product quantity required']);
            }
        }
        $validated = $validator->validated();
        $product_quantity = Product::select('quantity')->where('product_id', '=', $validated['product_id'])->first();
        if ($product_quantity->quantity < $validated['quantity']){
            return redirect()->back()->with(['notify_error' => 'No Stock available, only available '. $product_quantity->quantity .' products.']);
        }
        if (session()->has('auth_user')){
            $old_cart = Cart::where('user_id', '=', session()->get('auth_user')->user_id)->first();
            if($old_cart == null){
                $new_cart = new Cart();
                $new_cart->user_id = session()->get('auth_user')->user_id;
                $product = [
                    'product_id' => $validated['product_id'],
                    'quantity' => $validated['quantity'],
                ];
                $new_cart->cart = json_encode(array($product));
                $new_cart->save();
                $product_name = Product::select('name')
                    ->where('product_id', '=', $validated['product_id'])
                    ->first();
                return redirect()->back()->with(['success' => 'Dear '.session()->get('auth_user')->name.', '.$validated['quantity'].' '.$product_name->name.' added to your cart successfully...!' ]);
            }else{
                $old_cart_list = json_decode($old_cart->cart);
                $exist = false;
                foreach ($old_cart_list as $old_cart_product){
                    if ($old_cart_product->product_id == $validated['product_id']){
                        $old_cart_product->quantity+=$validated['quantity'];
                        $exist = true;
                    }
                }
                if(!$exist){
                    $product = [
                        'product_id' => $validated['product_id'],
                        'quantity' => $validated['quantity'],
                    ];
                    array_push($old_cart_list, json_decode(json_encode($product)));
                }
                $old_cart->cart = $old_cart_list;
                $old_cart->save();
                $product_name = Product::select('name')
                    ->where('product_id', '=', $validated['product_id'])
                    ->first();
                return redirect()->back()->with(['success' => 'Dear '.session()->get('auth_user')->name.', '.$validated['quantity'].' '.$product_name->name.' added to your cart successfully...!' ]);
            }
        }else{
            if(!isset($_COOKIE['cart'])){
                $product = [
                    'product_id' => $validated['product_id'],
                    'quantity' => $validated['quantity'],
                ];
                setcookie('cart', json_encode(array($product)), time() + (86400 * 30), "/");
                $product_name = Product::select('name')
                    ->where('product_id', '=', $validated['product_id'])
                    ->first();
                return redirect()->back()->with(['success' => 'Dear Customer, '.$validated['quantity'].' '.$product_name->name.' added to your cart successfully...!' ]);
            }else{
                $old_cart_list = json_decode($_COOKIE['cart']);
                $exist = false;
                foreach ($old_cart_list as $old_cart_product){
                    if ($old_cart_product->product_id == $validated['product_id']){
                        $old_cart_product->quantity+=$validated['quantity'];
                        $exist = true;
                        // array_push($updated_cart, $old_cart_product);
                    }
                }
                if(!$exist){
                    $product = [
                        'product_id' => $validated['product_id'],
                        'quantity' => $validated['quantity'],
                    ];
                    array_push($old_cart_list, json_decode(json_encode($product)));
                }
                setcookie('cart', json_encode($old_cart_list), time() + (86400 * 30), "/");
                $product_name = Product::select('name')
                    ->where('product_id', '=', $validated['product_id'])
                    ->first();
                return redirect()->back()->with(['csuccess' => 'Dear Customer, '.$validated['quantity'].' '.$product_name->name.' added to your cart successfully...!' ]);
            }
        }
    }

    public function updateCart(Request $request){
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'quantity' => 'required',
        ]);
        if($validator->fails()){
            if($validator->errors()->has('product_id')){
                return redirect()->back()->with(['notify_error' => 'can not identify product']);
            }elseif( $validator->errors()->has('quantity')){
                return redirect()->back()->with(['notify_error' => 'quantity is required']);
            }
        }
        $validated = $validator->validated();
        $product_quantity = Product::select('quantity')->where('product_id', '=', $validated['product_id'])->first();
        if ($product_quantity->quantity < $validated['quantity']){
            return redirect()->back()->with(['notify_error' => 'No Stock available, only available '. $product_quantity->quantity .' products.']);
        }
        if (session()->has('auth_user')){
            $old_cart = Cart::where('user_id', '=', session()->get('auth_user')->user_id)->first();
            if($old_cart == null){
                return redirect()->back()->with(['notify_error' => 'Can not update empty card']);
            }else{
                $old_cart_list = json_decode($old_cart->cart);
                foreach ($old_cart_list as $old_cart_product){
                    if ($old_cart_product->product_id == $validated['product_id']){
                        $old_cart_product->quantity =$validated['quantity'];
                    }
                }
                $old_cart->cart = $old_cart_list;
                $old_cart->save();
                $product_name = Product::select('name')
                    ->where('product_id', '=', $validated['product_id'])
                    ->first();
                return redirect()->back()->with(['success' => 'Dear '.session()->get('auth_user')->name.', '.$validated['quantity'].' '.$product_name->name.' added to your cart successfully...!' ]);
            }
        }else{
            if(!isset($_COOKIE['cart'])){
                return redirect()->back()->with(['notify_error' => 'Can not update empty card']);
            }else{
                $old_cart_list = json_decode($_COOKIE['cart']);
                foreach ($old_cart_list as $old_cart_product){
                    if ($old_cart_product->product_id == $validated['product_id']){
                        $old_cart_product->quantity = $validated['quantity'];
                    }
                }
                setcookie('cart', json_encode($old_cart_list), time() + (86400 * 30), "/");
                $product_name = Product::select('name')
                    ->where('product_id', '=', $validated['product_id'])
                    ->first();
                return redirect()->back()->with(['success' => 'Dear Customer, '.$validated['quantity'].' '.$product_name->name.' added to your cart successfully...!' ]);
            }
        }
    }

    public function removeCart($product_id){
        if (session()->has('auth_user')){
            $old_cart = Cart::where('user_id', '=', session()->get('auth_user')->user_id)->first();
            if($old_cart == null){
                return redirect()->back()->with(['notify_error' => 'Can not update empty card']);
            }else{
                $old_cart_list = json_decode($old_cart->cart);
//                dd($old_cart_list);
                $index = 0;
                $cart_remove = false;
                foreach ($old_cart_list as $old_cart_product){
                    if ($old_cart_product->product_id == $product_id){
                       // $old_cart_product->quantity =$validated['quantity'];
                        unset($old_cart_list[$index]);
                        if (count($old_cart_list) == 0){
                            Cart::where('user_id', '=', session()->get('auth_user')->user_id)->delete();
                            $cart_remove = true;
                        }
                        break;
                    }
                    $index++;
                }
                if (!$cart_remove){
                    $old_cart->cart = $old_cart_list;
                    $old_cart->save();
                }
                $product_name = Product::select('name')
                    ->where('product_id', '=', $product_id)
                    ->first();
                return redirect()->back()->with(['success' => 'Dear '.session()->get('auth_user')->name.', '.$product_name->name.' removed from your cart successfully...!' ]);
            }
        }else{
            if(!isset($_COOKIE['cart'])){
                return redirect()->back()->with(['notify_error' => 'Can not update empty card']);
            }else{
                $old_cart_list = json_decode($_COOKIE['cart']);
                $index = 0;
                $cart_remove = false;
                foreach ($old_cart_list as $old_cart_product){
                    if ($old_cart_product->product_id == $product_id){
                        unset($old_cart_list[$index]);
                        if (count($old_cart_list) == 0){
                            setcookie('cart', "", time()-1, "/");
                            $cart_remove = true;
                        }
                        break;
                    }
                    $index++;
                }
                if (!$cart_remove) {
                    setcookie('cart', json_encode($old_cart_list), time() + (86400 * 30), "/");
                }
                $product_name = Product::select('name')
                    ->where('product_id', '=', $product_id)
                    ->first();
                return redirect()->back()->with(['success' => 'Dear Customer, '.$product_name->name.' removed from your cart successfully...!' ]);
            }
        }
    }

    public function saveShipping(Request $request){
        $validator = Validator::make($request->all(), [
            'country' => 'required',
            'district' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
        ]);
        if($validator->fails()){
            if($validator->errors()->has('country')){
                return redirect()->back()->with(['notify_error' => 'Country is required']);
            }elseif( $validator->errors()->has('district')){
                return redirect()->back()->with(['notify_error' => 'district is required']);
            }elseif( $validator->errors()->has('city')){
                return redirect()->back()->with(['notify_error' => 'city is required']);
            }elseif( $validator->errors()->has('postal_code')){
                return redirect()->back()->with(['notify_error' => 'Zip | Postal Code is required']);
            }
        }
        $validated = $validator->validated();
        $shipping_details = ShippingDetails::select('country', 'district', 'city', 'postal_code', 'price')
            ->where('country', '=', strtolower($validated['country']))
            ->where('district', '=', strtolower($validated['district']))
            ->where('city', '=', strtolower($validated['city']))
            ->where('postal_code', '=', strtolower($validated['postal_code']))
            ->first();
        if($shipping_details == null){
            return redirect()->back()->with([['notify_error' => 'Can not find shipping details']]);
        }else{
            $shipping = [
                'country' => $shipping_details->country,
                'district' => $shipping_details->district,
                'city' => $shipping_details->city,
                'postal_code' => $shipping_details->postal_code,
                'price' => $shipping_details->price,
            ];
            setcookie('shipping-details', json_encode(array($shipping)), time() + (86400 * 30), "/");
            return redirect()->back()->with(['notify_success' => 'Shipping details added']);
        }

    }
}
