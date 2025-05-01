<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Biblioteca - Listagem de Autores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  </head>
  <body>
    <div>
        <?php include VIEWS . '/Includes/menu.php'?>
    </div>

    <button class="btn btn-success m-3"><a href="/autor/cadastro" style="all: unset; cursor: pointer;">Novo Autor</a></button>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">NOME</th>
                <th scope="col">DATA DE NASCIMENTO</th>
                <th scope="col">CPF</th>
            </tr>
        </thead>
        <tbody>
        <?php
            if (empty($lista)) {
                echo "<tr><td colspan='5'>Nenhum autor encontrado.</td></tr>";
            } else {
                foreach($lista as $autor):
            ?>
                <tr>
                    <td class="d-flex gap-2">
                        <a href="/autor/cadastro?id=<?= $autor->getId() ?>" class="btn btn-primary">Detalhes</a>
                        <a href="/autor/deletar?id=<?= $autor->getId() ?>" class="btn btn-danger">Remover</a>
                    </td>
                    <td><?= $autor->getId() ?></td>
                    <td><?= $autor->getNome() ?></td>
                    <td><?= $autor->getDataNascimento() ?></td>
                    <td><?= $autor->getCPF() ?></td>
                </tr>
            <?php
                endforeach;
            }
            ?>
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>