<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ShopDetails;
use App\Models\shopInfo;
use App\Models\WebColor;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\View\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(){
        $name = ShopDetails::where('component', '=', 'name')->first();
        $address = ShopDetails::where('component', '=', 'address')->first();
        $email = ShopDetails::where('component', '=', 'email')->first();
        $mobile = ShopDetails::where('component', '=', 'mobile')->first();
        $facebook = ShopDetails::where('component', '=', 'facebook')->first();
        $google = ShopDetails::where('component', '=', 'google')->first();
        $categories = Category::select('category_id', 'name', 'parent_id')->where('show_menu', '=', 1)->where('status', '=', 1)->get();

        //color pallet
        $primary_button_color = WebColor::where('component', '=', 'primary_button_color')->first();
        $secondary_button_color = WebColor::where('component', '=', 'secondary_button_color')->first();
        $ternary_button_color = WebColor::where('component', '=', 'ternary_button_color')->first();

        $pending_status_color = WebColor::where('component', '=', 'pending_status_color')->first();
        $processing_status_color = WebColor::where('component', '=', 'processing_status_color')->first();
        $processed_status_color = WebColor::where('component', '=', 'processed_status_color')->first();
        $shipped_status_color = WebColor::where('component', '=', 'shipped_status_color')->first();
        $completed_status_color = WebColor::where('component', '=', 'completed_status_color')->first();
        $failed_status_color = WebColor::where('component', '=', 'failed_status_color')->first();
        $success_status_color = WebColor::where('component', '=', 'success_status_color')->first();

        $title_bar_color = WebColor::where('component', '=', 'title_bar_color')->first();

        view()->share([
            'categories' => $categories,
            'shop_name' => $name->value,
            'shop_address' => $address->value,
            'shop_email' => $email->value,
            'shop_mobile' => $mobile->value,
            'shop_facebook' => $facebook->value,
            'shop_google' => $google->value,

            'primary_button_color' => $primary_button_color->name,
            'secondary_button_color' => $secondary_button_color->name,
            'ternary_button_color' => $ternary_button_color->name,

            'pending_status_color' => $pending_status_color->name,
            'processing_status_color' => $processing_status_color->name,
            'processed_status_color' => $processed_status_color->name,
            'shipped_status_color' => $shipped_status_color->name,
            'completed_status_color' => $completed_status_color->name,
            'failed_status_color' => $failed_status_color->name,
            'success_status_color' => $success_status_color->name,

            'title_bar_color' => $title_bar_color->name,
        ]);
    }

}
