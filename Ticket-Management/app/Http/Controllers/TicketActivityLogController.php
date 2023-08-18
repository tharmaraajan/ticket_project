<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketActivity;

class TicketActivityLogController extends Controller
{
    public function index()
    {
        $logs = TicketActivity::paginate(10);   //select count(*) as aggregate from `ticket_activities`, select * from `ticket_activities` limit 10 offset 0

        if (auth()->user()->roles == 'Administrator')
        {
            return view('logs.index', compact('logs'));
        }
    }
}
