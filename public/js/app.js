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


// https://docs.rajaapi.com/
var getProvinsi = () => 'https://x.rajaapi.com/MeP7c5ne5ZZHvtG7IvXmVDSCLTB73gd1XwqFjaWUiiTZrz1exj8pLIbFFm/m/wilayah/provinsi';
var getKabupaten = provinsi_id => `https://x.rajaapi.com/MeP7c5ne5ZZHvtG7IvXmVDSCLTB73gd1XwqFjaWUiiTZrz1exj8pLIbFFm/m/wilayah/kabupaten?idpropinsi=${provinsi_id}`;
var getKecamatan = kabupaten_id => `https://x.rajaapi.com/MeP7c5ne5ZZHvtG7IvXmVDSCLTB73gd1XwqFjaWUiiTZrz1exj8pLIbFFm/m/wilayah/kecamatan?idkabupaten=${kabupaten_id}`;
var getKelurahan = kecamatan_id => `https://x.rajaapi.com/MeP7c5ne5ZZHvtG7IvXmVDSCLTB73gd1XwqFjaWUiiTZrz1exj8pLIbFFm/m/wilayah/kelurahan?idkecamatan=${kecamatan_id}`;


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

    if ($('select[data-location="provinsi"]')) {
        // getProvinsi : init provinsi location first on select input
        $.ajax({
            url: getProvinsi(),
            success: function(result) {
                console.log(result.data);
                result.data.forEach((data) => {
                    $('select[data-location="provinsi"]').append(`<option id="${data.id}" value="${data.name}">${data.name}</option>`)
                })
            }
        });
        $('select[data-location="provinsi"]').on('change', function() {
            $('select[data-location="kabupaten"]').attr('disabled', 'disabled');
            $('select[data-location="kecamatan"]').attr('disabled', 'disabled');
            $('select[data-location="kelurahan"]').attr('disabled', 'disabled');
            $.ajax({
                url: getKabupaten($(this).find('option:selected').prop('id')),
                success: function(result) {
                    $('select[data-location="kabupaten"]')
                        .removeAttr('disabled')
                        .html('<option selected disabled>Pilih Kota/Kabupaten</option>');
                    result.data.forEach((data) => {
                        $('select[data-location="kabupaten"]').append(`<option id="${data.id}" value="${data.name}">${data.name}</option>`)
                    })
                }
            });
        });
        $('select[data-location="kabupaten"]').on('change', function() {
            $('select[data-location="kecamatan"]').attr('disabled', 'disabled');
            $('select[data-location="kelurahan"]').attr('disabled', 'disabled');
            $.ajax({
                url: getKecamatan($(this).find('option:selected').prop('id')),
                success: async function(result) {
                    $('select[data-location="kecamatan"]')
                        .removeAttr('disabled')
                        .html('<option selected disabled>Pilih Kecamatan</option>');
                    result.data.forEach((data) => {
                        $('select[data-location="kecamatan"]').append(`<option id="${data.id}" value="${data.name}">${data.name}</option>`)
                    })
                }
            });
        });
        $('select[data-location="kecamatan"]').on('change', function() {
            $('select[data-location="kelurahan"]').attr('disabled', 'disabled');
            $.ajax({
                url: getKelurahan($(this).find('option:selected').prop('id')),
                success: async function(result) {
                    $('select[data-location="kelurahan"]')
                        .removeAttr('disabled')
                        .html('<option selected disabled>Pilih Kelurahan</option>');
                    result.data.forEach((data) => {
                        $('select[data-location="kelurahan"]').append(`<option id="${data.id}" value="${data.name}">${data.name}</option>`)
                    })
                }
            });
        });
    }
})