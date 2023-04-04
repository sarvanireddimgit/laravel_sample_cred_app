@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Todos App') }}</div>

                <div class="card-body">
                <form method="post" action="{{route('todos.update')}}">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{$todo->title}}" placeholder="Enter Title">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control" name="description">{{$todo->description}}</textarea>
                    </div>
                    <div class="form-group pt-2">
                    <input type="hidden" class="form-control" id="d" name="id" value="{{$todo->id}}">
                        <input type="submit" name="submt" value="Submit" class="btn btn-primary">
                    </div>
                    </form>
                    @if(Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{Session::get('success')}}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
