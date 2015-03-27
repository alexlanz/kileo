@extends('teacher.teacherpanel')

@section('panel')
    <h2>Classes
        <a href="{{ url ('/teacher/classes/create') }}" type="button" class="btn btn-default btn-primary pull-right"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> New Class</a>
    </h2>


    @if ( !$classes->count() )
        <p>You have no classes created yet. Click the right upper button to create a new class.</p>
    @else
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Name</th>
                <th>Operations</th>
            </tr>
            </thead>
            <tbody>
            @foreach( $classes as $class )
                <tr>
                    <td>{{ $class->name }}</td>
                    <td>
                        <a href="{{ URL::to('teacher/classes/' . $class->id . '/edit') }}" class="btn btn-default btn-success btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit</a>
                        <a href="{{ URL::to('teacher/classes/' . $class->id . '/remove') }}" class="btn btn-default btn-warning btn-xs"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Remove</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

@endsection
