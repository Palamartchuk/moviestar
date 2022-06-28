<?php 

    require_once "templates/header.php";
    require_once "models/User.php";
    require_once "dao/UserDao.php";
    
    //Verifica se o user ta logado via os dados dele evitando que usuarios logando não entrem
    $user = new User();


    $userDao = new UserDAO($conn, $BASE_URL);

    $userData = $userDao -> verifyToken(true);

    //Debuga se o user ta logado via os dados dele evitando que usuarios logando não entrem

    /* var_dump($userData); exit; */


    
    
?>


    <div id="main-container" class="container-fluid">
        <div class="offset-md-4 col-md-4 new-movie-container">
            <h1 class="page-title">Adicionar Filme</h1>
            <p class="page-description">
                Inclua a sua crítica do filme desejado.
            </p>
            <form action="<?= $BASE_URL ?>movie_process.php" class="add-movie-form" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="type" value="create">
                <div class="form-group">
                    <label for="title">Titulo:</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Digite o nome do filme">
                </div>
                <div class="form-group">
                    <label for="image">Imagem(Cover):</label>
                    <input type="file" name="image" id="id" class="form-control-file">
                </div>
                <div class="form-group">
                    <label for="length">Duração:</label>
                    <input type="text" class="form-control" id="length" name="length" placeholder="Digite a duração do filme">
                </div>
                <div class="form-group">
                    <label for="category">Categoria:</label>
                    <select name="category" id="category" class="form-control">
                        <option value="">Selecione</option>
                        <option value="Ação">Ação</option>
                        <option value="Scifi">Sci-Fi</option>
                        <option value="Drama">Drama</option>
                        <option value="Anime">Anime</option>
                        <option value="Comédia">Comédia</option>
                        <option value="Romance">Romance</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="trailer">Trailer:</label>
                    <input type="text" class="form-control" id="trailer" name="trailer" placeholder="Insira o link do trailer">
                </div>
                <div class="form-group">
                    <label for="description">Descrição:</label>
                    <textarea class="form-control" name="description" id="description" rows="5" placeholder="Descreve o filme...">

                    </textarea>
                </div>
                <input class="btn card-btn" type="submit" value="Adicionar">
            </form>
        </div>
    </div>


<?php

    require_once "templates/footer.php"; 

?>

