<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>slider</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>
<body>
<div class="container">
    <div class="row">
        <a href="{{route('private')}}" style="text-decoration: none">{{__('back')}}</a>
        <span class="text-danger">@error('images'){{$message}}@enderror</span>
        <br>
        <form action="{{route('slider_save',app()->getLocale())}}" method="POST" enctype="multipart/form-data">
            <label>{{__('Update Slider Image')}}</label><br>
            <input type="file" name="images[]" multiple>
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
            <input type="submit" value="{{__('Upload')}}" class="pull-right btn btn-sm btn-primary">
        </form>
        @if ($message = Session::get('success'))
            <div class="alert alert-success" style="width: 372px">
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <li class="nav-item">
            <a href="lang/en" style="text-decoration: none" class="nav-item">English</a>
        </li>
        <li class="nav-item">
            <a href="lang/am" style="text-decoration: none" class="nav-item">Հայերեն</a>
        </li><li class="nav-item">
            <a href="lang/ru" style="text-decoration: none" class="nav-item">Русский:</a>
        </li>

        <div id="carouselExampleFade" class="carousel slide carousel-fade"data-bs-ride="carousel">
            <div class="carousel-inner" style="width: 100%; height: auto">
                @foreach ($loggedUser as $key => $slider)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <img src="{{asset($slider['image'])}}" width="100%" height="700px" style="margin: 30px auto">
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true" ></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true" ></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</div>
</body>
</html>
