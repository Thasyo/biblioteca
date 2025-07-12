<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Biblioteca Cadastro de Livros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  </head>
  <body>
    <div>
        <?php

use App\Model\Categoria;

 include VIEWS . '/Includes/menu.php'?>
    </div>

    <form method="post" action="/livro/cadastro" class="p-5">

        <input type="hidden" value="<?= $model->getId() ?>" name="id">

        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" value="<?= $model->getTitulo() ?>" name="titulo" id="titulo">
        </div>

        <div class="mb-3">
            <label for="isbn" class="form-label">ISBN</label>
            <input type="text" class="form-control" value="<?= $model->getISBN() ?>" name="isbn" id="isbn">
        </div>

        <div class="mb-3">
            <label for="editora" class="form-label">Editora</label>
            <input type="text" class="form-control" value="<?= $model->getEditora() ?>" name="editora" id="editora">
        </div>

        <div class="mb-3">
            <label for="ano" class="form-label">Ano</label>
            <input type="text" class="form-control" value="<?= $model->getAno() ?>" name="ano" id="ano">
        </div>

        <div class="mb-3">
            <label for="id_categoria" class="form-label">Categoria</label>
            <select class="form-control" name="id_categoria" id="id_categoria">
                <option value="">Selecione uma categoria</option>
                <?php foreach($model->getRowsCategoria() as $categoria): ?>
                
                    <option value="<?= $categoria->getId() ?>"
                        <?= ((int)$categoria->getId() == (int)$model->getIdCategoria()) ? 'selected' : '' ?>>
                        <?= $categoria->getDescricao() ?>
                    </option>
                
                <?php endforeach?>
            </select>
        </div>

        <p>Autores</p>

        <div class="mb-3">
            <?php foreach($model->getRowsAutores() as $autor): ?>
                <label>
                    <input type="checkbox" value="<?= $autor->getId()?>" name="autor[]" <?= in_array($autor->getId(), $model->getIdAutores()) ? 'checked' : '' ?>>
                    <?=$autor->getNome()?> 
                </label> <br/>
            <?php endforeach?>
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>

    </form>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>