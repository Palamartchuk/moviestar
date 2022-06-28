<?php 
    
    require_once "templates/header.php"; 
    require_once "dao/MovieDao.php";



    //Dao filmes
    $movieDao = new MovieDao($conn, $BASE_URL);

    $latestMovies = $movieDao->getLatestMovies();

    $animes = $movieDao->getMoviesByCategory("Anime");

    $actionMovies = $movieDao->getMoviesByCategory("Ação");

    $comedyMovies = $movieDao->getMoviesByCategory("Comédia");


    /*
        var_dump($userData);
        var_dump($userData->id);
        var_dump($userMovies);
    */

    /* var_dump($latestMovies); */

    /* var_dump($userData); */

?>


    <div id="main-container" class="container-fluid">
        <h2 class="section-title">Filmes novos</h2>
        <p class="section-description">
            Veja as críticas recém adicionadas
        </p>
        <div class="movies-container">
            <?php foreach ($latestMovies as $values): ?>
                <?php require("templates/movie_card.php") ?>
            <?php endforeach ; ?>
            <?php if(count($latestMovies) == 0): ?>
                <p class="empty-list">Ainda não há filmes cadastrados</p>
            <?php endif; ?>
        </div>

        <h2 class="section-title">Animes</h2>
        <p class="section-description">
            Veja as críticas de animes mais recentes
        </p>
        <div class="movies-container">
            <?php foreach ($animes as $values): ?>
                <?php require("templates/movie_card.php") ?>
            <?php endforeach ; ?>
            <?php if(count($animes) == 0): ?>
                <p class="empty-list">Ainda não há Animes cadastrados</p>
            <?php endif; ?>
        </div>

        <h2 class="section-title">Comédia</h2>
        <p class="section-description">
            Veja as críticas de comédia mais recentes
        </p>
        <div class="movies-container">
            <?php foreach ($comedyMovies as $values): ?>
                <?php require("templates/movie_card.php") ?>
            <?php endforeach ; ?>
            <?php if(count($comedyMovies) == 0): ?>
                <p class="empty-list">Ainda não há filmes de comédia cadastrados</p>
            <?php endif; ?>
        </div>
    </div>


<?php

    require_once "templates/footer.php"; 

?>

    