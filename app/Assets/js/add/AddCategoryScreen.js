$(document).ready(function () {
    /**
     * Captura do envio de submit do formulário #form-add-category
     * e chamada da função que realiza a persistência dos dados de
     * categoria.
     */
    $('#form-add-category').on('submit', function (e) {
        e.preventDefault();
        var codCat = $('#category-code').val();
        var nameCat = $('#category-name').val();
        insertCategory(codCat,nameCat)
    });
});
/**
 * Requisição ajax com dados das categorias.
 *
 * Método que executa a requisição ajax com os dados inseridos pelo usuário
 * para o método addCategory no arquivo CategoryController.
 *
 * @param {String} codCat
 * @param {String} nameCat
 */
function insertCategory(codCat, nameCat)
{

    $.ajax({
        type: "POST",
        url: "http://localhost/Category/addCategory",
        dataType:'json',
        data: {
            'category-name':nameCat,
            'category-code':codCat
        },
        success: function (json) {
            if (json == true) {
                $('#form-add-category').trigger("reset");
                $('#alert').addClass('success-msg');
                $('#alert').fadeIn().html('Categoria cadastrada com sucesso.');
                setTimeout(function () {
                    $('#alert').fadeOut('Slow')
                    $('#alert').fadeIn().html('');
                    $('#alert').removeClass('success-msg');
                }, 5000)
            } else {
                $('#alert').addClass('alert-msg');
                $('#alert').fadeIn().html('Erro ao cadastrar (Nome/Código de categorias duplicados.)');
                setTimeout(function () {
                    $('#alert').fadeOut('Slow')
                    $('#alert').fadeIn().html('');
                    $('#alert').removeClass('alert-msg');
                }, 5000)
            }
        }
    });
}