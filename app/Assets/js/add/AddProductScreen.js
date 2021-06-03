$(document).ready(function () {
  listCategory();
  $('#form-add-product').bind('submit', function(e){
    e.preventDefault();
    var form = $('#form-add-product')[0];
    var data = new FormData(form);
    addProduct(data);
  });
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
function addProduct(data){
    $.ajax({
        type: "POST",
        url: "addProduct",
        data: data,
        contentType:false,
        processData:false,
        success: function () {
            $('html, body').animate({scrollTop : 0},800);
            $('#form-add-product').trigger("reset");
            $('#alert').addClass('success-msg');
            $('#alert').fadeIn().html('Produto cadastrado com sucesso.');
            setTimeout(function(){
                $('#alert').fadeOut('Slow')
                $('#alert').fadeIn().html('');
                $('#alert').removeClass('success-msg');
            }, 6000)
        }
    });
}