@extends('teacher.panel')

@section('menu')
    <li><a href="{{ route('teacher.classes.exercises.index', [$exercise->schoolClass->id]) }}">Exercises</a></li>
@endsection

@section('page-scripts')
@if ( $exercise->type == "math" )
<script type="text/javascript" src="{{URL::to('/')}}/js/math_results_viewer.js"></script>
@endif
@endsection

@section('panel')
    <h2> Results of {{ $exercise->name }} in {{ $exercise->schoolClass->name }} </h2>

    @if ( ! $results->count() )
        <p>No exercises have been completed.</p>
    @else
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Pupil</th>
                <th>Correct results</th>
                <th>Operations</th>
            </tr>
            </thead>
            <tbody>
            @foreach( $results as $index => $result )
                <tr>
                    <td>{{ $result->user->name }}</td>
                    <td>{{ $result->correct_results }} of {{ count($result->results) }}
                    @if( $result->correct_results == count($result->results) )
                        <span style="left:5px" class="glyphicon glyphicon-ok"></span>
                    @else
                        <span style="left:5px" class="glyphicon glyphicon-remove"></span>
                    @endif
                    </td>
                    <td><a href="#ViewResults" class="btn btn-default btn-info btn-xs" onclick="viewResults(this, {{ json_encode($result->results) }}); return false;"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span><span style="padding-left:4px">View</span></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

@endsection

