<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Task;

class WebTaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        $posts = Post::all();
        $postId = request('edit');
        $post = $postId ? Post::find((int)$postId) : null;
        return view('tasks', ['tasks' => $tasks, 'posts' => $posts, 'post' => $post]);
    }
}