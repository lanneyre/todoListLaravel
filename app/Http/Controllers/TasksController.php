<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TasksController extends Controller
{

    public function show(){
        $tasks = Tasks::orderBy('created_at', 'asc')->get();
        // var_dump($tasks);
        return view('tasks', ["tasks" => $tasks]);
    }

    public function insert(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if($validator->fails()){
            return redirect('/')->withInput();
        }

        $task = new Tasks();
        $task->name = $request->name;
        $task->save();

        return redirect('/');
    }

    public function delete(Tasks $task){
        $task->delete();
        return redirect('/');
    }
}
