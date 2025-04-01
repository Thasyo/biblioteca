<?php 
    // Serão incluídas as configurações da aplicação.

    // 1°: O caminho diretório base.
    define('BASE_DIR', dirname(__FILE__, 2)); // Definindo uma constante um caminho.

        // dirname(): mostra o caminho até a pasta atual.
        // __FILE__: mostra o caminho até o arquivo atual.
        // 2: Indica o diretório pai, valor padrão é 1. Cada número acima, funciona como um cd ..

    // 2°: O caminho onde estão as views.
    define('VIEWS', BASE_DIR . '/View');

    // 3°: Configuração do Banco de Dados.
    $_ENV['db']['host'] = 'localhost:3306';
    $_ENV['db']['user'] = 'root';
    $_ENV['db']['pass'] = 'Tp13579';
    $_ENV['db']['database'] = 'biblioteca';

        /* Usar $_ENV ajuda a organizar melhor o código, aumenta a segurança ao evitar que informações sensíveis fiquem hardcoded e facilita a configuração e portabilidade entre diferentes ambientes de desenvolvimento e produção. */

?>