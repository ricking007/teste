/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });
    $('#tabela-variavel').DataTable({
        pageLength: 10,
        responsive: true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            { extend: 'copy' },
            { extend: 'csv' },
            { extend: 'excel', title: 'ExampleFile' },
            { extend: 'pdf', title: 'ExampleFile' },
            {
                extend: 'print',
                customize: function(win) {
                    $(win.document.body).addClass('white-bg');
                    $(win.document.body).css('font-size', '10px');

                    $(win.document.body).find('table')
                        .addClass('compact')
                        .css('font-size', 'inherit');
                }
            }
        ],
        "language": {
            "url": "json/datatables-Portuguese-Brasil.json"
        }
    });

    var mem = $('#data_1 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: 'dd/mm/yyyy',
        language: 'pt-BR'
    });

    $(".raca").select2({
        placeholder: "Buscar Raça",
        allowClear: true
    });
    $(".mapatipo").select2({
        placeholder: "Buscar Mapa",
        allowClear: true
    });

    $('#form-exame').on('submit', function(e) {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "progressBar": true,
            "preventDuplicates": false,
            "positionClass": "toast-top-right",
            "onclick": null,
            "showDuration": "500",
            "hideDuration": "1000",
            "timeOut": "7000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        e.preventDefault();
        var data = $(this).serialize();
        var $bt = $(this).find('.btn-action-ajax');
        $.ajax({
            url: baseurl + 'exame/set/',
            method: 'post',
            data: data,
            beforeSend: function() {
                $('.btn-spinner').removeClass('d-none');
                $bt.addClass('d-none');
            }
        }).done(function(response) {
            try {
                response = JSON.parse(response);
                if (response.success) {
                    toastr.success(response.message, 'Sucesso!');
                    setTimeout(function() {
                        window.location.href = baseurl + "exame/form/" + response.id;
                    }, 2000);
                } else {
                    toastr.error(response.message, 'Erro!');
                }
            } catch (e) {
                toastr.error('Ocorreu um erro, Por favor tente novamente.', 'Erro!');
            }
            $bt.removeClass('d-none');
            $('.btn-spinner').addClass('d-none');
        });
    });

    $('#form-layout').on('submit', function(e) {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "progressBar": true,
            "preventDuplicates": false,
            "positionClass": "toast-top-right",
            "onclick": null,
            "showDuration": "500",
            "hideDuration": "1000",
            "timeOut": "7000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        e.preventDefault();
        var data = $(this).serialize();
        var $bt = $(this).find('.btn-action-ajax');
        $.ajax({
            url: baseurl + 'examelayout/set/',
            method: 'post',
            data: data,
            beforeSend: function() {
                $('.btn-spinner').removeClass('d-none');
                $bt.addClass('d-none');
            }
        }).done(function(response) {
            try {
                response = JSON.parse(response);
                if (response.success) {
                    toastr.success(response.message, 'Sucesso!');
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                } else {
                    toastr.error(response.message, 'Erro!');
                }
            } catch (e) {
                toastr.error('Ocorreu um erro, Por favor tente novamente.', 'Erro!');
            }
            $bt.removeClass('d-none');
            $('.btn-spinner').addClass('d-none');
        });
    });
});
$(document).on('click', '.btn-layout', function(e) {
    var id = $(this).data('exame');
    $('#exame').val(id);
    $("#modal-layout").modal('show');
});
$(".tipo").select2({
    placeholder: "Buscar Tipo",
    allowClear: true
});