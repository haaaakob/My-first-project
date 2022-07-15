<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<style>
    .form_div{
        width: 300px;
        height: 500px;
        margin: 30px auto;
        border: 2px solid black;
        text-align: center;
        display: none;
    }
    .btn{
        width: 150px;
        height: 35px;
        border-radius: 50px;
        background-color: lightskyblue;
        margin: 10px;
    }
    #newName{
        margin: 10px;
    }
    #addName{
        margin: 10px auto;
        display: none;
    }
</style>
<h1>it's group page</h1>

<table class="table" style="width: 300px;">
    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">group name</th>
        <th scope="col">
            <input type="button" class="marge" id="marge" value="marge">
        </th>
    </tr>
    </thead>
    <tbody>
       @foreach($groups as $group)
           <tr>
             <th>{{$group['id']}}</th>
             <td>{{$group['name']}}</td>
{{--             <th>--}}
{{--                 <input type="checkbox">--}}
{{--             </th>--}}
           </tr>
       @endforeach
    </tbody>
</table>

<span class="text-danger">@error('fail'){{$message}}@enderror</span>
<div class="form_div" id="form_div">
{{--    <form action="{{route('marge', app()->getLocale())}}" method="post">--}}
        <table>
            <thead>
            <tr>
                <th scope="col">Choose group</th>
            </tr>
            </thead>
            <tbody>
            @foreach($groups as $group)
                <tr>
                    <th>Group {{$group['id']}}</th>
                    <th>
                        <input type="checkbox" class="box" name="checkbox[]" value="{{$group['id']}}" id="{{$group['id']}}">
                    </th>
                </tr>
            @endforeach
            </tbody>
        </table>
        <select name="groupName" id="select">
            <option>which group name you choose</option>
            @foreach($groups as $group)
                <option>{{$group['name']}}</option>
            @endforeach
        </select>
        <input id="newName" type="button" VALUE="NEW NAME">
        <input id="addName" type="text" name="newName">
        <br>
        <button type="reset" class="btn">reset</button>

        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        <input type="submit" class="btn" id="send">
{{--        <button type="" class="btn">send</button>--}}
{{--    </form>--}}
</div>


<script src="{{asset('js/test.js')}}"></script>
<script>

    let marge = document.getElementById('marge')
    let form_div = document.getElementById('form_div')
    let newName = document.getElementById('newName')
    let addName = document.getElementById('addName')
    let select = document.getElementById('select')
    marge.addEventListener('click', function (){
        // if (form_div.style.display === 'none') {
            form_div.style.display = 'block'
        // }else {
        //     form_div.style.display = 'none'
        // }
    })
    newName.addEventListener('click', function (){
        select.style.display = 'none'
        addName.style.display = 'block'
    })

</script>
</body>
</html>
