$(document).ready(function () {
    listProduct();
});
/**
 *
 * Método responsável por realizar a requisição ajax
 * para receber os produtos armazenados no banco de dados
 * e realizar a renderização do conteúdo na tela.
 *
 */
function listProduct()
{

    $.ajax({
        type: "POST",
        url: "Product/listProduct",
        dataType: "json",
        success: function (json) {
            var html = "";
            for (var i in json) {
                html += '<li>\n\
                            <div class="product-image">\n\
                                <img src="Assets/images/product/' + json[i].image_product + '" layout="responsive" width="164" height="145" alt="' + json[i].name_product + '">\n\
                            </div>\n\
                            <div class="product-info">\n\
                                <div class="product-name">\n\
                                    <span>' + json[i].name_product + '</span>\n\
                                </div>\n\
                                <div class="product-price">\n\
                                    <span class="special-price">\n\
                                        <font color="green">' + json[i].quantity + ' Disponíveis</font>\n\
                                    </span>\n\
                                    <span>R$ ' + json[i].price + '</span>\n\
                                </div>\n\
                            </div>\n\
                        </li>';
            }
            $(".product-list").append(html);
        }
    });
}