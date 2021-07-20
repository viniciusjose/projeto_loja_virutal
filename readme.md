# Projeto Loja Virtual

O escopo do projeto consiste em codificar o back-end em PHP de uma loja virtual com cadastro, alteração,
exclusão de produtos em um banco de dados relacional ou não e cadastro, alteração e exclusão de categorias.

# Tecnologias que foram utilizadas

- PHP 7.4
- JQuery
- Docker
- Composer
- PHP CodeSniffer
- Banco de Dados Relacional (MySQL)
- HTML 5, CSS 3, Javascript

# Padrões Utilizados

- Padrão arquitetural MVC.
- Clean Code.
- PSR-1, PSR-2, PSR-4, PSR-5 e PSR-12.
- SOLID - Single Responsibility Principle

# Passo a Passo para instalação do Projeto.

- Realizar a clonagem do projeto para o seu repositório local.
- Após a clonagem, na raiz no diretório do projeto clonado utilizar o comando git checkout desafio.
- Instalar o docker conforme a documentação de instalação ( https://docs.docker.com/engine/install/ )
- Após instalação do docker utilizar o comando docker-compose up -d na raiz do projeto.
- Realizar a importação do arquivo de exportação do banco de dados chamado "projeto_webjump_final.sql" armazenado na pasta database
na raiz do projeto.
- Todas as configurações globais do sistema encontra-se no arquivo conf.ini (app/Config/conf.ini), caso não seja
alterado nenhum parâmetro nas configurações do docker-compose não é necessário alterar este arquivo.
- Para o bom funcionamento da função de envio de imagem é necessário conceder permissão de escrita e leitura para a pasta onde o seu
projeto foi clonado.
- Para acessar aplicação basta abrir o navegador e digitar http://localhost na barra de navegação.

# Como foi desenvolvido

- Modelagem do banco de dados.
- Criação do banco de dados.
- Implementação do padrão arquitetural MVC.
- Desenvolvimento das classes core do sistema sendo elas Controller.php, Model.php, Core.php .
- Implementada conexão ao banco de dados MySQL.
- Desenvolvimento das funções de categorias (CREATE, READ, UPDATE, DELETE).
- Desenvolvimento das funções de produtos e o seu relacionamento com as categorias cadastradas (CREATE, READ, UPDATE, DELETE).
- Apresentação de produtos e categorias cadastradas nas telas de produtos e categorias.  
- Apresentação dos produtos cadastrados com as suas respectivas imagens no dashboard da aplicação.
- Criação da tabela de logs e triggers after INSERT, UPDATE, DELETE nas tabelas categoria e produto.
- Apresentação dos logs da aplicação.

# Funções do Sistema

- Create, Read, Update, Delete de Categorias.
- Validação de inserção e atualização de categorias duplicadas.
- Apresentação de todas as categorias cadastradas.
- Create, Read, Update, Delete de Produtos.
- Validação de extensão de arquivos de imagens sendo suportadas somente as extensões jpeg, jpg, png e gif.
- Exclusão de produto cadastrado apaga a imagem do produto salva no diretório app/Assets/images/product.
- Atualização de produto cadastrado atualiza a imagem do produto salva no diretório app/Assets/images/product.
- Tratamento de erro 404 para paginas nao existentes na aplicação.

# Melhorias Futuras

- Desenvolver testes automatizados.
