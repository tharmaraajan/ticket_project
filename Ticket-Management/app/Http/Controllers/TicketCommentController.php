<?php

namespace App\Http\Controllers;

use App\Models\TicketComments;
use Illuminate\Http\Request;
use App\Models\Tickets;
use Illuminate\Support\Facades\DB;

class TicketCommentController extends Controller
{
    public function index(Tickets $ticket)
    {
        $comments = TicketComments::where('ticket_id', $ticket->id)->paginate(5);   //select count(*) as aggregate from `ticket_comments` where `ticket_id` = ? limit 5 offset 0

        return view('comments.index', compact('ticket', 'comments'));
    }

    public function store(Tickets $ticket, Request $request)
    {
        $request->validate(['comment' => 'required|min:5|max:255']);

        $comment = new TicketComments;
        $comment->comments = $request->comment;
        $comment->ticket_id = $ticket->id;
        $comment->user_id = $ticket->user->id;
        $comment->save();   //insert into `ticket_comments` (`comments`, `ticket_id`, `user_id`, `updated_at`, `created_at`) values (?, ?, ?, ?, ?)

        return back();
    }
}
