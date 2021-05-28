<?php
    /**
     * Realiza todas as implementações das paginas relacionadas a categorias.
     * 
     * Classe responsável por conter toda a regra de negocio da implementação de
     * categorias no sistema.
    **/
    class CategoryController extends Controller{
        /**
         * Página Principal da aplicação
         *
         * Método responsável por realizar a chamada do template e desenhar a pagina inicial
         * de categorias.
         *
         * @param Array $data Todos os dados que serão fornecidos para o front-end da aplicação
         **/
        public function index(){
            $data = [
                'page' => 'Categorias',
                'scriptPage' => 'Category'
            ];
            $this->loadTemplate('Categories', $data);
        }
        /**
         * Página de adição de novas categorias da aplicação
         *
         * Método responsável por realizar a chamada do template e desenhar a pagina de adição
         * de novas categorias no sistema
         *
         * @param Array $data Todos os dados que serão fornecidos para o front-end da aplicação
         **/
        public function addScreen(){
            $data = [
                'page' => 'Adicionar Categorias',
                'scriptPage' => 'Category'
            ];
            $this->loadTemplate('AddCategory', $data);
        }
        /**
         * Método de persistência de novas categorias ao banco de dados.
         *
         * Método responsável por receber a requisição ajax do script Category.js, tratar as informações
         * e requisitar a função (insertCategory) de inserção de categoria ao banco de dados que esta localizada
         * na pasta models/CategoryRepository.php
         *
         * @param Boolean $status Responsável pelo retorno para o front-end.
         * @param String $name Nome da categoria recebida pela requisição ajax
         * @param String $cod Código da categoria recebida pela requisição ajax
         * @return Boolean
         **/
        public function addCategory(){
            $status = true;
            $cateRepo = new CategoryRepository();
            $name = ucfirst(addslashes($_POST['category-name']));
            $cod = strtoupper($_POST['category-code']);
            if($cateRepo->insertCategory($cod, $name)){
                echo json_encode($status);
            }else{ 
                $status = false;
                echo json_encode($status);
            }
            
        }
        
    }
?>