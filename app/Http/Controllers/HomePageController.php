<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\shopInfo;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index(){
        $latest_products = $this->latestProducts(20);
        return view('index',[
            'latest_products' => $latest_products,
        ]);
    }

    private function latestProducts($count)
    {
        return Product::select('product_id','name','unit_price','categories','main_image')
            ->limit($count)
            ->get();
    }
}
