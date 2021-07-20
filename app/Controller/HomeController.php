<?php

namespace MyApp\Controller;

use MyApp\Core\Controller;
use MyApp\Model\ProductRepository;

/**
 * Disponibiliza informações necessárias para renderização da página.
 *
 * Classe responsável por requisitar a renderização da pagina inicial
 * com os dados necessários dos produtos.
**/
class HomeController extends Controller
{
    /**
     * Responsável pela renderização da pagina inicial do sistema.
     *
     * requisita a quantidade de produtos cadastrados no banco de
     * dados e disponibiliza a informação para o front-end.
     *
     **/
    public function index()
    {
        $prodRepo = new ProductRepository();
        $countProduct = $prodRepo->countProducts();
        $data = [
            'title'           => 'Dashboard',
            'BASE_URL'        => BASE_URL,
            'scriptPage'      => 'Dashboard',
            'NUMBER_PRODUCTS' => $countProduct['count_product']
        ];
        $this->loadTemplate('Dashboard', $data);
    }
}
