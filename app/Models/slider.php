<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class slider extends Model
{
    use MasFactory;

    protected $fillable = [
        'top_sub_heading',
        'heading',
        'bottom_sub_headding',
        'image_link',
        'more_info_link'

    ];
}
