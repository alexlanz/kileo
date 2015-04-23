@extends('app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-sm-2 blog-sidebar">
                <div class="sidebar-module">
                    <h4>Menu</h4>
                    <ol class="list-unstyled">
                        <li><a href="{{ route('teacher.index') }}">Classes</a></li>
                    </ol>
                </div>
            </div>

            <div class="panel panel-default col-sm-10">

                <div class="panel-body">

                    @yield('panel')

                </div>
            </div>
        </div>
    </div>
@endsection
