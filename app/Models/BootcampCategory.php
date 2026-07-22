<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BootcampCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'thumbnail',
    ];

    public function parentCategory(){
        return $this->belongsTo(Category::class,'category_id');
    }
}
