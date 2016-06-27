@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New Task
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                            <!-- New Task Form -->
                    <form action="{{ url('task') }}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                                <!-- Task Name -->
                        <div class="form-group">
                            <label for="task-name" class="col-sm-3 control-label">Task</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="task-name" class="form-control" value="{{ old('task') }}"placeholder="name">
                                <input type="text" name="duration" id="task-duration" class="form-control" placeholder="duration">

                            </div>
                        </div>

                        <!-- Add Task Button -->
                        <div class="container">
                            <div class="row">
                                <div class='col-sm-6'>
                                    <div class="form-group">
                                        <div class='input-group date' id='datetimepicker1'>
                                            <input placeholder="start date" type='text' name="date" class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                                        </div>
                                    </div>
                                </div>
                                <script type="text/javascript">
                                    $(function () {
                                        $('#datetimepicker1').datepicker();

                                    });
                                </script>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Add Task
                                </button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>

            <!-- Current Tasks -->
            @if (count($tasks) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        To Do Tasks
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead>
                            <th>Task</th>
                            <th>Duration</th>
                            <th>Start Date</th>
                            </thead>
                            <tbody>
                            @foreach ($tasks as $task)
                                @if($task->status== 'todo')
                                <tr>
                                    <td class="table-text"><div>{{ $task->name }}</div></td>
                                    <td class="table-text"><div>{{ $task->duration }}</div></td>
                                    <td class="table-text"><div>{{ $task->startDate }}</div></td>

                                    <td>
                                        <form action="{{url('task/' . $task->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button type="submit" id="delete-task-{{ $task->id }}" class="btn btn-danger">
                                                <i class="fa fa-btn fa-trash"></i>Delete
                                            </button>

                                        </form>
                                    </td>

                                    <td>
                                        <form action="{{url('taskDone/' . $task->id)}}" method="POST">
                                            {{ csrf_field() }}

                                            <button type="submit" id="done-task-{{ $task->id }}" class="btn ">
                                                <i class="fa fa-btn"></i>Done
                                            </button>


                                        </form>
                                    </td>

                                </tr>
                            

                                @endif

                            @endforeach
                            </tbody>

                        </table>

                    </div>
                </div>
            @endif

            @if (count($tasks) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Done Tasks
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead>
                            <th>Task</th>
                            <th>Duration</th>
                            <th>Start Date</th>
                            </thead>
                            <tbody>
                            @foreach ($tasks as $task)
                                @if($task->status== 'done')
                                    <tr>
                                        <td class="table-text"><div>{{ $task->name }}</div></td>
                                        <td class="table-text"><div>{{ $task->duration }}</div></td>
                                        <td class="table-text"><div>{{ $task->startDate }}</div></td>
                                        <!-- Task Delete Button -->
                                        <td>
                                            <form action="{{url('task/' . $task->id)}}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" id="delete-task-{{ $task->id }}" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i>Delete
                                                </button>

                                            </form>

                                        </td>
                                        <td>

                                            <form action="{{url('taskToDo/' . $task->id)}}" method="POST">
                                                {{ csrf_field() }}

                                                <button type="submit" id="done-task-{{ $task->id }}" class="btn ">
                                                    <i class="fa fa-btn"></i>ToDo
                                                </button>


                                            </form>
                                        </td>
                                    </tr>
                                @endif

                            @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            @endif



        </div>
    </div>
@endsection


