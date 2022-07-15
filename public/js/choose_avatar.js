$(".image-box").click(function(event) {
    var previewImg = $(this).children("img");

    $(this)
        .siblings()
        .children("input")
        .trigger("click");

    $(this)
        .siblings()
        .children("input")
        .change(function() {
            var reader = new FileReader();

            reader.onload = function(e) {
                var urll = e.target.result;
                $(previewImg).attr("src", urll);
                previewImg.parent().css("background", "transparent");
                previewImg.show();
                previewImg.siblings("p").hide();
            };
            reader.readAsDataURL(this.files[0]);
        });
});












// $('#imageInput').on('change', function() {
//     $input = $(this);
//     if($input.val().length > 0) {
//         fileReader = new FileReader();
//         fileReader.onload = function (data) {
//             $('.image-preview').attr('src', data.target.result);
//         }
//         fileReader.readAsDataURL($input.prop('files')[0]);
//         $('.image-button').css('display', 'none');
//         $('.image-preview').css('display', 'block');
//         $('.change-image').css('display', 'block');
//     }
// });
//
// $('.change-image').on('click', function() {
//     $control = $(this);
//     $('#imageInput').val('');
//     $preview = $('.image-preview');
//     $preview.attr('src', '');
//     $preview.css('display', 'none');
//     $control.css('display', 'none');
//     $('.image-button').css('display', 'block');
// });
