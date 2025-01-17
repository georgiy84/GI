<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'address', 'description', 'logo', 'user_id'];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function settings()
    {
        return $this->hasOne(Setting::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
