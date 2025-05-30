<?php 
namespace App\Controller;

use App\Model\Login;

final class LoginController extends Controller{

    public static function index(): void {

        $erro = ''; // declarado aqui para estar acessível na página de formulário de Login.
        $model = new Login();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $model->setEmail(trim($_POST['email']));
            $model->setSenha(trim($_POST['senha']));
            $login = $model->logar();

            if($login){
                $_SESSION['usuario_logado'] = $login; // cria uma sessão para o usuário logado a fim de aplicar proteção a outras rotas.
                
                if(isset($_POST['lembrar'])){
                    setcookie(
                        name: "sistema_biblioteca_usuario",
                        value: $login->getEmail(),
                        expires_or_options: time()+60*60*24*30 // Deixa armazenado os cookies dos dados do usuário pelo período de um mês.
                    );
                }

                header("Location: /");
                exit; // para o script após o redirecionamento.
            }else{
                $erro = "Email ou senha incorretos!";
            }
            
        }

        if(isset($_COOKIE['sistema_biblioteca_usuario'])){
            $model->setEmail($_COOKIE['sistema_biblioteca_usuario']);
        }
        
        include VIEWS . '/Login/form_login.php';

       
    }

    public static function logout(): void {
        session_destroy();
        header("Location: /login");
        exit;
    }

}
?>