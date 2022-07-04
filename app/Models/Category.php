<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'parent_id',
        'show_menu',
        'icon',
    ];
    protected $primaryKey = 'category_id';
}
