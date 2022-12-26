<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Mechanic;
use App\Models\Phone;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test()
    {
        // One To One
        // $phone = User::find(1)->phone;
        // $user = Phone::find(1)->user;

        // One To Many
        $comments = Post::find(1)->comments()->where('detail', '456')->first();
        // $posts = Comment::find(1)->post;

        // latestOfMany
        // $latestOfMany = User::find(1)->latestOrder;

        // oldestOrder
        // $oldestOrder = User::find(1)->oldestOrder;

        // largestOrder
        // $largestOrder = User::find(1)->largestOrder;

        // hasOneThrough - hasManyThrough
        /*
            mechanics
                id - integer
                name - string
            cars
                id - integer
                model - string
                mechanic_id - integer 
            owners
                id - integer
                name - string
                car_id - integer
        */
        // $carOwner = Mechanic::find(1)->carOwner;

        // $user = User::find(1);
        // dd($user->roles);
        // foreach ($user->roles as $role) {
        // dd($role->pivot->pivotParent->name);
        // }
    }
}
