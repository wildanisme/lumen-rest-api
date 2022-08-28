<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $guarded = [];

    public function article()
    {
      return $this->hasMany(Article::class);
    }
}
