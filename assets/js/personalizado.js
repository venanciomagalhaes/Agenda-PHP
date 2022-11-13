
$('#telefone').mask('(31) 9 9999-9999')
$('#editar-agendamento').validate({
    rules: {
        'nome-cliente': {
            required: true,
            minlength: 3,
        },

        'data': {
            required: true,
            date: true
        },
        'telefone': {
            required: true,
        },
        'horario': {
            required: true,
        },
        'servico': {
            required: true,
            minlength: 10,
            maxlength: 2500,
        }
    }
})


$('#cadastrar-agendamento').validate({
    rules: {
        'nome-cliente': {
            required: true,
            minlength: 3,
        },

        'data': {
            required: true,
            date: true
        },
        'telefone': {
            required: true,
        },
        'horario': {
            required: true,
        },
        'servico': {
            required: true,
            minlength: 10,
            maxlength: 2500,
        }
    }
})

$(document).ready(function () {

    $('input[type="tel"]').mask('(31) 9 9999-9999');

});

$('input').attr('autocomplete', 'off')