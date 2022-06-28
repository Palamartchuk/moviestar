<?php 

    require_once "templates/header.php";
    require_once "models/User.php";
    require_once "dao/UserDao.php";
    require_once "dao/MovieDao.php";
    
    //Verifica se o user ta logado via os dados dele evitando que usuarios logando não entrem
    $user = new User();


    $userDao = new UserDAO($conn, $BASE_URL);

    $userData = $userDao -> verifyToken(true);

    $movieDao = new MovieDao($conn, $BASE_URL);

    //Debuga se o user ta logado via os dados dele evitando que usuarios logando não entrem

    /* var_dump($userData); exit; */

    $id = filter_input(INPUT_GET, "id");

    if(empty($id)) {

        $mensagem->defineMessage("Filme não encontrado", "error", "index.php");

       
        
    
    } else {
    
        
        $movie = $movieDao->findById($id);
       
    
        if(!$movie) {
    

            $mensagem->defineMessage("Filme não encontrado", "error", "index.php");
            
            
        }
    }
    
    //Verifica se o filme te cover image
    if($movie->image == "") {
        $movie->image = "movie_cover.jpg";
    }
    

?>


<div id="main-container" class="container-fluid">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6 offset-md-1">
                <h1><?= $movie->title ?></h1>
                <p class="page-description">
                    Altere os dados do filme pelo formulário abaixo:
                </p>
                <form id="edit-movie-form" action="<?= $BASE_URL ?>movie_process.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="type" value="update">
                    <input type="hidden" name="id" value="<?=$movie->id?>">
                    <div class="form-group">
                        <label for="title">Titulo:</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Digite o nome do filme" value="<?= $movie->title ?>">
                    </div>
                    <div class="form-group">
                        <label for="image">Imagem(Cover):</label>
                        <input type="file" name="image" id="id" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <label for="length">Duração:</label>
                        <input type="text" class="form-control" id="length" name="length" placeholder="Digite a duração do filme" value="<?= $movie->length ?>">
                    </div>
                    <div class="form-group">
                        <label for="category">Categoria:</label>
                        <select name="category" id="category" class="form-control">
                            <option value="">Selecione</option>
                            <option value="Ação"<?= $movie->category === "Ação" ? "selected" : "" ?>>Ação</option>
                            <option value="Sci-fi"<?= $movie->category === "Sci-fi" ? "selected" : "" ?>>Sci-Fi</option>
                            <option value="Drama"<?= $movie->category === "Drama" ? "selected" : "" ?>>Drama</option>
                            <option value="Anime" <?= $movie->category === "Anime" ? "selected" : "" ?>>Anime</option>
                            <option value="Comédia"<?= $movie->category === "Comédia" ? "selected" : "" ?>>Comédia</option>
                            <option value="Romance"<?= $movie->category === "Romance" ? "selected" : "" ?>>Romance</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="trailer">Trailer:</label>
                        <input type="text" class="form-control" id="trailer" name="trailer" placeholder="Insira o link do trailer" value="<?= $movie->trailer ?>">
                    </div>
                    <div class="form-group">
                        <label for="description">Descrição:</label>
                        <textarea class="form-control" name="description" id="description" rows="5" placeholder="Descreve o filme...">
                            <?= $movie->description ?>
                        </textarea>
                    </div>
                    <input class="btn card-btn" type="submit" value="Editar filme">
                </form>
            </div>
            <div class="col-md-3">
               <div class="movie-image-container" style="background-image: url('<?= $BASE_URL ?>img/movies/<?= $movie->image?>') ;">

               </div>
            </div>
        </div>
    </div>
</div>



<?php

    require_once "templates/footer.php"; 

?>
