$(document).ready(function () {
    $("#register").click(function (e){
        // e.preventDefault();
        // let avatar = '1654692924.png';
        let avatar;
        let name = $('#name').val();
        let surname = $('#surname').val();
        let email = $('#email').val();
        let password = $('#password').val();
        let confirmPassword = $('#confirm').val();
        let gender = $("input[name='gender']:checked").val();
        if (gender == 'male'){
            avatar = '2.png'
        }else {
            avatar = '1.png'
        }
        console.log(avatar);
        $.ajax({
            url:'/registration',
            type:'POST',
            data:{
                name: name,
                surname: surname,
                email: email,
                password: password,
                gender: gender,
                confirmPassword: confirmPassword,
                avatar: avatar
            },
            success: function (e){
                console.log(e)
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
    })
})

