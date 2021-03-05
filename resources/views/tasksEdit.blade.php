@extends('layout.app')

@section('content')
    <div class="panel-body">
        @include('common.errors')

        <form action="{{ url('tasks') }}" method="post" class="form-horizontal">
            {{ csrf_field() }}
            {!! method_field('PUT') !!}
            <input type="hidden" name="id" value="{{ $taskToEdit->id }}">
            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">Task</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="task" name="name" value="{{ $taskToEdit->name }}">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button class="btn btn-default">
                        <i class="fa fa-plus"></i> Edit Task
                    </button>
                </div>
            </div>
        </form>

        @if (count($tasks)>0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Current Tasks
            </div>
            <div class="panel-body">
                <table class="table table-striped task-table">
                    <thead>
                        <th>Task</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                        <tr>
                            <td class="table-text">
                                <div>{{$task->name}}</div>
                            </td>
                            <td>
                                <form action="{{ url('tasks/'.$task->id) }}" method="post">
                                    {{ csrf_field() }}
                                    {!! method_field('DELETE') !!}
                                    <button class="btn btn-danger">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>

                            <td>
                                <form action="{{ url('tasks/'.$task->id) }}" method="GET">
                                    <button class="btn btn-danger">
                                        <i class="fa fa-trash"></i> Edit
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
@endsection
