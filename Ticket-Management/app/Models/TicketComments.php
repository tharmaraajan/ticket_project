<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketComments extends Model
{
    use HasFactory;

    protected $fillable = [
        'comments'
    ];

    public function ticket()
    {
        return $this->belongsTo(Tickets::class);
    }
}
