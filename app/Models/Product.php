<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'name', 'description', 'barcode', 'unit', 'stock', 'min_stock', 'price'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function logs()
    {
        return $this->hasMany(InventoryLog::class);
    }

    public function alerts()
    {
        return $this->hasMany(Alert::class);
    }
}
