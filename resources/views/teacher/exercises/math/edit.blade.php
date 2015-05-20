@extends('teacher.exercises.edit')

@section('exercisepanel')
   
        <div class="form-group">
            <label for="from" class="col-sm-2 control-label">From</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="from" name="from" placeholder="From ..." value="{{ $exercise->from }}">
            </div>
        </div>

        <div class="form-group">
            <label for="to" class="col-sm-2 control-label">To</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="to" name="to" placeholder="To ..." value="{{ $exercise->to }}">
            </div>
        </div>

        <div class="form-group">
            <label for="num_of_calculations" class="col-sm-2 control-label">Number of calculations</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="num_of_calculations" name="num_of_calculations" placeholder="Number of calculations ..." value="{{ $exercise->num_of_calculations }}">
            </div>
        </div>
        
        <div class="form-group">
            <label for="operation" class="col-sm-2 control-label">Math Operation</label>
            <div class="col-sm-10">
                <div class="radio">
                  <label><input type="radio" name="operation" @if($exercise->operation === "1") checked="checked" @endif value="1">Addition</label>
                </div>
                <div class="radio">
                  <label><input type="radio" name="operation" @if($exercise->operation === "2") checked="checked" @endif value="2">Subtraction</label>
                </div>
                <div class="radio">
                  <label><input type="radio" name="operation" @if($exercise->operation === "3") checked="checked" @endif value="3">Multiplication</label>
                </div>           
                <div class="radio">
                  <label><input type="radio" name="operation" @if($exercise->operation === "4") checked="checked" @endif value="4">Division</label>
                </div>           
            </div>
        </div>
@endsection