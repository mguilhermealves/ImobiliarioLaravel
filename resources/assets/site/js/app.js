$(document).ready(function() {

    
$('.form-normal').on('submit', function() {
    submitForm($(this));
    return false;
});

$('.form-normal-data').on('submit', function() {
    submitFormData($(this));
    return false;
});

if ($('.editor-min').length > 0) {
    makeEditorMin($('.editor-min'));
}
if ($('.img-editor').length > 0) {
    $('.img-editor').each(function() {
        makeImgEditor($(this));
    });
}



function submitForm($this, $formdata = false) {
    $('body').addClass('load');
    $.ajax({
        url: $this.data('action'),
        headers: {
            'X-CSRF-Token': $('meta[name=_token]').attr('content')
        },
        async: true,
        method: 'POST',
        data: $this.find('input,select,textarea').filter(function() { return !!this.value; }).serialize(),
        success: function(data) {
            $('body').removeClass('load');
            if (data.response == 1) {
                swal({
                    title: 'Tudo certo',
                    html: data.message,
                    type: 'success'
                }).then((result) => {
                    if (result.value) {
                        if (data.url != '0') {
                            window.location.href = data.url;
                        }
                        if (data.url == '0') {
                            window.location.reload();
                        }
                    }
                });
            } else {
                swal({
                    title: 'Oops...',
                    html: data.message,
                    type: 'error'
                }).then((result) => {
                    if (result.value) {
                        console.log(data.url);
                        // if(data.url != '0' ){
                        //   window.location.href = data.url;
                        // }
                    }
                });
            }
        },
        beforeSend: function() {
            limpaValidacao($this);
            $('.loading').addClass('show');
        },
        error: function(data) {
            console.log(data);
            validaForm($this, data);
        },
        complete: function() {}
    });
}

function submitFormData($this, ) {
    $.ajax({
        url: $this.data('action'),
        headers: {
            'X-CSRF-Token': $('meta[name=_token]').attr('content')
        },
        cache: false,
        contentType: false,
        processData: false,
        async: true,
        method: 'POST',
        data: new FormData($this[0]),
        success: function(data) {
            $('body').removeClass('load');
            if (data.response == 1) {
                swal({
                    title: 'Tudo certo',
                    html: data.message,
                    type: 'success'
                }).then((result) => {
                    if (result.value) {
                        window.location.href = data.url;
                    }
                });
            } else {
                swal({
                    title: 'Oops...',
                    html: data.message,
                    type: 'error'
                });
            }
        },
        beforeSend: function() {
            limpaValidacao($this);
            $('body').addClass('load');
        },
        error: function(data) {
            validaForm($this, data);
        },
        complete: function() {}
    });
}

function valida($this) {
    let $campo = $this.attr('name');
    let $data = {};
    $data[$campo] = $this.val();
    $.ajax({
        url: $this.data('action'),
        headers: {
            'X-CSRF-Token': $('meta[name=_token]').attr('content')
        },
        async: true,
        method: 'POST',
        data: $data,
        success: function(data) {
            $this.next('.status').removeClass('checking');
            $this.next('.status').addClass('ok');
            $this.removeClass('error');
            $this.addClass('ok');
            $this.next('.status').html('<i class="fa fa-check padding-5"></i> liberado para uso.');
        },
        beforeSend: function() {
            $this.parent().find('.status').remove();
            $this.parent().append('<div class="row status"></div>');
            $this.next('.status').addClass('checking');
            $this.removeClass('error');
            $this.next('.status').html('');
        },
        error: function(data) {
            $this.next('.status').removeClass('checking');
            $this.next('.status').removeClass('ok');
            Object.keys(data.responseJSON.errors).forEach(function(k) {
                $this.addClass('error');
                $this.val('');
                $this.focus();
                $this.next('.status').addClass('error');
                $this.next('.status').html('<i class="fa fa-exclamation-triangle padding-5"></i>' + data.responseJSON.errors[k]);
            });
        },
        complete: function() {}
    });
}

function validaForm($this, data) {
    $('body').removeClass('load');
    Object.keys(data.responseJSON.errors).forEach(function(k) {
        $el = $this.find('[name=' + k + ']:enabled');
        if ($el.is('textarea') && ($el.hasClass('editor') || $el.hasClass('editor-min'))) {
            $el = $el.parent().find('.fr-box');
        }
        if ($el.is('input:hidden')) {
            $el = $el.parent();
        }
        if (!$el || $el.css('display') == 'none') {
            $el = $el.next('input, div');
        }
        $el.parent().find('.status').remove();
        $el.parent().append('<div class="row status"></div>');
        $el.addClass('error');
        if ($el.hasClass('select2')) {
            $el.next('.select2 ').addClass('error');
        }
        $el.val('');
        $el.parent().find('.status').addClass('error');
        $el.parent().find('.status').html('<i class="fa fa-exclamation-triangle padding-5"></i>' + data.responseJSON.errors[k]);
    });
    $obj = $($this).find('[name=' + Object.keys(data.responseJSON.errors)[0] + ']');
    $target = $($obj).offset().top - 300;
    if ($obj.is('textarea')) {
        $target = $obj.parent().find('.fr-box').offset().top - 300;
    }
    if ($obj.is('input:hidden')) {
        $target = $obj.parent().offset().top - 300;
    }
    $('html, body').animate({ scrollTop: $target }, 800);
    $obj.focus();
}

function limpaValidacao($this) {
    $this.find('.status').each(function() {
        $(this).remove()
        $this.parents('div').find('.error').removeClass('error');
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


function makeImgEditor($this) {
    $.FroalaEditor.DefineIcon('imageReplace', { NAME: 'image' });
    $this.froalaEditor({
        language: 'pt_br',
        imageEditButtons: ['imageReplace', 'imageAlign', 'imageCaption', 'imageRemove'],
        imageInsertButtons: ['imageUpload', 'imageManager'],
        imageUploadParams: {
            _token: $('meta[name=_token]').attr('content'),
        },
        imageUploadURL: routes.sistema.dash.ajax.upload,
        imageManagerDeleteMethod: 'DELETE',
        imageManagerDeleteURL: routes.sistema.dash.ajax.delete,
        imageManagerLoadMethod: 'POST',
        imageManagerLoadURL: routes.sistema.dash.ajax.load,
        imageManagerPageSize: 5,
        imageManagerScrollOffset: 5
    });
    $this.on('click', function() {
        $this.data('froala.editor').commands.exec('imageReplace');
    });
}

function getDataDados($this, $name, $target, $default = null) {
    $.ajax({
        url: $this.data('url'),
        headers: {
            'X-CSRF-Token': $('meta[name=_token]').attr('content')
        },
        async: true,
        method: 'POST',
        data: { sid: Math.random, id: $this.val(), name: $name, url: $($target).find('.select2').data('url'), select: true, default: $default },
        success: function(data) {
            $('body').removeClass('load');
            $($target).html(data);          
            $($target).find('.select2').each(function() {
                makeSelect2($(this));
            })
        },
        beforeSend: function() {
            $('body').addClass('load');
        },
        complete: function() {}
    });
}

function makeSelect2($this) {
  
    $this.select2({
        placeholder: {
            id: '-1',
            text: 'Selecione uma opção',
            width: 'resolve'
        },
        allowClear: true,
    });
}


});