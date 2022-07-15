<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>log in</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <!--bootstrap link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="csrf-token" content="{{csrf_token()}}">

</head>
<body>


{{--<li class="nav-item">--}}
{{--    <a href="lang/en" style="text-decoration: none" class="nav-item">English</a>--}}
{{--</li>--}}
{{--<li class="nav-item">--}}
{{--    <a href="lang/am" style="text-decoration: none" class="nav-item">Հայերեն</a>--}}
{{--</li><li class="nav-item">--}}
{{--    <a href="lang/ru" style="text-decoration: none" class="nav-item">Русский:</a>--}}
{{--</li>--}}
<li class="nav-item">
    <a href="{{ route(Route::currentRouteName(), 'en')  }}" style="text-decoration: none" class="nav-item">English</a>
</li>
<li class="nav-item">
    <a href="{{ route(Route::currentRouteName(), 'am')  }}" style="text-decoration: none" class="nav-item">Հայերեն</a>
</li><li class="nav-item">
    <a href="{{ route(Route::currentRouteName(), 'ru')  }}" style="text-decoration: none" class="nav-item">Русский:</a>
</li>
<div style="margin: 100px 300px">

    <form action="{{route('check',app()->getLocale())}}" method="post">
        @if(\Illuminate\Support\Facades\Session::get('fail'))
            <div class="alert alert-danger">
                {{\Illuminate\Support\Facades\Session::get('fail')}}
            </div>
        @endif
        <div class="mb-3">
            <input type="email" name="email" id="email" aria-describedby="emailHelp" placeholder="{{__('Email address')}}" value="{{old('email')}}">
        </div>
        <span class="text-danger">@error('email'){{$message}}@enderror</span>
        <div class="mb-3">
            <input type="password" id="password" placeholder="{{__('Password')}}" name="password" value="{{old('password')}}">
        </div>
        <span class="text-danger">@error('password'){{$message}}@enderror</span>
        <br>
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        <button type="submit" class="btn btn-primary" id="send_log" name="send" >{{__('log in')}}</button>
    </form>
    <a href="{{route('registration',app()->getLocale())}}" style="text-decoration: none">{{__('I do not have an account! create new')}}</a>
</div>



<script src="{{asset('js/login.js')}}"></script>
</body>
</html>
