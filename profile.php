<?php 

    require_once "templates/header.php";
    require_once "models/User.php";
    require_once "dao/UserDao.php";
    require_once "dao/MovieDao.php";

    $user = new User();
    $userDao = new UserDAO($conn, $BASE_URL);
    $movieDao = new MovieDao($conn, $BASE_URL);

    //Receber id do usuario
    $id = filter_input(INPUT_GET, "id");
    /* var_dump($userData); */

    if(empty($id)) {

        if(!empty($userData)) {

            $id = $userData->id;

        } else {

            $mensagem->defineMessage("Usuário não encontrado", "error", "index.php");
        }

    } else {

        //Encontrou o id do usuário
        $userData = $userDao->findById($id);

        //Se não encontrou 
        if(!$userData) {
            $mensagem->defineMessage("Usuário não encontrado", "error", "index.php");
        }

        
    }


    $fullName = $user->getFullName($userData);

    if($userData->image == ""){
        $userData->image = "user.png";
    }

    // Filmes que ele adicionou

    $userMovies = $movieDao->getMoviesByUserId($id);


    /* var_dump($userMovies); */



?>



<div id="main-container" class="container-fluid">
    <div class="col-md-8 offset-md-2">
        <div class="row profile-container">
            <div class="col-md-12 about-container">
                <h1 class="page-title"><?=$fullName?></h1>
                <div id="profile-image-container" class="profile-image" style="background-image: url('<?= $BASE_URL ?>img/users/<?= $userData->image ?>')"></div>
                <h3 class="about-title">Sobre:</h3>
                <?php if (!empty($userData->bio)): ?>
                    <p class="profile-description"><?=$userData->bio?></p>
                <?php else: ?>
                    <p class="profile-description">Usuário não possui bio</p>
                <?php endif; ?> 
            </div>
            <div class="col-md-12 added-movies-container">
                <h3>Filmes adiconados pelo usuário:</h3>
                <div class="movies-container">
                    <?php foreach($userMovies as $values): ?>
                        <?php require("templates/movie_card.php"); ?>
                    <?php endforeach; ?>
                    <?php if(count($userMovies) === 0): ?>
                        <p class="empty-list">Usuário ainda não enviou filmes</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>







<?php

    require_once "templates/footer.php"; 

?>