<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    protected $table = 'industries';
    protected $fillable = ['name'];

    public function posts()
    {
        return $this->hasMany(Post::class, 'industry', 'id');
    }
}
