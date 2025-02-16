<?php

use App\Models\Task;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function ()  {
    return view('index', [
        'tasks' => Task::latest()->get(),
    ]);
})->name('tasks.index');

Route::get('/tasks/{id}', function ($id) {

        return view('show',[
            'task' => Task::findOrFail($id),
        ]);
})->name('tasks.show');
