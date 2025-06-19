<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seniority extends Model
{
    protected $table = 'seniority';
    protected $fillable = ['name'];

    public function posts()
    {
        return $this->hasMany(Post::class, 'seniority', 'id');
    }
}
