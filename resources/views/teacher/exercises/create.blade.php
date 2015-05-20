@extends('teacher.panel')

@section('panel')

    <form class="form-horizontal" role="form" method="POST" action="{{ route('teacher.classes.exercises.store', $schoolClass->id) }}">

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <h2>New Exercise
                    <span class="pull-right"><small>{{ $schoolClass->name }}</small></span>
                </h2>

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

        </div>

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="type" value="{{ $type }}">

        

        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" placeholder="Name ..." value="{{ Input::old('name') }}">
            </div>
        </div>
        <div class="form-group">
            <label for="description" class="col-sm-2 control-label">Description</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="description" name="description" placeholder="Description ..." value="{{ Input::old('description') }}">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
                    <label class="checkbox-inline">
                        <input type="checkbox" value="1" id="active" name="active" checked="checked">Active
                    </label>
            </div>
        </div>

        @yield('exercisepanel')

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default btn-primary">Save</button>
            </div>
        </div>
    </form>

@endsection
