@extends('teacher.panel')

@section('panel')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
    <h2>{{ $schoolClass->name }}
        <a id="new_exercise_button" type="button" class="btn btn-default btn-primary pull-right"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> New Exercise</a>
        <script>
            $('#new_exercise_button').on('click', function (e) {
                bootbox.dialog({
                    title: "That html",
                    message:
                        '<form id="select_type_form" class="form-horizontal" role="form" method="GET" action="{{ route("teacher.classes.exercises.createExercise", array($schoolClass->id, "|REPLACEPATTERN|")) }}">'
                        + '<input type="hidden" name="_token" value="{{ csrf_token() }}">'
                        + '<select id="type" name="type" class="form-control">'
                        @foreach (ExerciseHelper::$exercise_types as $type_key => $type_name)
                        +    '<option value="{{ $type_key }}">{{ "$type_name" }}</option>'
                        @endforeach
                        +'</select>'
                        + '</form>',
                    buttons: {
                        success: {
                            label: "Create Exercise",
                            className: "btn-success",
                            callback: function () {
                                var action = $("#select_type_form").attr("action");
                                $("#select_type_form").attr("action", action.replace("|REPLACEPATTERN|", $("#type").val()));
                                $("#select_type_form").submit();
                            }
                        }
                }

                });
                //your awesome code here
                // href="{{ route('teacher.classes.exercises.create', $schoolClass->id) }}"
            });
        </script>
    </h2>

    @if ( ! $schoolClass->pupils->count() )
        <p>You have no pupils created yet. Click the right upper button to create a new pupils.</p>
    @else
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Created at</th>
                <th>Name</th>
                <th>Type</th>
                <th>Active</th>
                <th>Operations</th>
            </tr>
            </thead>
            <tbody>
            @foreach( $schoolClass->exercises as $exercise )
                <tr>
                    <td>{{ $exercise->created_at }}</td>
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
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

@endsection
