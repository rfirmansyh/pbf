// LOADER
(function ($) {
    $.fn.loader = function (param = true) {
        if (param) {
            this.addClass("loader").append("<div class='loader-bg d-flex justify-content-center py-5'><div class='spinner-border'></div></div>");
        } else {
            this.removeClass('loader').prop('disabled', false).find('.loader-bg').remove();
        }

        return this;
    }
}(jQuery));

var openFile = function(event, element) {
    const input = event.target;
    const reader = new FileReader();
    reader.onload = function() {
        const dataURL = reader.result;
        const output = document.querySelector(element);
        output.src = dataURL;
    }
    reader.readAsDataURL(input.files[0])
}



// Jquery Handle
$(function() {
    $('.input-group.input-group-password .input-group-append').on('click', function(e) {
        if($(this).prev().prop('type') === 'password') {
            $(this).prev().prop('type', 'text')
        } else {
            $(this).prev().prop('type', 'password')
        }
        e.preventDefault()
    })

})