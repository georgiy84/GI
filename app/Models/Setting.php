<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['business_id', 'notify_email', 'notify_sms', 'notify_whatsapp'];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
