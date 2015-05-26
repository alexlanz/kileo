@extends('pupil.panel')

@section('panel')
    <h2>Exercises</h2>

    @if ( ! $exercises->count() )
        <p>There are no exercises available for you.</p>
    @else
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach( $exercises as $exercise )
                <tr>
                    <td>{{ $exercise->name }}</td>
                    <td>{{ $exercise->description }}</td>
                    <td>
                        <a href="{{ route('pupil.exercise.show', $exercise->id) }}" class="btn btn-default btn-success btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Make</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
        

@endsection