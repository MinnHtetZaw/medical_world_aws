<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacebookLink extends Model
{
    use HasFactory;

    protected $fillable= ['facebook_title','facebook_description', 'facebook_photo', 'facebook_link'];
}
