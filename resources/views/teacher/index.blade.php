@extends('teacher.panel')

@section('panel')
    <h2>Classes
        <a href="{{ route('teacher.classes.create') }}" type="button" class="btn btn-default btn-primary pull-right"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> New Class</a>
    </h2>

    @if ( ! $schoolClasses->count() )
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
            @foreach( $schoolClasses as $schoolClass )
                <tr>
                    <td>{{ $schoolClass->name }}</td>
                    <td>
                        <a href="{{ route('teacher.classes.index', $schoolClass->id) }}" class="btn btn-default btn-info btn-xs"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Pupils</a>
                        <a href="{{ route('teacher.classes.edit', $schoolClass->id) }}" class="btn btn-default btn-success btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit</a>
                        <a href="{{ route('teacher.classes.remove', $schoolClass->id) }}" class="btn btn-default btn-warning btn-xs"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Remove</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

@endsection
