<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name',
        'location',
        'tickets_id',
    ];

    public function ticket()
    {
        return $this->belongsTo(Tickets::class);
    }
}
