$(document).ready(function () {
    /*Ação para cadastro de categorias ao banco de dados*/
    $('#form-add-category').on('submit', function(e){
        e.preventDefault();
        var form = $('#form-add-category')[0];
        var data = new FormData(form);

        $.ajax({
            type: "POST",
            url: "http://localhost:8000/Category/addCategory",
            data: data,
            contentType:false,
            processData:false,
            success: function (msg) {
                if(msg == true){
                    $('.title').after('<p class="success-msg">Categoria cadastrada com sucesso.</p>');
                    $('#category-name').val("");
                    $('#category-code').val("");
                }else{
                    $('.title').after('<p class="error-msg">Erro ao cadastrar (Nome ou Código de Categoria existentes).</p>');
                }
                
            },
            error: function(){
                $('.title').after('<p class="error-msg">Erro ao cadastrar.</p>');
            }
        });
    });
});