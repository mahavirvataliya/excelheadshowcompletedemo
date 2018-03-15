<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
    <div class="container">
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>
                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row col-md-12">
            &nbsp;
        </div>
    </div>
    <div class="container">
        <div class="row col-md-12">
            {!! Form::open(
     array(
         'route' => 'home',
         'class' => 'form',
         'novalidate' => 'novalidate',
         'files' => true)) !!}
         @csrf
            <div class="form-group">
                <label for="rowno">row no</label>
                <input type="number" name="rowno" value="1" min="1" class="form-control">
            </div>
            <div class="form-group">
                {!! Form::label('Product Image') !!}
                {!! Form::file('xls', array('class' => 'form-control')) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Create Product!',array('class','btn btn-primary')) !!}
            </div>
            {!! Form::close() !!}
        </div>
        </div>
    </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
