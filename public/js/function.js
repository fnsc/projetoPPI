//Validade Login
$(document).ready(function () {
    $('#erro').hide();
    $('#formLogin').submit(function () {
        var email = $('#email').val();
        var senha = $('#senha').val();
        $.ajax({
            url: "/valida_login_usuario",
            type: "post",
            data: {email: email, senha: senha},
            success: function (result) {
                if (result == 1) {
                    location.href = '/'
                } else {
                    $('#erro').show()
//                    document.getElementById("erro").innerHTML+= "Usuário ou senha inválidos"
                }
            }
        })
        return false;
    })
})

//funcao modal
$('#myModalPet').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('whatever') // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.modal-footer input').val(recipient)
    modal.find('.modal-footer a.href').val('/exclir_pet/' + recipient)
})


$('#myModalCare').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('whatever') // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.modal-footer input').val(recipient)
    modal.find('.modal-footer a.href').val('/exclir_care/' + recipient)
})