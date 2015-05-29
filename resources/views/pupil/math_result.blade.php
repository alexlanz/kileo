@extends('pupil.panel')

@section('panel')
    <h2>Math Sheet - Results
        <span class="pull-right"><a href="{{ route('pupil.exercise.show', $exercise->id) }}" class="btn btn-primary">Retry</a></span>
    </h2>

    <div class="row">
        <div class="result-info col-xs-12">
            Number of questions: {{ count($sheet) }}<br />
            Number of correct answers: {{ $correct_results }}
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Calculation</th>
            <th>Result</th>
            <th>Correction</th>
        </tr>
        </thead>
        <tbody>
        @foreach( $sheet as $index => $task )
            <tr>
                <td class="text-right">{{ $task->getNum1() }} <strong>{{ $task->getOperation() }}</strong> {{ $task->getNum2() }} = </td>
                <td>
                    {{ $task->getResult() }}
                </td>
                <td>
                    @if( $task->isCorrect() )
                        <span class="glyphicon glyphicon-ok"></span>
                    @else
                        <span class="glyphicon glyphicon-remove"></span>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection