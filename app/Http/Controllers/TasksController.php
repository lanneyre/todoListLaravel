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
        return view('tasks', ["tasks" => $tasks]);
    }

    public function edit(Tasks $task){
        $taskToEdit = Tasks::find($task->id);
        $tasks = Tasks::orderBy('created_at', 'asc')->get();
        return view('tasksEdit', ["tasks" => $tasks, "taskToEdit" => $taskToEdit]);
    }

    public function saveEdit(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'id' => 'required',
        ]);

        if($validator->fails()){
            return redirect('/')->withInput($request->except('key'))
            ->withErrors($validator);
        }

        $task = Tasks::find($request->id);
        $task->name = $request->name;
        $task->save();
        return redirect('/');
    }

    public function insert(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);
        if($validator->fails()){
            return redirect('/')->withInput($request->except('key'))
            ->withErrors($validator);
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
