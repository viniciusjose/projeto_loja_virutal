$(document).ready(function () {
    $('#form-edit-product').bind('submit', function (e) {
        e.preventDefault();
        var form = $('#form-edit-product')[0];
        var data = new FormData(form);
        editProduct(data);
    });
});
/**
 * Método responsável por realizar a requisição Ajax
 * via POST com os dados de editados do produto para
 * o arquivo ProductController.
 *
 * @param {Array} data
 */
function editProduct(data)
{
    var id_product = window.location.href.split('/');
    $.ajax({
        type: "POST",
        url: "http://localhost/Product/editProduct/" + id_product[5],
        data: data,
        contentType:false,
        processData:false,
        dataType: "json",
        success: function (json) {
            if (json == true) {
                $('html, body').animate({scrollTop : 0},800);
                $('#alert').addClass('success-msg');
                $('#alert').fadeIn().html('Produto alterado com sucesso.');
                setTimeout(function () {
                    $('#alert').fadeOut('Slow')
                    $('#alert').fadeIn().html('');
                    $('#alert').removeClass('success-msg');
                }, 5000)
            } else {
                $('html, body').animate({scrollTop : 0},800);
                $('#alert').addClass('alert-msg');
                $('#alert').fadeIn().html('Problemas ao alterar o produto, arquivo de imagem selecionado está em formato inválido.');
                setTimeout(function () {
                    $('#alert').fadeOut('Slow')
                    $('#alert').fadeIn().html('');
                    $('#alert').removeClass('alert-msg');
                }, 5000)
            }

        }
    });
}

/**
 * Método responsável por requisitar a imagem do produto
 * selecionado e disponibilizar a visualização em um Modal.
 */
function showModalImage()
{

    var id_product = window.location.href.split('/');
    $.ajax({
        type: "POST",
        url: "http://localhost/Product/imageProductEditScreen/" + id_product[5],
        dataType: "json",
        success: function (json) {
            $(".div_img").find("img").attr("src", "../../Assets/images/product/" + json);
            $(".modal_bg_img").show();
        }
    });
}

/**
 * Método de fechamento do modal.
 */
function closeModal()
{
    $(".modal_bg_img").hide();
    $(".div_img").find('img').attr("src", "");
}