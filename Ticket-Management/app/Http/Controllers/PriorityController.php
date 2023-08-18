<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Priorities;

class PriorityController extends Controller
{
    public function index()
    {
        if (auth()->user()->roles == 'Administrator')
        {
            return view('priority.index');
        }
    }

    public function create()
    {
        if (auth()->user()->roles == 'Administrator')
        {
            return view('priority.create');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'priority' => 'required|min:3|max:255',
        ]);

        Priorities::create(['priority_name' => $request->priority]);    //insert into `priorities` (`priority_name`, `updated_at`, `created_at`) values (?, ?, ?)

        return back()->with('success', 'Successfully priority created...!!');
    }

    public function edit(Priorities $priority)
    {
        if (auth()->user()->roles == 'Administrator')
        {
            return view('priority.edit', compact('priority'));
        }
    }

    public function update(Request $request, Priorities $priority)
    {
        $request->validate([
            'priority' => 'required|min:3|max:255'
        ]);

        $priority->update([
            'priority_name' => $request->priority,
        ]); //update `priorities` set `priority_name` = ?, `priorities`.`updated_at` = ? where `id` = ?

        return to_route('priority.index')->with('success', 'Priority updated...!!');
    }

    public function destroy(Priorities $priority)
    {
        $priority->delete();    ////delete from `priorities` where `id` = ?

        return to_route('priority.index')->with('success', 'Priority deleted...!!');
    }
}
