<?php
    namespace MyApp\Controller;
    
    class ImageController
    {
        public function AddProductImage()
        {
            // script de verificação de imagem
            if ( isset( $_FILES[ 'archive' ][ 'name' ] ) && $_FILES[ 'archive' ][ 'error' ] == 0 ) {

                $archive_tmp = $_FILES[ 'archive' ][ 'tmp_name' ];
                $name = $_FILES[ 'archive' ][ 'name' ];
            
                // Pega a extensão
                $extension = pathinfo ( $name, PATHINFO_EXTENSION );
            
                // Converte a extensão para minúsculo
                $extension = strtolower ( $extension );
            
                // Somente imagens, .jpg;.jpeg;.gif;.png
                // Aqui eu enfileiro as extensões permitidas e separo por ';'
                // Isso serve apenas para eu poder pesquisar dentro desta String
                if ( strstr ( '.jpg;.jpeg;.gif;.png', $extension ) ) {
                    // Cria um name único para esta imagem
                    // Evita que duplique as imagens no servidor.
                    // Evita nomes com acentos, espaços e caracteres não alfanuméricos
                    $newName = uniqid ( time () ) . '.' . $extension;
            
                    // Concatena a pasta com o name
                    $archivePath = $_SERVER['DOCUMENT_ROOT'].'/Assets/images/product/'. $newName;
            
                    // tenta mover o archive para o archivePath
                    if ( @move_uploaded_file ( $archive_tmp, $archivePath ) ) {
                        
                    }
                    else
                        echo 'Erro ao salvar o archive. Aparentemente você não tem permissão de escrita.<br />';
                }
                else
                    echo 'Você poderá enviar apenas arquivos "*.jpg;*.jpeg;*.gif;*.png"<br />';
            }
            else
                echo 'Você não enviou nenhum archive!';
            
            return $newName;
        }
        public function UpdateProductImage() :string
        {
            // script de verificação de imagem

                $archive_tmp = $_FILES[ 'archive' ][ 'tmp_name' ];
                $name = $_FILES[ 'archive' ][ 'name' ];
            
                // Pega a extensão
                $extension = pathinfo ( $name, PATHINFO_EXTENSION );
            
                // Converte a extensão para minúsculo
                $extension = strtolower ( $extension );
            
                // Somente imagens, .jpg;.jpeg;.gif;.png
                // Aqui eu enfileiro as extensões permitidas e separo por ';'
                // Isso serve apenas para eu poder pesquisar dentro desta String
                if ( strstr ( '.jpg;.jpeg;.gif;.png', $extension ) ) {
                    // Cria um name único para esta imagem
                    // Evita que duplique as imagens no servidor.
                    // Evita nomes com acentos, espaços e caracteres não alfanuméricos
                    $newName = uniqid ( time () ) . '.' . $extension;
            
                    // Concatena a pasta com o name
                    $archivePath = '../Assets/images/product/ ' . $newName;
            
                    // tenta mover o archive para o archivePath
                    if ( @move_uploaded_file ( $archive_tmp, $archivePath ) ) {
                        
                    }
                    else
                        echo 'Erro ao salvar o archive. Aparentemente você não tem permissão de escrita.<br />';
                }
                else
                    echo 'Você poderá enviar apenas arquivos "*.jpg;*.jpeg;*.gif;*.png"<br />';
            
            
            return $archivePath;
        }
    }