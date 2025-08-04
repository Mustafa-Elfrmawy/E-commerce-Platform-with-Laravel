<?php

namespace App\Url;




function my_asset($path)
{
    if (app()->environment('production')) {
        return secure_asset($path);
    }

    return asset($path);
}
