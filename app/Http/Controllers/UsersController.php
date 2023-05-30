<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
{
    public function delete()
    {
        if (!Gate::allows('is_admin')) {
            abort(403);
        }
    }

    public function show(User $user, Admin $admin)
    {
        
        // $response = Gate::inspect('is_user');
        // dd($response);

        // if (Gate::check('is_admin')) {
        //     dd(1);
        // }
        // dd(2);

        // if (Gate::forUser($admin::first())->allows('is_user')) {
        // }

        // if (Gate::denies('is_user')) {
        //     dd('Loi');
        //     abort(403);
        // }
        // dd('show');
    }
}
