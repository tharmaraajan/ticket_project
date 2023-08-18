<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = [
        'categories_name'
    ];

    public function ticket()
    {
        return $this->belongsToMany(Tickets::class);
    }
}
