<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $fillable = [
        'id',
        'statusBox_id',
        'sender',
        'receiver',
        'address',
        'telepon',
        'report_id',
        'date_sent',
        'subtotal',
    ];


    public function item()
    {
        return $this->hasMany(Item::class);
    }
    public function statusBox()
    {
        return $this->belongsTo(StatusBox::class);
    }
}
