<?php

namespace App\Http\Controllers;

use App\Events\TicketCreateEvent;
use App\Http\Requests\TicketRequest;
use App\Models\Files;
use App\Models\Tickets;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\TicketActivity;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class TicketsController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->roles == 'Agent') {
            $tickets = Tickets::where('agent_id', Auth::user()->id)->with('category', 'label', 'priority')->when($request->status != null, function ($q) use ($request) {
                    return $q->where('status', $request->status);
                })
                ->when($request->priority != null, function ($q) use ($request) {
                    return $q->where('priority', $request->priority);
                })
                ->when($request->category != null, function ($q) use ($request) {
                    return $q->whereRelation('category', 'categories_name', $request->category);
                })
                ->paginate(10);

        } else if (Auth::user()->roles == 'Regular user') {
            $tickets = Tickets::where('user_id', Auth::user()->id)->with('category', 'label', 'priority')->when($request->status != null, function ($q) use ($request) {
                    return $q->where('status', $request->status);
                })
                ->when($request->priority != null, function ($q) use ($request) {
                    return $q->where('priority', $request->priority);
                })
                ->when($request->category != null, function ($q) use ($request) {
                    return $q->whereRelation('category', 'categories_name', $request->category);
                })
                ->paginate(10);

        } else {
            $tickets = Tickets::with('category', 'priority', 'label')->when($request->status != null, function ($q) use ($request) {
                    return $q->where('status', $request->status);
                })
                ->when($request->priority != null, function ($q) use ($request) {
                    return $q->where('priority', $request->priority);
                })
                ->when($request->category != null, function ($q) use ($request) {
                    return $q->whereRelation('category', 'categories_name', $request->category);
                })
                ->paginate(10);
        }

        Session::put('ticket_count', $tickets->count());

        return view('tickets.view', compact('tickets'));
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(TicketRequest $request)
    {
        $ticket = Tickets::create([
            'titles' => $request->titles,
            'text_descriptions' => $request->description,
            'priority' => $request->priority,
            'status' => $request->status,
            'user_id' => Auth::user()->id,
        ]);

        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach ($files as $file) {
                $file_name = $file->getClientOriginalName();
                $file->storeAs('public', $file_name);
                Files::create([
                    'file_name' => $file_name,
                    'location' => 'storage/' . $file_name,
                    'tickets_id' => $ticket->id,
                ]);
            }
        }

        $ticket->label()->attach($request->labels);
        $ticket->category()->attach($request->categories);

        $dt = Carbon::now();
        $today_dt = $dt->toDayDateTimeString();

        $activity = [
            'ticket_id' => $ticket->id,
            'ticket_name' => $request->titles,
            'user_name' => Auth::user()->name,
            'user_role' => Auth::user()->roles,
            'status' => $request->status,
            'action' => 'created',
            'date_time' => $today_dt,
        ];

        TicketActivity::create($activity);

        event(new TicketCreateEvent($ticket));

        return back()->with('success', 'Successfully ticket created...!!');
    }

    public function edit(Tickets $ticket)
    {
        return view('tickets.edit', compact('ticket'));
    }

    public function update(TicketRequest $request, Tickets $ticket)
    {
        if (Auth::user()->roles == 'Administrator')
        {
            $agent = $request->agent;
            $status = $request->status;
        }
        else
        {
            $agent = $ticket->agent_id;
            $status = $ticket->status;
        }

        $ticket->update([
            'titles' => $request->titles,
            'text_descriptions' => $request->description,
            'priority' => $request->priority,
            'status' => $status,
            'agent_id' => $agent,
        ]);

        $ticket->label()->sync($request->labels);
        $ticket->category()->sync($request->categories);

        $dt = Carbon::now();
        $today_dt = $dt->toDayDateTimeString();

        $activity = [
            'ticket_id' => $ticket->id,
            'ticket_name' => $request->titles,
            'user_name' => Auth::user()->name,
            'user_role' => Auth::user()->roles,
            'status' => $status,
            'action' => 'updated',
            'date_time' => $today_dt,
        ];

        TicketActivity::insert($activity);

        return to_route('tickets.index')->with('success', 'Ticket updated...!!');
    }

    public function destroy(Tickets $ticket)
    {
        $ticket->label()->detach($ticket->labels);
        $ticket->category()->detach($ticket->categories);

        $dt = Carbon::now();
        $today_dt = $dt->toDayDateTimeString();

        $activity = [
            'ticket_id' => $ticket->id,
            'ticket_name' => $ticket->titles,
            'user_name' => Auth::user()->name,
            'user_role' => Auth::user()->roles,
            'status' => $ticket->status,
            'action' => 'Deleted',
            'date_time' => $today_dt,
        ];

        TicketActivity::insert($activity);

        foreach ($ticket->files as $file) {
            if (Storage::exists('public/' . $file->file_name)) {
                Storage::delete('public/' . $file->file_name);
                $file->delete();
            }
        }

        $ticket->delete();

        return to_route('tickets.index')->with('success', 'Ticket deleted...!!');
    }
}
