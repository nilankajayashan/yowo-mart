<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WishlistController extends Controller
{
    public function addWishlist(Request $request){
        $Validator = Validator::make($request->all(),[
            'product_id' => 'required',
        ]);
        if ($Validator->fails()){
            if ($Validator->errors()->has('product_id')){
                return redirect()->back()->with(['notify_error' => 'Can not identify product']);
            }else{
                return redirect()->back()->with(['notify_error' => 'Something went wrong!']);

            }
        }
        $validated = $Validator->validated();
        if (session()->has('auth_user')){
            $exist_wishlist = Wishlist::where('user_id', '=', session()->get('auth_user')->user_id)->first();
            if ($exist_wishlist == null){
                $new_wishlist = new Wishlist();
                $new_wishlist->user_id = session()->get('auth_user')->user_id;
                $wishlist = [$validated['product_id']];
                $new_wishlist->wishlist = json_encode($wishlist);
                $new_wishlist->save();
                $product = Product::select('name')->where('product_id', '=', $validated['product_id'])->first();
                return redirect()->back()->with(['notify_success' => $product->name .' added to your wishlist successfully']);
            }else{
                $wishlist = json_decode($exist_wishlist->wishlist);
                if (!in_array($validated['product_id'], $wishlist)){
                    array_push($wishlist,$validated['product_id']);
                }else{
                    $product = Product::select('name')->where('product_id', '=', $validated['product_id'])->first();
                    return redirect()->back()->with(['notify_error' => $product->name .' exist in your wishlist']);
                }
                Wishlist::where('user_id', '=', session()->get('auth_user')->user_id)
                    ->update(['wishlist' => json_encode($wishlist)]);
                $product = Product::select('name')->where('product_id', '=', $validated['product_id'])->first();
                return redirect()->back()->with(['notify_success' => $product->name .' added to your wishlist successfully']);
            }

        }else{
            return redirect()->back()->with(['notify_error' => 'You must login to add Product to your wishlist']);
        }
    }
    public function removeWishlistProduct(Request $request){
        $Validator = Validator::make($request->all(),[
            'product_id' => 'required',
        ]);
        if ($Validator->fails()){
            if ($Validator->errors()->has('product_id')){
                return redirect()->back()->with(['notify_error' => 'Can not identify product']);
            }else{
                return redirect()->back()->with(['notify_error' => 'Something went wrong!']);

            }
        }
        $validated = $Validator->validated();
        $wishlist = Wishlist::where('user_id', '=', session()->get('auth_user')->user_id)->first();
        $wishlist_products = json_decode($wishlist->wishlist);
        if (($index = array_search($validated['product_id'], $wishlist_products)) !== false){
//           delete $wishlist_products[$index];
            array_splice($wishlist_products, $index, 1);
            Wishlist::where('user_id', '=', session()->get('auth_user')->user_id)
                ->update(['wishlist' => json_encode($wishlist_products)]);
            $product = Product::select('name')->where('product_id', '=', $validated['product_id'])->first();
            return redirect()->back()->with(['notify_success' => $product->name .' removed from your wishlist successfully']);
        }
        $product = Product::select('name')->where('product_id', '=', $validated['product_id'])->first();
        return redirect()->back()->with(['notify_error' => $product->name .' can not identify in your wishlist']);
    }
}
