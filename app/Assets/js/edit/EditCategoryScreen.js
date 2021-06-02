$(document).ready(function () {
    /**
     * Captura o evento de submit do form e chama a função com 
     * a requisição ajax para solicitar a alteração ao PHP.
     */
    $('#form-edit-category').bind('submit', function(e){
        e.preventDefault();
        var codCat = $('#category-code').val();
        var nameCat = $('#category-name').val();
        updateCategory(codCat, nameCat);
    });
});
/**
 * Função responsável por realizar a requisição de alteração de categoria
 * utilizando o AJax e após o sucesso receber como retorno o status da
 * transação e enviar uma mensagem de resposta para o usuário.
 * 
 * @param {String} cod_category 
 * @param {String} name_category 
 */
function updateCategory(cod_category, name_category){
    //Split na URL para armazenar o id da categoria fornecido como parâmetro. 
    var id_cat = window.location.href.split('/') 
    $.ajax({
        type: "POST",
        url: 'Category/updateCategory/'+id_cat[5],
        data: {
            'category-name' : name_category,
            'category-code': cod_category
        },
        dataType: "json",
        success: function (json) {
            if(json == true){
                $('#alert').addClass('success-msg');
                $('#alert').fadeIn().html('Categoria alterada com sucesso.');
                setTimeout(function(){
                    $('#alert').fadeOut('Slow')
                    $('#alert').fadeIn().html('');
                    $('#alert').removeClass('success-msg');
                }, 5000)
                return;
            }
            $('#alert').addClass('alert-msg');
                $('#alert').fadeIn().html('Código ou nome de categorias existentes.');
                setTimeout(function(){
                    $('#alert').fadeOut('Slow')
                    $('#alert').fadeIn().html('');
                    $('#alert').removeClass('alert-msg');
                }, 5000)
        }
    });
}