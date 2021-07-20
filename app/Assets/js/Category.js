$(document).ready(function () {
    //Listagem das categorias.
    showCategory();
});
/**
 * Método responsável por realizar a requisição ajax para o backend para
 * retornar os dados de categorias e apresentar os mesmos na tela principal.
 */
function showCategory()
{
    $.ajax({
        type: "POST",
        url: "Category/listCategory",
        dataType: "json",
        success: function (json) {
            var html = '';
            for (var i in json) {
                html += "<tr class='data-row'>\n\
                            <td class='data-grid-td'>\n\
                                <span class='data-grid-cell-content'>" + json[i].cod_category + "</span>\n\
                            </td>\n\
                            <td class='data-grid-td'>\n\
                                <span class='data-grid-cell-content'>" + json[i].name_category + "</span>\n\
                            </td>\n\
                            <td class='data-grid-td'>\n\
                                <div class='actions'>\n\
                                    <div class='action edit'>\n\
                                        <span><a href='Category/EditScreen/" + json[i].id + "'>Editar</a></span>\n\
                                    </div>\n\
                                    <div class='action delete'>\n\
                                        <span><a href='#' onclick='showModal(" + json[i].id + ", \"" + json[i].name_category + "\")'>Deletar</a></span>\n\
                                    </div>\n\
                                </div>\n\
                            </td>\n\
                        </tr>";
            }
            $('.data-row').after(html);
        }
    });
}
/**
 * Método responsável por mostrar a janela modal e capturar a ação
 * de click do botão Excluir e chamar a função de exclusão
 *
 * @param {Integer} id Id de identificação da categoria.
 * @param {String} name Nome da categoria a ser excluída.
 */
function showModal(id, name)
{
        $('.modal').find('p:eq(0)').html('Voce tem certeza que deseja excluir a categoria (' + name + ') ?');
        $('.modal_bg').show();
        $('.btn-delete').bind('click', function () {
            deleteCategory(id);
        });
}
/**
 * Método responsável por realizar a requisição ajax
 * responsável por solicitar a exclusão do produto para
 * a classe CategoryController no PHP.
 *
 * @param {Integer} id Id de identificação da categoria.
 */
function deleteCategory(id)
{
    $.ajax({
        type: "POST",
        url: "http://localhost/Category/removeCategory/" + id,
        data: {
            "id":id
        },
        success: function () {
            window.location.reload();
        }
    });
}