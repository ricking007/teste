/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {
    $('.dataTables-tramitacao').DataTable({
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
});

$(document).on('click', '.btn-nova-tramitacao', function(e) {
    e.preventDefault();
    var id = $(this).data('tramitacao');
    $("#idctrltramitacaotipo").val(id);
    $('#modal-tramitacao').modal('show');

    $(".select-modal-footer").select2({
        dropdownCssClass: 'custom-dropdown',
        placeholder: "Selecionar",
        allowClear: true
    }).on("select2:opening",
        function() {
            $("#modal-tramitacao").removeAttr("tabindex", "-1");
        }).on("select2:close",
        function() {
            $("#modal-tramitacao").attr("tabindex", "-1");
        }
    );
});

$(document).ready(function() {
    $('#form-ctrl_tramitacao').on('submit', function(e) {
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
            url: baseurl + 'ctrl_tramitacao/set/',
            method: 'post',
            data: data,
            beforeSend: function() {
                $('.btn-spinner').removeClass('d-none');
                $bt.addClass('d-none');
                $('#modal-tramitacao').modal('hide');
            }
        }).done(function(response) {
            var $alert = $("#modal-alert");
            try {
                response = JSON.parse(response);
                if (response.success) {
                    toastr.success(response.message, 'Sucesso!');
                } else {
                    $alert.find('.modal-header h4').html("Ocorreu um Erro!");
                    $alert.find('.modal-body p').html(response.message);
                    $alert.modal('show');
                }
            } catch (e) {
                toastr.error('Ocorreu um erro, Por favor tente novamente.', 'Erro!');
            }
            $bt.removeClass('d-none');
            $('.btn-spinner').addClass('d-none');
        });
    });
});

$(document).on('click', '.btn-del-tramitacao', function(e) {
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
    var id = $(this).data('ctrl_tramitacao');
    var $bt = $(this);
    swal({
        title: "Tem certeza que deseja excluir?",
        text: "Se você apagar esse registro, todos os registros relacionados serão apagados \n\
        e esta operação não poderá ser desfeita!",
        type: "warning",
        showCancelButton: true,
        cancelButtonClass: 'btn-secondary ',
        confirmButtonClass: 'btn-warning',
        confirmButtonText: "Sim, quero DELETAR!",
        closeOnConfirm: false
    }, function() {
        $.ajax({
            url: baseurl + 'ctrl_tramitacao/del/' + id,
            beforeSend: function() {
                $bt.addClass('btn-spin').children('i').hide();
            }
        }).done(function(response) {
            try {
                response = JSON.parse(response);
                if (response.success) {
                    swal.close();
                    toastr.success(response.message, 'Sucesso!');
                    var $tr = $bt.closest('tr');
                    $tr.addClass('animated fadeOutLeft');
                    setTimeout(function() {
                        $tr.remove();
                    }, 1000);
                } else {
                    swal.close();
                    toastr.error(response.message, 'Erro!');
                }
            } catch (e) {
                swal.close();
                toastr.error('Ocorreu um erro desconhecido, por favor tente novamente mais tarde.', 'Erro!');
            }
            $bt.removeClass('btn-spin').children('i').show();
        });
    });
});