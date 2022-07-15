<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>gallery</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/private.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{csrf_token()}}">
</head>
{{--explode--}}
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div style="margin: 70px 200px; width: 400px">
                <li class="nav-item">
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
                <br>
                <a href="{{route('private')}}" style="text-decoration: none">{{__('back')}}</a>
                <h3>{{__('gallery')}}</h3>
                <div class="flex">
                    @foreach($posts as $post => $hi)
                        <div class="img_img">
                            <img src="{{asset('images/gallery/'.$hi['posts'])}}" class="img_1">
                            <p style="margin: 10px 5px">{{$hi['translation'] !== null ? $hi['translation']['title']:'empty title'}}</p>
                            <p style="margin: 5px">{{$hi['translation'] !== null ? $hi['translation']['description']:'empty description'}}</p>

                            <a href="{{url('edit/'.$hi['id'])}}">
                                <input type="submit" style="margin: 0 0 100px 100px ; width: 120px" value="{{__('Edit')}}" class="pull-right btn btn-sm btn-primary">
                            </a>
{{--                            <i class="fa-regular fa-thumbs-up like"></i>--}}
                        </div>
                    @endforeach
                    </div>
                <div class="pagination_div">
                    {{$posts->links()}}
                </div>
                <span class="text-danger">@error('posts'){{$message}}@enderror</span>
                @if(isset($message))
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success" style="width: 372px">
                            <strong>{{ $message }}</strong>
                        </div>
                    @else
                        <div class="alert alert-danger">
                            {{\Illuminate\Support\Facades\Session::get('fail')}}
                        </div>
                    @endif
                @endif
            </div>
            <div style="margin: 0 0 150px 200px; width: 600px">
                <form action="{{route('gallery_photo',app()->getLocale())}}" method="post" enctype="multipart/form-data">
                    <label>{{__('add Gallery photo')}}</label>
                    <ul class="nav nav-pills mb-3" id="lang-tab" role="tablist">
                        @foreach($languages as $key => $item)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ $key == 0 ? 'active' : '' }}" id="pills-home-tab{{$key}}" data-bs-toggle="pill" data-bs-target="#lang-{{$key}}" type="button" role="tab" aria-controls="pills-home" aria-selected="{{ $key == 0 ? 'true' : 'false' }}">{{$item['name']}} <img width="50px" height="30px" src="{{asset('images/language/'.$item['img'])}}">  </button>
                                </li>
                        @endforeach
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                       @foreach($languages as $key => $item)
                            <div class="tab-pane {{ $key == 0 ? 'active show' : '' }}" id="lang-{{$key}}" role="tabpanel" aria-labelledby="pills-home-tab">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput{{$key}}" placeholder="Post title" name="title[]">
                                    <label for="floatingInput">{{__('Post title')}}</label>
                                </div>
                                <div class="form-floating">
{{--                                    <textarea class="form-control" placeholder="Post description" id="floatingTextarea{{$key}}" style="height: 100px" name="description[]"></textarea>--}}
                                    <input class="form-control" placeholder="Post description" id="floatingTextarea{{$key}}" style="height: 100px" name="description[]">
                                    <label for="floatingTextarea2">{{__('Post description')}}</label>
                                </div>
                                <input type="text" name="language[]" value="{{$item['id']}}" hidden="">
                            </div>
                       @endforeach
                    </div>


                      <div class="mb-3">
                          <label for="formFileMultiple" class="form-label">{{__('Upload images')}}</label>
                          <input type="file" class="form-control" name="post">
                      </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    <input type="submit" style="margin: 20px 0 100px 0 ; width: 200px" value="{{__('Create post')}}" class="pull-right btn btn-sm btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
