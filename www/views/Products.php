
  <!-- Main Content -->
  <main class="content">
    
    <div class="header-list-page">
      <h1 class="title">Produtos</h1>
      <a href="<?php echo BASE_URL?>/Product/addProduct" class="btn-action">Adicionar novo produto</a>
    </div>
    <form  method="GET">
      <div class="input-field">
        <label for="search" class="label">Pesquisar por nome do produto ou categoria:</label>
        <input type="search" id="search" name="search" class="input-text" /> 
        <input class="btn-submit btn-action" type="submit" value="Pesquisar" />
      </div>
    </form>

    <table class="data-grid">
      <tr class="data-row">
        <th class="data-grid-th">
            <span class="data-grid-cell-content">Nome</span>
        </th>
        <th class="data-grid-th">
            <span class="data-grid-cell-content">SKU</span>
        </th>
        <th class="data-grid-th">
            <span class="data-grid-cell-content">Preço</span>
        </th>
        <th class="data-grid-th">
            <span class="data-grid-cell-content">Quantidade</span>
        </th>
        <th class="data-grid-th">
            <span class="data-grid-cell-content">Categorias</span>
        </th>
        <th class="data-grid-th">
          <span class="data-grid-cell-content">Imagem</span>
        </th>

        <th class="data-grid-th">
            <span class="data-grid-cell-content">Ações</span>
        </th>
      </tr>
    </table>
  </main>
  <!-- Main Content -->