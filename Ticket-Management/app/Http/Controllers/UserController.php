<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function PHPUnit\Framework\isFalse;

class UserController extends Controller
{
    public function index()
    {
        if (auth()->user()->roles == 'Administrator')
        {
            return view('users.index');
        }
    }

    public function create()
    {
        if (auth()->user()->roles == 'Administrator')
        {
            return view('users.create');
        }
    }

    public function store(UserRequest $request)
    {
        User::create([                              //insert into `users` (`name`, `email`, `roles`, `password`, `updated_at`, `created_at`) values (?, ?, ?, ?, ?, ?)
            'name' => $request->name,               //select * from `roles` where `name` = ? and `guard_name` = ? limit 1
            'email' => $request->email,             //select * from `model_has_roles` where `model_has_roles`.`model_id` = ? and `model_type` = ?
            'roles' => $request->role,              //insert into `model_has_roles` (`model_id`, `model_type`, `role_id`) values (?, ?, ?)
            'email_verified_at' => now(),           //select `roles`.*, `model_has_roles`.`model_id` as `pivot_model_id`, `model_has_roles`.`role_id` as `pivot_role_id`, `model_has_roles`.`model_type` as `pivot_model_type` from `roles` inner join `model_has_roles` on `roles`.`id` = `model_has_roles`.`role_id` where `model_has_roles`.`model_id` in (5) and `model_has_roles`.`model_type` = ?
            'password' => Hash::make('password'),
        ])->assignRole($request->role);

        return back()->with('success', 'Successfully user created...!!');
    }

    public function edit(User $user)
    {
        if (auth()->user()->roles == 'Administrator')
        {
            return view('users.edit', compact('user'));
        }
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:255', 'string'],
            'email' => ['required', 'min:15', 'max:255', 'email'],
            'role' => ['required'],
        ]);

        $user->update([                             //update `users` set `roles` = ?, `users`.`updated_at` = ? where `id` = ?
            'name' => $request->name,               //delete from `model_has_roles` where `model_has_roles`.`model_id` = ? and `model_type` = ?
            'email' => $request->email,             //select * from `roles` where `name` = ? and `guard_name` = ? limit 1
            'roles' => $request->role,              //select * from `model_has_roles` where `model_has_roles`.`model_id` = ? and `model_type` = ?
        ]);                                         //insert into `model_has_roles` (`model_id`, `model_type`, `role_id`) values (?, ?, ?)

        $user->syncRoles($request->role);           //select `roles`.*, `model_has_roles`.`model_id` as `pivot_model_id`, `model_has_roles`.`role_id` as `pivot_role_id`, `model_has_roles`.`model_type` as `pivot_model_type` from `roles` inner join `model_has_roles` on `roles`.`id` = `model_has_roles`.`role_id` where `model_has_roles`.`model_id` in (5) and `model_has_roles`.`model_type` = ?

        return to_route('users.index')->with('success', 'User updated...!!');
    }

    public function destroy(User $user)
    {
        $user->delete();    //delete from `model_has_roles` where `model_has_roles`.`model_id` = ? and `model_type` = ?
                            //delete from `model_has_permissions` where `model_has_permissions`.`model_id` = ? and `model_type` = ?, delete from `users` where `id` = ?
        return to_route('users.index')->with('success', 'User deleted...!!');
    }
}
