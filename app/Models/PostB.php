<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostB extends DynamicModel
{
    use HasFactory;

    protected $table = 'posts';
}
