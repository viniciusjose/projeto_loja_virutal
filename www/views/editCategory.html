
  <!-- Main Content -->
  <main class="content">
    <h1 class="title new-item">Editar Categoria</h1>
    <!-- Script para populaçaõ dos inputs de categoria -->
    <?php
      require_once '../backend/CategoryRepository.php';
      require_once '../backend/CategoryViewer.php';
        
      $categories = new CategoryViewer();
      $categories = $categories->readCategory();

      if((isset($_POST['category-name-edit']) && !empty("category-name-edit")) &&
      (isset($_POST['category-code-edit']) && !empty($_POST['category-code-edit']))) {
        include '../backend/Connection.php';
        $category = new Category();
        $category->setName(addslashes(ucwords($_POST['category-name-edit'])));
        $category->setCod(addslashes(strtoupper($_POST['category-code-edit'])));
        $category->setId(addslashes(intval($_GET['idEdit'])));
        $name = $category->getName();
        $cod =  $category->getCod();
        $id = $category->getId();
        $sql = "UPDATE category SET cod_category = '$cod', name_category = '$name' WHERE category.id = '$id'";
        $database->query($sql);
        $_SESSION['status'] = "Alterado com sucesso";
        header("Location: categories.html");
      }
    ?>  
    
    <form method="POST">
      <div class="input-field">
        <label for="category-name" class="label">Nome de categoria</label>
        <input type="text" id="category-name"  name="category-name-edit" class="input-text" value="<?php echo $categories['name_category']?>"/>
        
      </div>
      <div class="input-field">
        <label for="category-code" class="label">Código de categoria</label>
        <input type="text" id="category-code" name="category-code-edit" class="input-text" value="<?php echo $categories['cod_category']?>"/>
        
      </div>
      <div class="actions-form">
        <a href="categories.html" class="action back">Voltar</a>
        <input class="btn-submit btn-action"  type="submit" value="Alterar" />
      </div>
    </form>
  </main>
  <!-- Main Content -->