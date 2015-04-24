@extends('teacher.panel')

@section('panel')

    <form class="form-horizontal" role="form" method="POST" action="{{ route('teacher.classes.pupils.password.update', [$schoolClass->id, $pupil->id]) }}">
        <input name="_method" type="hidden" value="PUT" />

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <h2>Change Password of Pupil
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

        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password ...">
            </div>
        </div>
        <div class="form-group">
            <label for="password_confirmation" class="col-sm-2 control-label">Password confirmation</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Password confirmation ...">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default btn-primary">Save</button>
            </div>
        </div>
    </form>

@endsection
