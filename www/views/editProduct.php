<!-- Main Content -->
<main class="content">
  <h1 class="title new-item">Alterar Produto</h1>
  
  <form action="../backend/ProductRepository.php" enctype = "multipart/form-data" method="POST">
    <div class="input-field">
      <label for="sku" class="label">Produto SKU</label>
      <input type="text" id="sku" required name="sku-edit" class="input-text" value=""/> 
    </div>
    <div class="input-field">
      <label for="name" class="label">Nome Produto</label>
      <input type="text" id="name" required name="name-edit"class="input-text" value=""/> 
    </div>
    <div class="input-field">
      <label for="price" class="label">Preço</label>
      <input type="text" id="price" required name="price-edit"class="input-text" value=""/> 
    </div>
    <div class="input-field">
      <label for="quantity" class="label">Quantidade</label>
      <input type="number" id="quantity" required name="quantity-edit"class="input-text" value=""/> 
    </div>
    <div class="input-field">
      <label for="category" class="label">Categorias</label>
      
    </div>
    <div class="input-field">
      <label for="description" class="label">Descrição</label>
      <textarea id="description" class="input-text" required name="description-edit"></textarea>
    </div>
    <div class="input-field">
      <label for="image" class="label">Selecione uma imagem</label>
      <input id="image" type="file" name="arquivo" class="input-text">
      <a href="">Visualizar Imagem</a> 
    </div>
    <div class="actions-form">
      <a href="products.html" class="action back">Voltar</a>
      <p>Para adicionar um novo produto, é obrigatório ter ao menos 1 categoria disponível para seleção</p>
      <input class="btn-submit btn-action" type="submit" value="Alterar Produto" />
    </div>
  </form>
</main>
<!-- Main Content -->