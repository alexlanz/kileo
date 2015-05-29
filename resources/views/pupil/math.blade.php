@extends('pupil.panel')

@section('panel')
    <form role="form" method="POST" action="{{ route('pupil.exercise.post', $exercise->id) }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <h2>Math Sheet
            <input type="submit" value="Done" class="pull-right btn btn-primary" />
        </h2>

        @include('partials.errors')

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Calculation</th>
                <th>Result</th>
            </tr>
            </thead>
            <tbody>
            @foreach( $sheet as $index => $task )
                <tr>
                    <td class="text-right">{{ $task->getNum1() }} <strong>{{ $task->getOperation() }}</strong> {{ $task->getNum2() }} = </td>
                    <td>
                        <input type="hidden" name="task{{ $index }}-num1" value="{{ $task->getNum1() }}" />
                        <input type="hidden" name="task{{ $index }}-num2" value="{{ $task->getNum2() }}" />
                        <input type="hidden" name="task{{ $index }}-operation" value="{{ $task->getOperation() }}" />
                        <input type="text" name="task{{ $index }}-result" value="{{ $task->getResult() }}" />
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </form>

@endsection