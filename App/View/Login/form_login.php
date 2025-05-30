<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Biblioteca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  </head>
  <body>

    <form method="post" action="/login" class="p-5">

        <h1>Login</h1>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" value="<?= $model->getEmail() ?>" class="form-control" name="email" id="email">
        </div>

        <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" class="form-control" name="senha" id="senha">
        </div>

        <div class="mb-3">
            <input type="checkbox" name="lembrar" id="lembrar">
            <label for="lembrar" class="form-label">Lembrar meu usuário</label>
        </div>

        <?php if (!empty($erro)): ?> <!-- Exibe a mensagem de erro de forma segura, evitando XSS. -->
            <div class="erro"><?= htmlspecialchars($erro) ?></div>
        <?php endif; ?>

        <button type="submit" class="btn btn-success">Entrar</button>

    </form>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>