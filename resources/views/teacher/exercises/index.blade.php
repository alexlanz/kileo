@extends('teacher.panel')

@section('panel')
    <h2>{{ $schoolClass->name }}

        <div class="btn-group pull-right">
            <button type="button" class="btn btn-default btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> New Exercise <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                @foreach ($exerciseTypes as $typeKey => $typeName)
                    <li><a href="{{ route("teacher.classes.exercises.create", array($schoolClass->id, $typeKey)) }}">{{ $typeName }}</a></li>
                @endforeach
            </ul>
        </div>
    </h2>

    @if ( ! $schoolClass->exercises->count() )
        <p>You have no exercises created yet. Click the right upper button to create a new exercise.</p>
    @else
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Active</th>
                <th>Operations</th>
            </tr>
            </thead>
            <tbody>
            @foreach( $schoolClass->exercises as $exercise )
                <tr>
                    <td>{{ $exercise->name }}</td>
                    <td>{{ $exercise->type }}</td>
                    <td style="text-align: center;vertical-align: middle;"><input style="vertical-align: top;" type="checkbox" {{ $exercise->active ? 'checked="checked"' : '' }}  disabled></td>
                    <td>
                        <a href="{{ route('teacher.classes.exercises.edit', [$schoolClass->id, $exercise->id]) }}" class="btn btn-default btn-success btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit</a>

                        <form class="form-btn-inline" method="POST" action="{{ route('teacher.classes.exercises.destroy', [$schoolClass->id, $exercise->id]) }}">
                            <input name="_method" type="hidden" value="DELETE" />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <button type="submit" class="btn btn-default btn-warning btn-xs"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Remove</button>
                        </form>

                        <a href="{{ route('teacher.classes.exercises.results.index', [$schoolClass->id, $exercise->id]) }}" class="btn btn-default btn-info btn-xs"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Results</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

@endsection
