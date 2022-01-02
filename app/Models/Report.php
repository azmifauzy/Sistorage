<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable =
    [
        "tahun",
        "bulan",
    ];
    public function box()
    {
        return $this->hasMany(Box::class);
    }
}
