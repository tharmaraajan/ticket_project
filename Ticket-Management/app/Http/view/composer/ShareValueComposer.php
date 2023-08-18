<?php

namespace App\Http\view\composer;

use App\Models\Categories;
use App\Models\Labels;
use App\Models\Priorities;
use App\Models\Tickets;
use App\Models\User;
use Illuminate\view\View;
use Illuminate\Support\Facades\Session;

class ShareValueComposer
{
    public function compose(View $view)
    {
        $view->with('categories', Categories::all());   //select * from `categories`
        $view->with('labels', Labels::all());   //select * from `labels`
        $view->with('priorities', Priorities::all());   //select * from `priorities`
        $view->with('users', User::paginate(10));   //select count(*) as aggregate from `users`, select * from `users` limit 10 offset 0
        Session::put('total_ticket_count', Tickets::count());   //select count(*) as aggregate from `tickets`
        Session::put('open_ticket_count', Tickets::where('status', 'open')->count());   //select count(*) as aggregate from `tickets` where `status` = 'open'
        Session::put('closed_ticket_count', Tickets::where('status', 'close')->count());       //select count(*) as aggregate from `tickets` where `status` = 'close'
    }
}
