<?php

namespace App\Http\Controllers;

use App\Todo;

class DashboardController extends Controller
{
    /**
     * Dashboard
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $todos = Todo::all()->sortByDesc('updated_at');
        return view('dashboard')->with('todos', $todos);
    }
}
