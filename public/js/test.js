$(document).ready(function () {
    $("#send").click(function (){
        // g.preventDefault();
        let addName = $('#addName').val();
        let select = $('#select').val();
        let checkbox = $('.box').val();
        // console.log(checkbox)
        // alert(checkbox)
        // let password = $('#password').val();
        // console.log(email)
        // $.ajax({
        //     url:'login',
        //     type:'Post',
        //     data:{
        //         email: email,
        //         password: password
        //     },
        //     success: function (g){
        //         console.log(g)
        //     },
        //     headers:{
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     },
        //     // error: function (g){
        //     //     alert('errors')
        //     // }
        // })
    })
})
