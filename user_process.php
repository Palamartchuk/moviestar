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

    if($type === "update") {

        //Resgata dados do usuario
        $userData = $userDAO->verifyToken();

        //var dump para verificar dados do POST
        /* var_dump($_POST); exit; */

        //Var dump para verificar os dados do user
        /* var_dump($userData); exit; */

        $name = filter_input(INPUT_POST, "name");
        $lastname = filter_input(INPUT_POST, "lastname");
        $email = filter_input(INPUT_POST, "email");
        $bio = filter_input(INPUT_POST, "bio");

        //Criar novo objeto de usuário
        $user = new User();

        //Preencher os dados do usuario
        $userData->name = $name;
        $userData->lastname = $lastname;
        $userData->email = $email;
        $userData->bio = $bio;

        //Upload de imagem 
        if(isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {

            //Debuga imagem que vem no post
            /* var_dump($_FILES); exit; */

            $image = $_FILES["image"];
            $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
            $jpgArray = ["image/jpeg", "image/jpg"];

            // checagem de tipo de imagem

            if(in_array($image["type"], $imageTypes)) {

                

                if(in_array($image["type"], $jpgArray)) { //checa se é jpg/jpeg

                    $imageFile = imagecreatefromjpeg($image["tmp_name"]);

                } else { // se for png
                    $imageFile = imagecreatefrompng($image["tmp_name"]);
                }

                //nome random pra image
                $imageName = $user->imageGenerateName();

                //salva a imagem
                imagejpeg($imageFile, "./img/users/" . $imageName, 100);

                $userData -> image = $imageName;

            } else {
                $mensagem->defineMessage("Informações inválidas, favor inserir um arquivo válido", "error", "back");
            }

        }

        //manda update
        $userDAO->update($userData);



    } else if ($type === "changepassword") {


        $password = filter_input(INPUT_POST, "password");
        $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

        //Resgata dados do usuario
        $userData = $userDAO->verifyToken();
        $id = $userData->id;

        //var dump para verificar dados do POST
        /* var_dump($_POST); exit; */

        if($password === $confirmpassword) {

            $user = new User();

            $newPassoword = $user->generatePassword($password);

            $user->password = $newPassoword;
            $user->id = $id;

            $userDAO -> changePassword($user);
            

        } else {

            $mensagem->defineMessage("Senhas não batem, favor tentar novamente", "error", "back"); 

        }



    } else {
        $mensagem->defineMessage("Informações inválidas", "error", "index.php");
    }