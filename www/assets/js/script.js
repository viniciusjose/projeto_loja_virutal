$(document).ready(function () {
    /*Ação para cadastro de categorias ao banco de dados*/
    $('#form-add-category').on('submit', function(e){
        e.preventDefault();
        var codCat = $('#category-code').val();
        var nameCat = $('#category-name').val();
       
        $.ajax({
            type: "POST",
            url: "http://localhost:8000/Category/addCategory",
            dataType:'json',
            data: {
                'category-name':nameCat,
                'category-code':codCat
            },
            success: function (json) {
                if(json == true){
                    $('#form-add-category').trigger("reset");
                    $('#alert').addClass('success-msg');
                    $('#alert').fadeIn().html('Categoria cadastrada com sucesso.');
                    setTimeout(function(){
                        $('#alert').fadeOut('Slow')
                        $('#alert').fadeIn().html('');
                        $('#alert').removeClass('success-msg');
                    }, 5000)
                }else{
                    $('#alert').addClass('alert-msg');
                    $('#alert').fadeIn().html('Erro ao cadastrar (Nome/Código de categorias duplicados.)');
                    setTimeout(function(){
                        $('#alert').fadeOut('Slow')
                        $('#alert').fadeIn().html('');
                        $('#alert').removeClass('alert-msg');
                    }, 5000)
                }
            }
        });
    });
});