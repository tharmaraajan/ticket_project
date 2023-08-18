<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    use HasFactory;

    protected $fillable = [
        'titles',
        'text_descriptions',
        'priority',
        'status',
        'user_id',
        'agent_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function files()
    {
        return $this->hasMany(Files::class);
    }

    public function label()
    {
        return $this->belongsToMany(Labels::class, 'ticket_label', 'ticket_id', 'label_id');
    }

    public function category()
    {
        return $this->belongsToMany(Categories::class, 'ticket_category', 'ticket_id', 'category_id');
    }

    public function priority()
    {
        return $this->belongsTo(Priorities::class);
    }

    public function comments()
    {
        return $this->hasMany(TicketComments::class);
    }
}
