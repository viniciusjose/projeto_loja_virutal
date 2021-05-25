
  <!-- Main Content -->
  <main class="content">
    <div class="header-list-page">
      <h1 class="title">Categorias</h1>
      <a href="<?php echo BASE_URL?>Category/addScreen" class="btn-action">Adicionar nova categoria</a>
    </div>
    <form  method="GET">
      <div class="input-field">
        <label for="search" class="label">Pesquisar por nome de categoria:</label>
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
            <span class="data-grid-cell-content">Código da Categoria</span>
        </th>
        <th class="data-grid-th">
            <span class="data-grid-cell-content">Ações</span>
        </th>
      </tr>
    </table>
  </main>