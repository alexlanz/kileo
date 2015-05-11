@extends('teacher.panel')

@section('panel')
    <h2>{{ $schoolClass->name }}
        <a href="{{ route('teacher.classes.pupils.create', $schoolClass->id) }}" type="button" class="btn btn-default btn-primary pull-right"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> New Pupil</a>
    </h2>

    @if ( ! $schoolClass->pupils->count() )
        <p>You have no pupils created yet. Click the right upper button to create a new pupils.</p>
    @else
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Name</th>
                <th>Username</th>
                <th>Operations</th>
            </tr>
            </thead>
            <tbody>
            @foreach( $schoolClass->pupils as $pupil )
                <tr>
                    <td>{{ $pupil->name }}</td>
                    <td>{{ $pupil->username }}</td>
                    <td>
                        <a href="{{ route('teacher.classes.pupils.edit', [$schoolClass->id, $pupil->id]) }}" class="btn btn-default btn-success btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit</a>
                        <a href="{{ route('teacher.classes.pupils.password.show', [$schoolClass->id, $pupil->id]) }}" class="btn btn-default btn-success btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Change Password</a>

                        <form class="form-btn-inline" method="POST" action="{{ route('teacher.classes.pupils.destroy', [$schoolClass->id, $pupil->id]) }}">
                            <input name="_method" type="hidden" value="DELETE" />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <button type="submit" class="btn btn-default btn-warning btn-xs"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Remove</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

@endsection
