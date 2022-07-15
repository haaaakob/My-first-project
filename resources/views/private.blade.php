<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>user account</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/private.css')}}">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <!--bootstrap link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="csrf-token" content="{{csrf_token()}}">

</head>
<body>
    <div class="container">
        <div class="row">
            <h1>{{__('user account')}}</h1>
            <a href="{{route('logout',app()->getLocale())}}" style="text-decoration: none">{{__('logout')}}</a>
            <div class="com-md-6 col-md-offset-3">
                <div class="img_div">
                    <form action="{{route('update_avatar',app()->getLocale())}}" method="POST" enctype="multipart/form-data">
                    @foreach($loggedUser as $info)
{{--                            <img class="img" src="{{asset('images/avatar/'.$info['avatar'])}}" alt="img">--}}


                        <div class="col-ting">
                            <div class="control-group file-upload" id="file-upload1">
                                <div class="image-box text-center">
                                    <img class="img" src="{{asset('images/avatar/'.$info['avatar'])}}" alt="">
                                    <p>choose photo</p>
                                </div>
                                <div class="controls" style="display: none;">
                                    <input type="file" name="avatar"/>
                                </div>
                            </div>
                        </div>




{{--                            <div class="image-input">--}}
{{--                                <input type="file" accept="image/*" id="imageInput">--}}
{{--                                <label for="imageInput" class="image-button">--}}
{{--                                    <label for="imageInput" class="image-button"><img src="{{asset('images/avatar/'.$info['avatar'])}}"  class="image-preview">Choose</label>--}}
{{--                                </label>--}}
{{--                                <img src=""  class="image-preview">--}}

{{--                                <span class="change-image">Choose different image</span>--}}
{{--                            </div>--}}


                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        <input style="margin: 10px" type="submit" value="{{__('Upload')}}" class="pull-right btn btn-sm btn-primary">
                    @endforeach
                    </form>
                </div>
                <span class="text-danger">@error('avatar'){{$message}}@enderror</span>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success" style="width: 350px">
                        <strong>{{ $message }}</strong>
                    </div>
                @endif


                <br>
                <li class="nav-item" style="margin: 50px 0 0 0 ">
                    <a href="{{ route(Route::currentRouteName(), 'en')  }}" style="text-decoration: none" class="nav-item">English</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route(Route::currentRouteName(), 'am')  }}" style="text-decoration: none" class="nav-item">Հայերեն</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route(Route::currentRouteName(), 'ru')  }}" style="text-decoration: none" class="nav-item">Русский:</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route(Route::currentRouteName(), 'fr')  }}" style="text-decoration: none" class="nav-item">France</a>
                </li>

                <form action="{{route('update_avatar',app()->getLocale())}}" method="POST" enctype="multipart/form-data">
{{--                    <label>{{__('Update Profile Image')}}</label><br>--}}
{{--                    <input type="file" name="avatar">--}}
{{--                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>--}}
{{--                    <input type="submit" value="{{__('Upload')}}" class="pull-right btn btn-sm btn-primary">--}}

                </form>
                <br>
                @foreach($loggedUser as $info)
                <p>{{__('name')}}: {{$info['name']}}</p>
                <p>{{__('surname')}}: {{$info['surname']}}</p>
                <p>{{__('email')}}: {{$info['email']}}</p>
                @endforeach
            </div>
        </div>
        <a href="{{route('gallery')}}" style="text-decoration: none">{{__('gallery')}}</a>
        <br>
        <a href="{{route('slider_save')}}" style="text-decoration: none">{{__('slider')}}</a>

    </div>

    <script src="{{asset('js/choose_avatar.js')}}"></script>

    </script>
</body>
</html>
