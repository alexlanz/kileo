@extends('pupil.panel')

@section('panel')
    <h2>Math Sheet</h2>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Calculation</th>
            <th>Result</th>
        </tr>
        </thead>
        <tbody>
        @foreach( $sheet as $task )
            <tr>
                <td class="text-right">{{$task->getNum1()}} <strong>{{$task->getOperation()}}</strong> {{$task->getNum2()}} = </td>
                <td><input type="text"></td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection