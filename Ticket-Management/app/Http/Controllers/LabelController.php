<?php

namespace App\Http\Controllers;

use App\Models\Labels;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    public function index()
    {
        if (auth()->user()->roles == 'Administrator')
        {
            return view('label.index');
        }
    }

    public function create()
    {
        if (auth()->user()->roles == 'Administrator')
        {
            return view('label.create');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|min:3|max:255',
        ]);

        Labels::create(['labels_name' => $request->label]); //insert into `labels` (`labels_name`, `updated_at`, `created_at`) values (?, ?, ?)

        return back()->with('success', 'Successfully label created...!!');
    }

    public function edit(Labels $label)
    {
        if (auth()->user()->roles == 'Administrator')
        {
            return view('label.edit', compact('label'));
        }
    }

    public function update(Request $request, Labels $label)
    {
        $request->validate([
            'label' => 'required|min:3|max:255'
        ]);

        $label->update([
            'labels_name' => $request->label,
        ]); //update `labels` set `labels_name` = ?, `labels`.`updated_at` = ? where `id` = ?

        return to_route('label.index')->with('success', 'Label updated...!!');
    }

    public function destroy(Labels $label)
    {
        $label->delete();   ////delete from `labels` where `id` = ?

        return to_route('label.index')->with('success', 'Label deleted...!!');
    }
}
