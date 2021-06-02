$(document).ready(function () {
   showProduct();
});

function showProduct(){
    $.ajax({
        type: "POST",
        url: "Product/listProduct",
        dataType: "json",
        success: function (json) {
            var html = "";
            for(var i in json){
                html += '<tr class="data-row">\n\
                            <td class="data-grid-td">\n\
                                <span class="data-grid-cell-content">'+json[i].name_product+'</span>\n\
                            </td>\n\
                            <td class="data-grid-td">\n\
                                <span class="data-grid-cell-content">'+json[i].sku+'</span>\n\
                            </td>\n\
                            <td class="data-grid-td">\n\
                                <span class="data-grid-cell-content">'+json[i].price+'</span>\n\
                            </td>\n\
                            <td class="data-grid-td">\n\
                                <span class="data-grid-cell-content">'+json[i].quantity+'</span>\n\
                            </td>\n\
                            <td class="data-grid-td">\n\
                                <span class="data-grid-cell-content">'+json[i].name_category+'</span>\n\
                            </td>\n\
                            <td class="data-grid-td">\n\
                                <span class="data-grid-cell-content"><a href="#" onclick="showModalImage(\''+json[i].image_product+'\')">Visualizar Imagem</a></span>\n\
                            </td>\n\
                            <td class="data-grid-td">\n\
                                <div class="actions">\n\
                                    <div class="action edit">\n\
                                        <span><a href="Product/EditScreen/">Editar</a></span>\n\
                                    </div>\n\
                                    <div class="action delete">\n\
                                        <span><a href="#" onclick="">Deletar</a></span>\n\
                                    </div>\n\
                                </div>\n\
                            </td>\n\
                        </tr>'; 
            }
            $(".data-row").after(html);
        }
    });
}

function showModalImage(img){

    $(".div_img").after("<img class='img_prod' src='Assets/images/product/"+img+"'></img>");
    $(".modal_bg_img").show();
    
}