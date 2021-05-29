$(document).ready(function () {
  listCategory();
});

/**
 * Função responsável por realizar a requisição ajax para o arquivo CategoryController 
 * para recuperar os dados de categorias e adicionar no multiple select da página 
 * de adicionar produto.
 */
function listCategory(){

    $.ajax({
        type: "POST",
        url: "http://localhost:8000/Category/listCategory",
        dataType: "json",
        success: function (json) {
            var html = '';
            for(var i in json){
                html += '<option value ='+json[i].id+'>'+json[i].name_category+'</option>';
            }
            $('#category').append(html); 
        }
    });
}