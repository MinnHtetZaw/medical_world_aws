<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromotionPhoto extends Model
{
    use HasFactory;

    protected $fillable = ['promotionphoto_title', 'promotionphoto_photo'];
}
