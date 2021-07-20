<?php

namespace MyApp\Controller;

/**
 * Classe responsável pelo tratamento das imagens.
 *
 * Recebe a imagem através da função addProductImage
 * e retorna para o solicitante o novo nome criptografado
 * da imagem.
 *
**/
class ImageController
{
    /**
     * Método responsável pelo recebimento da imagem.
     *
     * Recebe a imagem a imagem e realiza verificações de extensõws
     * para evitar envio de arquivos que não imagens, realiza a ação
     * de mover o arquivo do PATH temporário, para a pasta pré-definida
     * e retorna para o controller o novo nome da imagem.
     *
    **/
    public function addProductImage()
    {
        if (isset($_FILES[ 'archive' ][ 'name' ]) && $_FILES[ 'archive' ][ 'error' ] == 0) {
            $archive_tmp = $_FILES[ 'archive' ][ 'tmp_name' ];
            $name = $_FILES[ 'archive' ][ 'name' ];

            // Pega a extensão
            $extension = pathinfo($name, PATHINFO_EXTENSION);

            // Converte a extensão para minúsculo
            $extension = strtolower($extension);

            // Somente imagens, .jpg;.jpeg;.gif;.png
            // Aqui eu enfileiro as extensões permitidas e separo por ';'
            // Isso serve apenas para eu poder pesquisar dentro desta String
            if (strstr('.jpg;.jpeg;.gif;.png', $extension)) {
                // Cria um name único para esta imagem
                // Evita que duplique as imagens no servidor.
                // Evita nomes com acentos, espaços e caracteres não alfanuméricos
                $newName = uniqid(time()) . '.' . $extension;

                // Concatena a pasta com o name
                $archivePath = $_SERVER['DOCUMENT_ROOT'] . '/Assets/images/product/' . $newName;

                // tenta mover o archive para o archivePath
                @move_uploaded_file($archive_tmp, $archivePath);

                return $newName;
            }
            return false;
        }
        return true;
    }
}
