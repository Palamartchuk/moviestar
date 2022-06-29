<?php 


require_once "templates/header.php";

require_once "templates/header.php";
require_once "models/User.php";
require_once "dao/MovieDao.php";
require_once "dao/ReviewDao.php";

//Pega id do filme
$id = filter_input(INPUT_GET, "id");

$movie;

$movieDao = new MovieDao($conn, $BASE_URL);

$reviewDao = new ReviewDao($conn, $BASE_URL);

if(empty($id)) {

    $mensagem->defineMessage("Filme não encontrado", "error", "index.php");
    /* var_dump($id); */

} else {


    $movie = $movieDao->findById($id);

    //Verifica se o filme existe 

    if(!$movie) {

        /* var_dump($id); */
        $mensagem->defineMessage("Filme não encontrado", "error", "index.php");
    }
}

// Verifica se o filme tem imagem

if($movie->image == "") {
    $movie->image = "movie_cover.jpg";
}


//Verifica se o filme é do usuario
$usersOwnsMovie = false;

if(!empty($userData)){

    if($userData->id === $movie->users_id) {

        $usersOwnsMovie = true;

    
    }

    // Resgatar reviews do filme
    $alreadyReviwed = $reviewDao->hasAlreadyReviewed($id, $userData->id);


}

// Regastar as reviews

$moviesReviews = $reviewDao->getMoviesReview($id);



?>

<div id="main-container" class="container-fluid">
    <div class="row">
        <div class="offset-md-1 col-md-6 movie-container">
            <h1 class="page-title">
                <?= $movie->title ?>
            </h1>
            <p class="movie-details">
                <span>Duração: <?= $movie->length ?></span>
                <span class="pipe"></span>
                <span> <?= $movie->category ?></span>
                <span class="pipe"></span>
                <span><i class="fas fa-star"></i> <?= $movie->rating?></span>
            </p>
            <iframe src="<?= $movie->trailer ?>" width="560px" height="315px" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <p><?= $movie->description ?></p>
        </div>
        <div class="col-md-4">
            <div class="movie-image-container" style="background-image: url('<?= $BASE_URL ?>/img/movies/<?= $movie->image ?>') ;">

            </div>
        </div>
        <div class="offset-md-1 col-md-10" id="reviews-container">
            <h3 class="reviews-title">
                Avaliações: 
            </h3>
            <!-- Verifica a se habilita a avaliação pro usuário ou não -->
            <?php if (!empty($userData) && !$usersOwnsMovie && !$alreadyReviwed): ?>
            <div class="col-md-12" id="review-form-container">
                <h4>Envie sua avaliação:</h4>
                <p class="page-description">Preencha o formulário com a nota e comentário sobre o filme</p>
                <form action="<?= $BASE_URL ?>review_process.php" id="review-form" method="POST">
                    <input type="hidden" name="type" value="create">
                    <input type="hidden" name="movies_id" value="<?= $movie->id?>">
                    <div class="form-group">
                        <label for="rating">Nota do Filme:</label>
                        <select name="rating" id="rating" class="form-control">
                            <option value="">Selecione:</option>
                            <option value="10">10</option>
                            <option value="9">9</option>
                            <option value="8">8</option>
                            <option value="7">7</option>
                            <option value="6">6</option>
                            <option value="5">5</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                            <option value="0">0</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="review">Seu comentário:</label>
                        <textarea class="form-control" id="review" name="review" rows="3" placeholder="O que você achou do filme?"></textarea>
                    </div>
                    <input type="submit" class="btn card-btn" value="Enviar comentário">
                </form>
            </div>
            <?php endif; ?>
            <!-- Comentarios -->
            <?php foreach($moviesReviews as $valuesReview): ?>
                <?php require "templates/user_review.php"; ?>
            <?php endforeach ;?>
            <?php if(count($moviesReviews) == 0) : ?>
                <p class="empty-list">Não existe comentário</p>
            <?php endif; ?>
        </div>
    </div>
</div>




<?php

    require_once "templates/footer.php"; 

?>
