$(document).ready(function () {
    /*Ação para cadastro de categorias ao banco de dados*/
    $('#form-add-category').on('submit', function(e){
        e.preventDefault();
        var codCat = $('#category-code').val();
        var nameCat = $('#category-name').val();
       
        $.ajax({
            type: "POST",
            url: "http://localhost:8000/Category/addCategory",
            data: {
                'category-name':nameCat,
                'category-code':codCat
            },
            success: function (result) {
                $('#form-add-category').trigger("reset");
                $('#alert').addClass('alert-msg');
                $('#alert').fadeIn().html(result);
                setTimeout(function(){
                    $('#alert').fadeOut('Slow')
                }, 5000)
            }
        });
    });
});