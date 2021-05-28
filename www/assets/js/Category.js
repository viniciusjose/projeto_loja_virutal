$(document).ready(function () {
    showCategory();
});
/**
 * 
 */
function showCategory(){
    $.ajax({
        type: "POST",
        url: "http://localhost:8000/Category/listCategory",
        dataType: "json",
        success: function (json) {
            var html = '';
            for(var i in json){
                html += "<tr class='data-row'><td class='data-grid-td'><span class='data-grid-cell-content'>"+json[i].name_category+"</span></td><td class='data-grid-td'><span class='data-grid-cell-content'>"+json[i].cod_category+"</span></td> <td class='data-grid-td'><div class='actions'><div class='action edit'><span><a href=''>Editar</a></span></div><div class='action delete'><span><a href=''>Deletar</a></span></div></div></td></tr>"; 
            }
            $('.data-row').after(html);
            
        }
    });
}