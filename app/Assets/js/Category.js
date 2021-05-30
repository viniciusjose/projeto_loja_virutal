$(document).ready(function () {
    showCategory();
});
/**
 * Função responsável por realizar a requisição ajax para o backend para
 * retornar os dados de categorias e apresentar os mesmos na tela principal.
 */
function showCategory(){
    $.ajax({
        type: "POST",
        url: "http://localhost:8000/Category/listCategory",
        dataType: "json",
        success: function (json) {
            var html = '';
            for(var i in json){
                html += "<tr class='data-row'>\n\
                            <td class='data-grid-td'>\n\
                                <span class='data-grid-cell-content'>"+json[i].name_category+"</span>\n\
                            </td>\n\
                            <td class='data-grid-td'>\n\
                                <span class='data-grid-cell-content'>"+json[i].cod_category+"</span>\n\
                            </td>\n\
                            <td class='data-grid-td'>\n\
                                <div class='actions'>\n\
                                    <div class='action edit'>\n\
                                        <span><a href='Category/EditScreen/"+json[i].id+"'>Editar</a></span>\n\
                                    </div>\n\
                                    <div class='action delete'>\n\
                                        <span><a href=''>Deletar</a></span>\n\
                                    </div>\n\
                                </div>\n\
                            </td>\n\
                        </tr>"; 
            }
            $('.data-row').after(html); 
        }
    });
}