$(document).ready(function () {
    showProduct();
});

/**
 * Método que disponibiliza todas as informações dos produtos
 * cadastrados no sistema através de um requisição ajax para
 * o ProductController.
 */
function showProduct()
{
    $.ajax({
        type: "POST",
        url: "Product/listProduct",
        dataType: "json",
        success: function (json) {
            var html = "";
            for (var i in json) {
                html += '<tr class="data-row">\n\
                            <td class="data-grid-td">\n\
                            <span class="data-grid-cell-content">' + json[i].sku + '</span>\n\
                            </td>\n\
                            <td class="data-grid-td">\n\
                                <span class="data-grid-cell-content">' + json[i].name_product + '</span>\n\
                            </td>\n\
                            <td class="data-grid-td">\n\
                                <span class="data-grid-cell-content">R$ ' + json[i].price + '</span>\n\
                            </td>\n\
                            <td class="data-grid-td">\n\
                                <span class="data-grid-cell-content">' + json[i].quantity + '</span>\n\
                            </td>\n\
                            <td class="data-grid-td">\n\
                                <span class="data-grid-cell-content">' + json[i].categories + '</span>\n\
                            </td>\n\
                            <td class="data-grid-td">\n\
                                <span class="data-grid-cell-content"><a href="#" onclick="showModalImage(\'' + json[i].image_product + '\')">Visualizar Imagem</a></span>\n\
                            </td>\n\
                            <td class="data-grid-td">\n\
                                <div class="actions">\n\
                                    <div class="action edit">\n\
                                        <span><a href="Product/EditScreen/' + json[i].id_prod + '">Editar</a></span>\n\
                                    </div>\n\
                                    <div class="action delete">\n\
                                        <span><a href="#" onclick="modalDelete(' + json[i].id_prod + ', \'' + json[i].name_product + '\')">Deletar</a></span>\n\
                                    </div>\n\
                                </div>\n\
                            </td>\n\
                        </tr>';
            }
            $(".data-row").after(html);
        }
    });
}

/**
 * Método que recebe como parâmetro o nome da
 * imagem a ser exibida no modal através da biblioteca
 * do JQuery.
 *
 * @param {String} img
 */
function showModalImage(img)
{

    $(".div_img").after("<img class='img_prod' src='Assets/images/product/" + img + "'></img>");
    $(".modal_bg_img").show();

}

/**
 *
 * Método que recebe como parâmetro o nome da imagem a
 *ser exibida no modal através da biblioteca do JQuery.
 *
 * @param {Int} id
 * @param {String} name
 */
function modalDelete(id, name)
{
    $('.modal').find('p:eq(0)').html('Produto: (' + name + ') --- ID: ' + id);
    $('.modal_bg').show();
    $('.btn-delete').bind('click', function () {
        deleteProduct(id);
    });
}
/**
 *
 * Método realiza a requisição de remoção de produtos
 * cadastrados no sistema.
 *
 * @param {Int} id
 */
function deleteProduct(id)
{
    $.ajax({
        type: "POST",
        url: "Product/removeProduct/" + id,
        success: function () {
            window.location.reload();
        }
    });
}