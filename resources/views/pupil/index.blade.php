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
                <th>Operations</th>
            </tr>
            </thead>
            <tbody>
            @foreach( $exercises as $exercise )
                <tr>
                    <td>{{ $exercise->name }}</td>
                    <td>
                        <a href="" class="btn btn-default btn-success btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Make</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
        

@endsection