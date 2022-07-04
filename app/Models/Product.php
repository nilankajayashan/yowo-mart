<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable =[
        'product_id',
        'model',
        'bar_code',
        'qr_code',
        'name',
        'description',
        'quantity',
        'unit_price',
        'weight',
        'main_image',
        'additional_images',
        'dimensions',
        'categories',

    ];
    protected $primaryKey = 'product_id';
}
