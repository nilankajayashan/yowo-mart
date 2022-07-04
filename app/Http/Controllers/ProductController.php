<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($product_id){
        $product = Product::find($product_id);
        return view('pages.product_details',[
            'product' => $product,
        ]);
    }

    public function findProducts($category, Request $request){
        if (!isset($category) || $category == null){
            return redirect()->back()->with(['error' => 'Can not identify category']);
        }else{
            $empty = false;
            $filtered_lists = [];
            $filtered_list = [];
            if(lcfirst($category) == "all"){
                $all_products = Product::all();
                $all_products_list = [];
                foreach ($all_products as $product) {
                    array_push($all_products_list, $product->product_id);
                }
                if (count($all_products_list)>0){
                    array_push($filtered_lists, $all_products_list);
                }else{
                    $empty = true;
                }
            }else{
                $category_id = (Category::where('name', '=', $category)->first());
                $all_products = Product::all();
                $category_matched_list = [];
                foreach ($all_products as $product){
                    if ( $product->categories == $category_id->category_id){
                       array_push($category_matched_list, $product->product_id);
                    }

                }
                if (count($category_matched_list)>0){
                    array_push($filtered_lists, $category_matched_list);
                }else{
                    $empty = true;
                }
            }
            //search
            if ($request->search != null){
                $searched_products_list = [];
                $searched_products = Product::where('name', 'like', '%'.$request->search.'%')->get();
                foreach ($searched_products as $product){
                    array_push($searched_products_list, $product->product_id);
                }
                if (count($searched_products_list)>0){
                    array_push($filtered_list,$searched_products_list);
                }else{
                    $empty = true;
                }
            }
            //price filter
            if ($request->price_min != null && $request->price_max != null && $request->price_max > $request->price_min && $request->price_min < $request->price_max){
                $price_filtered_products_list = [];
                $price_filtered_products = Product::where('unit_price', '>', $request->price_min)->where('unit_price', '<', $request->price_max)->get();
                foreach ($price_filtered_products as $product){
                    array_push($price_filtered_products_list, $product->product_id);
                }
                if (count($price_filtered_products_list) > 0){
                    array_push($filtered_list, $price_filtered_products_list);
                }else{
                    $empty = true;
                }
            }

            if ($empty){
                $filtered_list = [];
            }else {
                $filtered_list = call_user_func_array('array_intersect', $filtered_lists);
            }
            if (isset($request->per_page)){
                $_COOKIE['per_page'] = $request->per_page;
                $per_page = $request->per_page;
            }elseif (isset($_COOKIE['per_page']) && $_COOKIE['per_page'] !== null){
                $per_page = $_COOKIE['per_page'];
            }else{
                $per_page = 5;
            }
            $products = Product::whereIn('product_id', $filtered_list)->paginate($per_page);

            if ($category == 'all'){
                $categories = Category::where('parent_id', '=', 0)->where('show_menu', '=', 1)->get();
            }else{
                $selected_category = Category::where('name', '=', $category)->first();
                $categories = Category::where('parent_id', '=', $selected_category->category_id)->where('show_menu', '=', 1)->get();
            }
            return view('pages.find_products', [
                'products' => $products,
                'categories' => $categories,
            ]);
        }
    }
}
