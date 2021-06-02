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
                                <span class="data-grid-cell-content">'+json[i].categories+'</span>\n\
                            </td>\n\
                            <td class="data-grid-td">\n\
                                <span class="data-grid-cell-content"><a href="#" onclick="showModalImage(\''+json[i].image_product+'\')">Visualizar Imagem</a></span>\n\
                            </td>\n\
                            <td class="data-grid-td">\n\
                                <div class="actions">\n\
                                    <div class="action edit">\n\
                                        <span><a href="Product/EditScreen/'+json[i].id_prod+'">Editar</a></span>\n\
                                    </div>\n\
                                    <div class="action delete">\n\
                                        <span><a href="#" onclick="modalDelete('+json[i].id_prod+', \''+json[i].name_product+'\')">Deletar</a></span>\n\
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

function modalDelete(id, name){
    $('.modal').find('p:eq(0)').html('Produto: ('+name+') --- ID: '+id);
    $('.modal_bg').show();
    $('.btn-delete').bind('click', function(){
        deleteProduct(id);
    });
}
function deleteProduct(id){
    $.ajax({
        type: "POST",
        url: "Product/removeProduct/"+id,
        success: function () {
            window.location.reload();
        }
    });
}