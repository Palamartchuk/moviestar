<?php 

require_once "templates/header.php";
require_once "models/User.php";
require_once "dao/UserDao.php";
require_once "dao/MovieDao.php";

//Verifica se o user ta logado via os dados dele evitando que usuarios logando não entrem
$user = new User();

$userDao = new UserDAO($conn, $BASE_URL);
$movieDao = new MovieDao($conn, $BASE_URL);

$userData = $userDao -> verifyToken(true);

$userMovies = $movieDao->getMoviesByUserId($userData->id);

//Debuga se o user ta logado via os dados dele evitando que usuarios logando não entrem

/* var_dump($userData);
var_dump($userMovies); */

?>

<div id="main-container" class="container-fluid">
    <h2 class="section-title">Dashboard</h2>
    <p class="section-description">
        Adicione ou atualize o seus filmes       
    </p>
    <div class="col-md-12" id="add-movie-container">
        <a href="<?= $BASE_URL ?>newmovie.php" class="btn card-btn">
        <i class="fas fa-plus"></i> Adicionar Filme
        </a>
    </div>
    <div class="col-md-12" id="movies-dashboard">
        <table class="table">
            <thead>
                <th scope="col">#</th>
                <th scope="col">Titulo</th>
                <th scope="col">Nota</th>
                <th scope="col" class="action-columns">Ações</th>
                <th scope="col"></th>
            </thead>
            <tbody>
                <?php foreach($userMovies as $userMoviesValues): ?>
                    <tr>
                        <td scope="row"><?= $userMoviesValues->id ?></td>
                        <td><a href="<?= $BASE_URL?>movie.php?id=<?= $userMoviesValues->id ?>" class="table-movie-title"><?= $userMoviesValues->title?></a></td>
                        <td><i class="fas fa-star"></i> 9</td>
                        <td class="actions-column">
                            <a href="<?= $BASE_URL?>editmovie.php?id=<?= $userMoviesValues->id ?>" class="edit-btn">
                                <i class="far fa-edit"></i>Editar
                            </a>
                            <form action="<?= $BASE_URL?>movie_process.php" method="POST">
                                <input type="hidden" value="delete" name="type">
                                <input type="hidden" value="<?= $userMoviesValues->id ?>" name="id">
                                <button type="submit" class="delete-btn">
                                    <i class="fas fa-times"></i> Deletar
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>









<?php

    require_once "templates/footer.php"; 

?>

    
