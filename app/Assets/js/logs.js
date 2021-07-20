$(document).ready(function () {
    showLogs();
});

/**
 *
 * Método responsável por realizar a requisição
 * ajax para o backend, assim possibilitando a
 * disponibilização de todos os logs do sistema.
 *
 */
function showLogs()
{
    $.ajax({
        type: "GET",
        url: "http://localhost/Log/showLogs",
        dataType: "json",
        success: function (json) {
            var html = "";
            for (var i in json) {
                html += '<tr class="data-row">\n\
                            <td class="data-grid-td">\n\
                            <span class="data-grid-cell-content">' + json[i].date_alter + '</span>\n\
                            </td>\n\
                            <td class="data-grid-td">\n\
                                <span class="data-grid-cell-content">' + json[i].field_alter + '</span>\n\
                            </td>\n\
                            <td class="data-grid-td">\n\
                                <span class="data-grid-cell-content">' + json[i].desc_alter + '</span>\n\
                            </td>\n\
                        </tr>';
            }
            $(".data-row").after(html);
        }
    });
}