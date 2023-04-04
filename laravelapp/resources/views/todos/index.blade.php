@extends('layouts.app')
@section('styles')
<style>
    .buttons {
        color:#fff;
        text-decoration:none;
    }
</style>
@endsection
@section('content')
<div class="container">
    <div class="modal" id="viewTodo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Todo View</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <table class="table">
                <tr><td>Title</td><td id="view_title"></td></tr>
                <tr><td>Descripton</td><td id="view_desc"></td></tr>
                <tr><td>Status</td><td id="view_is_com"></td></tr>
            </table>
        </div>
        </div>
    </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{Session::get('success')}}
            </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Todos Dashboard') }}</div>

                <div class="card-body">
                @if(count($todos)>0)
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($todos as $todo)
                        <tr>
                        <th scope="row">{{$loop->index+1}}</th>
                        <td>{{$todo->title}}</td>
                        <td>{{$todo->description}}</td>
                        @if($todo->is_completed == 0)
                            <td>Not Completed</td>
                        @else
                            <td>Completed</td>
                        @endif
                        <td>
                        <a class="buttons view" id='{{$todo->id}}'><button class="btn btn-success">View</button></a>
                        <a class="buttons" href="{{route('todos.edit', $todo->id)}}"><button class="btn btn-warning">Update</button></a>
                        <a class="buttons delete" id='{{$todo->id}}'><button class="btn btn-danger">Delete</button></a>
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                    @else
                    <h4>No todos to show. Create one here <a href="{{route('todos.create')}}">Create</a></h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $(document).on('click', '.view', function() {
            var id = $(this).attr('id');
            var is_completed = '';
            $.get( "view/" + id, function( data ) {
                // $(".modal-body").html(data.html);
                var data = JSON.parse(data);
                $('#view_title').text(data.title);
                $('#view_desc').text(data.description);
                if(data.is_completed == 0) {
                    is_completed = 'Completed';
                } else {
                    is_completed = 'Incompleted';
                }
                $('#view_is_com').text(is_completed);
                $('#viewTodo').modal('show');
            });
        })

        $(document).on('click', '.delete', function() {
            var id = $(this).attr('id');
            $.get( "delete/" + id, function( data ) {
                window.location.reload();
            })
        })
    })
</script>
@endsection