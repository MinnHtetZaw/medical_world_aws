<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YoutubeLink extends Model
{
    use HasFactory;

    protected $fillable = ['youtube_title', 'youtube_link'];

}
