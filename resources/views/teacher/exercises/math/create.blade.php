@extends('teacher.exercises.create')

@section('exercisepanel')
    
        <div class="form-group">
            <label for="from" class="col-sm-2 control-label">From</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="from" name="from" placeholder="From ..." value="{{ Input::old('from') }}">
            </div>
        </div>

        <div class="form-group">
            <label for="to" class="col-sm-2 control-label">To</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="to" name="to" placeholder="To ..." value="{{ Input::old('to') }}">
            </div>
        </div>

        <div class="form-group">
            <label for="num_of_calculations" class="col-sm-2 control-label">Number of calculations</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="num_of_calculations" name="num_of_calculations" placeholder="Number of calculations ..." value="{{ Input::old('from') }}">
            </div>
        </div>

@endsection
