<?php

namespace App\Http\Controllers;

use App\Models\Task;

class WebTaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks', ['tasks' => $tasks]);
    }
}