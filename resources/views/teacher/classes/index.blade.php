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
                <th>Operations</th>
            </tr>
            </thead>
            <tbody>
            @foreach( $schoolClass->pupils as $pupil )
                <tr>
                    <td>{{ $pupil->name }}</td>
                    <td></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

@endsection
