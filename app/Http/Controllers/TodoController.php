<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     *  To check
     */
    public function update(User $user, Todo $todo)
    {
        // To check user is authorized to update todos
        if ($user->can('update', $todo)) {
        }
        //You can also authorize a user using helper function as below.
        $this->authorize('update', $todo);
    }
}
