<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Biblioteca - Listagem de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  </head>
  <body>
    <div>
        <?php include VIEWS . '/Includes/menu.php'?>
    </div>

    <button class="btn btn-success m-3"><a href="/usuario/cadastro" style="all: unset; cursor: pointer;">Novo Usuario</a></button>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">NOME</th>
                <th scope="col">EMAIL</th>
                <th scope="col">SENHA</th>
            </tr>
        </thead>
        <tbody>
        <?php
            if (empty($lista)) {
                echo "<tr><td colspan='5'>Nenhum usuario encontrado.</td></tr>";
            } else {
                foreach($lista as $usuario):
            ?>
                <tr>
                    <td class="d-flex gap-2">
                        <a href="/usuario/cadastro?id=<?= $usuario->getId() ?>" class="btn btn-primary">Detalhes</a>
                        <a href="/usuario/deletar?id=<?= $usuario->getId() ?>" class="btn btn-danger">Remover</a>
                    </td>
                    <td><?= $usuario->getId() ?></td>
                    <td><?= $usuario->getNome() ?></td>
                    <td><?= $usuario->getEmail() ?></td>
                    <td><?= $usuario->getSenha() ?></td>
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