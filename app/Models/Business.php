<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'address'];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function settings()
    {
        return $this->hasOne(Setting::class);
    }
}
