<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FSclass extends Model
{
    use HasFactory;

    public static function find($dato){        
        if (!file_exists($path = resource_path("posts/{$dato}.html"))) {
            abort(404);
        }
        return cache()->remember("posts.{$dato}", 5 , fn() => file_get_contents($path));

    }
}
