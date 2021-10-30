$(document).ready(function() {
    var tabela;
    var tabelaA;

    $('body').find('[data-toggle="tooltip"]').tooltip();
    $('body').find('[data-toggle="popover"]').popover();
    $('.select2').select2({
        placeholder: {
            id: '-1',
            text: 'Selecione uma opção'
        },
        allowClear: true,
    });
    $('.select2.multi').on('select2:select', function(e) {
        var id = e.params.data.id;
        var option = $(e.target).children('[value=' + id + ']');
        option.detach();
        $(e.target).append(option).change();
    });

    $('.colorpicker').colorpicker()

    $('[data-mask]').inputmask();
    // $('.valor').mask('000.000.000ZZZ', {reverse: true, translation:  {'Z': {pattern: /[0-9,]/, optional: true}}});
    $('.valor').mask('#,##0.00', { reverse: true });
    $('.cpf').mask('999.999.999-99');
    $('.cnpj').mask('99.999.999/9999-99');
    $('.data-input-mask').mask("00/00/0000 00:00:00");

    $('input').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
    });

    if ($('.editor-video').length > 0) {
        makeEditorVideo($('.editor-video'));
    }

    $('.btn-novo-repeater').click(function() {
        cloneElement($(this));
    });

    $('.btn-novo-spa').click(function() {
        $('.modal-spa').modal('show');
        $('.modal-title b').html($(this).data('titulo'));
    });

    $('.state').change(function() {
        getCities($(this));
    })

    $('.form-cadastro').on('submit', function() {
        gravaDados($(this));
        return false;
    });

    $('.form-spa').on('submit', function() {
        gravaDadosSpa($(this));
        return false;
    });

    $('body').on('click', '.btn-editar-spa', function() {
        $('html').find('.fr-popup.fr-desktop').each(function() {
            $(this).removeClass('fr-active');
        });
        $('.modal-title b').html($(this).data('titulo'));
        editaDadosSpa($(this));
    });

    $('body').on('click', '.btn-apagar', function() {
        apagaDados($(this));
    });

    $('.modal').on('hide.bs.modal', function() {
        $('.tagsinput').remove();
        $('.keywords').removeAttr('data-tagsinput-init');
        $(this).find('.editor').froalaEditor('destroy');
        $(this).find('.editor-min').froalaEditor('destroy');
        $(this).find('.editor-opicional').froalaEditor('destroy');
        $(this).find('form').trigger("reset");
        $(this).find('textarea').html('');
        $(this).find("input[type='hidden']", $(this)).not('.noclean').val('');
        limpaChecks($(this));
        breakEditor();
        breakImgEditor();
        breakSelect();
    });

    $('.modal-spa').on('shown.bs.modal', function() {
        $(this).find('input').not('[name="id"]').eq(0).focus();
        makeEditorMin($('.modal-spa .editor-min'));
        makeEditor($('.modal-spa .editor'));
        makeEditor($('.modal-spa .editor-opicional'));
        $('.modal-spa .img-editor').each(function() {
            if (!$(this).data('froala.editor')) {
                makeImgEditor($(this));
            }
        });
    });


    $('img.img-editor').on('froalaEditor.image.replaced', function(e, editor, $img, response) {
        $(this).parent().find('.url-imagem').val($img.attr('src'));
    });

});

function limpaChecks($this) {
    $this.find('input[type="radio"]').each(function(i, e) {
        $(e).iCheck('uncheck');
        $(e).removeAttr('checked');
        $(e).parent().removeClass('checked');
        $(e).parent().attr('aria-checked', 'false');
    });
    $this.find('input[type="checkbox"]').each(function(i, e) {
        $(e).iCheck('uncheck');
        $(e).removeAttr('checked');
        $(e).parent().removeClass('checked');
        $(e).parent().attr('aria-checked', 'false');
    });
}

function gravaDadosSpa($this) {
    $valida = true;
    $edita = false;
    $data = new FormData($this[0]);
    if ($this.find('.idobj').val() == '') {
        $url = $this.data('post');
        $method = 'POST';
    } else {
        $url = $this.data('put');
        $method = 'POST';
        $edita = true;
        // $data.append('_method', 'PUT');
    }

    if ($valida) {
        $.ajax({
            url: $url,
            headers: {
                'X-CSRF-Token': $('meta[name=_token]').attr('content'),
            },
            method: $method,
            cache: false,
            contentType: false,
            processData: false,
            async: true,
            data: $data,
            // data: $this.find('input, select, textarea').filter(function() { return !!this.value; }).serialize(),
            success: function(data) {
                $this.parents('.box').find('.overlay').remove();
                toastr.clear();
                $('body').removeClass('load');
                tabela.ajax.reload();
                if (!$edita) {
                    $('body').find('.modal-spa form').trigger('reset');
                    limpaChecks($('body').find('.modal-spa form'));
                    $('.modal-novo').find('input').eq(0).focus();
                    $('.select2').val(null).trigger('change');
                    $('.img-editor').attr('src', '../../resources/assets/backend/images/sem-imagem.png');
                } else {
                    $('.modal-spa').modal('hide');
                }
                toastr.success(
                    'Item Salvo com sucesso!',
                    'Tudo certo!', {
                        timeOut: 2000,
                        showEasing: 'linear',
                        showMethod: 'slideDown',
                        closeMethod: 'fadeOut',
                        closeDuration: 300,
                        closeEasing: 'swing',
                        closeButton: false,
                        progressBar: true,
                        onHidden: function() {}
                    }
                );
            },
            error: function(data) {
                toastr.clear();
                $this.parents('.box').find('.overlay').remove();
                Object.keys(data.responseJSON.errors).forEach(function(k) {
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "preventDuplicates": false,
                        "showDuration": "1000",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    toastr.error(
                        data.responseJSON.errors[k],
                        'Oops....'
                    )
                });
            },
            beforeSend: function() {
                toastr.info(
                    'Estamos salvando suas alterações...',
                    'Aguarde!', {
                        showEasing: 'linear',
                        showMethod: 'slideDown',
                        closeMethod: 'fadeOut',
                        closeDuration: 300,
                        closeEasing: 'swing',
                        closeButton: false,
                        progressBar: true,
                    }
                );
                $this.parents('.box').append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
            },
            complete: function() {}
        });
    }
}

function editaDadosSpa($this) {
    $('.modal-spa').modal('show');
    $('body').addClass('editing');
    $this.parents('body').find('.modal-spa .box').append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
    $.ajax({
        url: $this.data('url'),
        async: true,
        method: 'GET',
        data: $this.serialize(),
        success: function(data) {
            toastr.clear();
            if (typeof data == 'object') {
                toastr.success(
                    'Dados carregados com sucesso!',
                    'Tudo certo!', {
                        timeOut: 2000,
                        showEasing: 'linear',
                        showMethod: 'slideDown',
                        closeMethod: 'fadeOut',
                        closeDuration: 300,
                        closeEasing: 'swing',
                        closeButton: false,
                        progressBar: true,
                    }
                );
                Object.keys(data).forEach(function(k) {
                    $el = $('.modal-spa #' + k);
                    if ($('.modal-spa #' + k).length < 1) {
                        $el = $('[name="' + k + '"]');
                    }
                    if ($el.length > 0) {
                        if ($el.is('textarea')) {
                            breakEditor();
                            $el.html(data[k]);
                            $el.val(data[k]);
                            if ($el.hasClass('editor')) {
                                makeEditor($el);
                            }
                            // makeEditorMin($el);
                        }
                        if ($el.hasClass('keywords')) {
                            $el.val(data[k]);
                            $el.tagsInput({
                                'width': '100%',
                                'height': '40px',
                                // 'defaultText':'Separe as tags por vírgula (,)',
                                'delimiter': [',', ';'], // Or a string with a single delimiter. Ex: ';'
                                'removeWithBackspace': true,
                                'minChars': 1,
                                'placeholderColor': '#000'
                            });
                        }
                        if ($el.not('[type="radio"]').not('[type="file"]').is('input')) {
                            $el.val(data[k]);
                        }
                        if ($el.is('select')) {
                            if (!$el.hasClass('state')) {
                                $el.val(data[k]);
                                $el.trigger('change');
                            } else {
                                $el.val(data[k]);
                                $el.trigger('change');
                                getCities($el, data['municipio_id']);
                            }
                        }
                        if ($el.is(':file')) {
                            $el.fileinput('destroy').fileinput(makeFile(data[k], data[k.split('file_')[1]]));
                        }
                        if ($el.is(':radio')) {
                            $el.each(function() {
                                if ($(this).attr('id') == k + '_' + data[k]) {
                                    $(this).iCheck('check');
                                }
                            })
                        }
                        if ($el.hasClass('url-imagem')) {
                            if (data[k] != '') {
                                $el.parent().find('.img-editor').attr('src', data[k]);
                            } else {
                                $el.parent().find('.img-editor').attr('src', '../../../../resources/assets/backend/images/sem-imagem.png');
                            }
                            makeImgEditor($el.parent().find('.img-editor'));
                        }
                    } else {
                        if (k == 'tipo') {
                            $('.modal-spa #tipo_' + data[k]).iCheck('check');
                        }
                    }
                });
                $this.parents('body').find('.modal-spa .box').find('.overlay').remove();
                $('body').removeClass('editing');
            }
        },
        beforeSend: function() {
            toastr.info(
                'Estamos buscando o item solicitado...',
                'Aguarde!', {
                    showEasing: 'linear',
                    showMethod: 'slideDown',
                    closeMethod: 'fadeOut',
                    closeDuration: 300,
                    closeEasing: 'swing',
                    closeButton: false,
                    progressBar: true,
                }
            );
        },
        complete: function() {

        }
    });
}

function apagaDados($this) {
    swal({
        title: 'Opa!',
        text: 'Confirma a exclusão deste item?',
        type: 'question',
        confirmButtonText: "Sim",
        showCancelButton: true,
        cancelButtonText: "Não",
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.value) {
            deletaDados($this);
        }
    });
}

function deletaDados($this) {
    $.ajax({
        url: $this.data('url'),
        headers: {
            'X-CSRF-Token': $('meta[name=_token]').attr('content')
        },
        async: true,
        method: 'DELETE',
        data: $this.serialize(),
        success: function(data) {
            toastr.clear();
            if (typeof tabela !== 'undefined') {
                tabela.ajax.reload();
            }
            if (data == 'OK') {
                toastr.success(
                    'Item apagado com sucesso!',
                    'Tudo certo!', {
                        timeOut: 2000,
                        showEasing: 'linear',
                        showMethod: 'slideDown',
                        closeMethod: 'fadeOut',
                        closeDuration: 300,
                        closeEasing: 'swing',
                        closeButton: false,
                        progressBar: true,
                    }
                );
            } else {
                Object.keys(data).forEach(function(k) {
                    toastr.error(
                        data[k],
                        'Oops!', {
                            timeOut: 3000,
                            showEasing: 'linear',
                            showMethod: 'slideDown',
                            closeMethod: 'fadeOut',
                            closeDuration: 300,
                            closeEasing: 'swing',
                            closeButton: false,
                            progressBar: true,
                        }
                    )
                });
            }
        },
        beforeSend: function() {
            toastr.info(
                'Estamos processando seu pedido...',
                'Aguarde!', {
                    showEasing: 'linear',
                    showMethod: 'slideDown',
                    closeMethod: 'fadeOut',
                    closeDuration: 300,
                    closeEasing: 'swing',
                    closeButton: false,
                    progressBar: true,
                }
            );
        },
        complete: function() {}
    });
}

function getCities($this, $city = null) {
    $.ajax({
        url: routes.backend.ajax.cities,
        headers: {
            'X-CSRF-Token': $('meta[name=_token]').attr('content')
        },
        async: true,
        method: 'POST',
        data: { sid: Math.random(), s: $this.data('src'), st: $this.val(), m: $this.data('model'), t: $('.city').data('model') },
        success: function(data) {
            $this.parents('body').find('.modal-spa .box').find('.overlay').remove();
            $(".city").empty();
            $('.city').trigger('change');
            Object.keys(data).forEach(function(k) {
                var newOption = new Option(data[k], k, false, false);
                $('.city').append(newOption);
            });
            if ($city != null) {
                $('.city').val($city);
            }
            $('.city').trigger('change');
        },
        beforeSend: function() {
            $this.parents('body').find('.modal-spa .box').append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
        },
        complete: function() {
            $this.parents('body').find('.modal-spa .box').find('.overlay').remove();
        }
    });
}


function makeEditor($this) {
    $this.froalaEditor({
        heightMin: 200,
        language: 'pt_br',
        imageEditButtons: ['imageReplace', 'imageAlign', 'imageCaption', 'imageRemove', '|', 'imageLink', 'linkOpen', 'linkEdit', 'linkRemove', '-', 'imageDisplay', 'imageStyle', 'imageAlt', 'imageSize', 'aviary'],
        imageInsertButtons: ['imageBack', '|', 'imageUpload', 'imageByURL', 'imageManager'],
        imageUploadURL: routes.backend.ajax.upload,
        imageManagerDeleteMethod: 'DELETE',
        imageManagerDeleteURL: routes.backend.ajax.delete,
        imageManagerLoadMethod: 'POST',
        imageManagerLoadURL: routes.backend.ajax.load,
        imageManagerPageSize: 20,
        imageManagerScrollOffset: 10,
        imageDefaultWidth: 0,
    });
}

function makeEditorMin($this) {
    $this.froalaEditor({
        heightMin: 200,
        language: 'pt_br',
        toolbarButtons: ['undo', 'redo', '|', 'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'outdent', 'indent', 'clearFormatting', 'insertTable', 'html'],
        toolbarButtonsXS: ['undo', 'redo', '-', 'bold', 'italic', 'underline'],
        quickInsertTags: [''],
        imageDefaultWidth: 0,
    });
}

function makeEditorVideo($this) {
    $this.froalaEditor({
        heightMin: 200,
        language: 'pt_br',
        videoResponsive: true,
        toolbarButtons: ['insertVideo'],
    });
}

function makeImgEditor($this) {
    $.FroalaEditor.DefineIcon('imageReplace', { NAME: 'image' });
    $this.froalaEditor({
        language: 'pt_br',
        imageEditButtons: ['imageReplace', 'imageAlign', 'imageCaption', 'imageRemove'],
        imageInsertButtons: ['imageUpload', 'imageManager'],
        imageUploadURL: routes.backend.ajax.upload,
        imageManagerDeleteMethod: 'DELETE',
        imageManagerDeleteURL: routes.backend.ajax.delete,
        imageManagerLoadMethod: 'POST',
        imageManagerLoadURL: routes.backend.ajax.load,
        imageManagerPageSize: 5,
        imageManagerScrollOffset: 5
    });
    $this.on('click', function() {
        $this.data('froala.editor').commands.exec('imageReplace');
    });
}

function breakEditor() {
    $('.editor').each(function() {
        $(this).val('');
        $(this).text('');
        $(this).html('');
        if ($(this).data('froala.editor')) {
            $(this).froalaEditor('destroy');
        }
    })
}

function clearClone($this) {
    $this.find('.fr-box').remove();
    $this.find('input, select, textarea').each(function() {
        $(this).val('');
        $(this).text('');
        $(this).html('');
        if ($(this).hasClass('editor') == true) {
            makeEditor($(this));
        }
    });
}

function breakImgEditor() {
    $('.img-editor').each(function() {
        $(this).attr('src', '../../resources/assets/backend/images/sem-imagem.png');
        // if ($(this).data('froala.editor')) {
        // $($(this)).froalaEditor('destroy');
        // }
    });
}

function breakSelect() {
    $('.select2').each(function() {
        $(this).val(null);
        $(this).trigger('change');
    })
}

function cloneElement($this) {
    $src = $this.parents('.repeater').find('.fields').find('.field').last();
    $id = parseInt($src.attr('id'));
    $clone = $src.clone();
    $clone.attr('id', parseInt($id + 1));
    clearClone($clone);
    $clone.appendTo('.fields');
    $clone.find('.btn-remove-field').attr('data-id', parseInt($id + 1));
    $clone.find('.btn-remove-field').show();
}

$('body').on('click', '.btn-remove-field', function() {
    $id = $(this).attr('data-id');
    $(this).parents('.repeater').find('.fields .field#' + $id).remove();
});

function makeFile($params, $value) {
    $types = [];
    Object.keys($params.types).forEach(function(k) {
        $types.push($params.types[k]);
    });
    return {
        language: 'pt-BR',
        showCaption: true,
        dropZoneEnabled: true,
        browseOnZoneClick: true,
        showRemove: true,
        removeTitle: 'Remover',
        maxFileCount: 1,
        showUpload: false,
        showCancel: false,
        browseLabel: 'Carregar ' + $params.title,
        theme: "fa",
        overwriteInitial: true,
        allowedFileTypes: $types,
        initialPreviewAsData: true,
        initialPreviewFileType: 'image',
        initialPreview: [$value],
        initialPreviewConfig: [
            { type: $params.types, caption: $value, downloadUrl: false, showRemove: false },
        ],
        msgInvalidFileType: 'Tipo de arquivo inválido!". Apenas arquivos do tipo "{types}" são permitidos. O arquivo NÃO será enviado.',
    }
}