<?php

require_once "globals.php";
require_once "db.php"; 
require_once "models/User.php";
require_once "dao/UserDao.php";
require_once "models/Message.php";

$mensagem = new Message($BASE_URL);
$userDAO = new UserDAO($conn, $BASE_URL);

//Resgata o tipo do usuário
$type = filter_input(INPUT_POST, "type");

/* var_dump($type); */




//Verificação do tipo do formulario
if($type === "register") {

    //Dados que vem do POST
    
    $name = filter_input(INPUT_POST, "name");
    $lastname = filter_input(INPUT_POST, "lastname");
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");
    $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

    //Verificar dados minimos para register
    if($name && $lastname && $email && $password) {

        //Se senhas batem:
        if($password === $confirmpassword) {

            //Verificar se o email já está cadastrado no sistema

            if($userDAO->findByEmail($email) === false) {

                $user = new User();

                //Criação do token e Senha
                $userToken = $user->generateToken();

                $senhaFinal = $user->generatePassword($password);

                //Montando o obejto User
                $user->name = $name;
                $user->lastname = $lastname;
                $user->email = $email;
                $user->password = $senhaFinal;
                $user->token = $userToken;

                $auth = true;
                
                $userDAO -> create($user, $auth);


            } else {
                //Envia mensagem se o usuário ja existe
                $mensagem -> defineMessage("Email já cadastrado no sistema", "error", "back");
            }


        } else {
            //Msg de erro, senhas não batem.
            $mensagem -> defineMessage("Senhas não batem !", "error", "back");

        }



    } else {

        //Mensagem de erro, caso não bata os dados minimos de register
        $mensagem -> defineMessage("Por favor, preencha todos os campos", "error", "back");
        

    }

} else if ($type === "login") {

    
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");

    // Tentar autentica user 

    if($userDAO -> authenticateUser($email, $password)) {


        $mensagem->defineMessage("Seja Bem-Vindo ! ", "success", "editprofile.php");
        


    }else { // Redireciona o user, caso não consiga autenticar

        $mensagem->defineMessage("Usuário ou senha / incorretos! ", "error", "back");
      
    }

} else {
    $mensagem->defineMessage("Informações inválidas", "error", "index.php");
}
