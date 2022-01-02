<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusBox extends Model
{
    use HasFactory;
    protected $fillable =
    [
        "name",
    ];

    public function box()
    {
        return $this->hasMany(Box::class);
    }
}
