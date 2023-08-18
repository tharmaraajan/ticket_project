<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Priorities extends Model
{
    use HasFactory;

    protected $fillable = [
        'priority_name'
    ];

    public function ticket()
    {
        return $this->hasMany(Tickets::class);
    }
}
