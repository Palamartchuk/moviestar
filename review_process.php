<?php 


require_once("globals.php");
require_once("db.php");
require_once("models/Movie.php");
require_once("models/Message.php");
require_once("models/Review.php");
require_once("dao/UserDao.php");
require_once("dao/MovieDao.php");
require_once("dao/ReviewDao.php");

$message = new Message($BASE_URL);
$userDao = new UserDao($conn, $BASE_URL);
$movieDao = new MovieDao($conn, $BASE_URL);
$reviewDao = new ReviewDao($conn, $BASE_URL);

// Resgata o tipo do formulário
$type = filter_input(INPUT_POST, "type");

// Resgata dados do usuário
$userData = $userDao->verifyToken();


// recebe o tipo do formulário
if($type === "create") {

    //Recebendo dados do POST
    $rating = filter_input(INPUT_POST, "rating");
    $review = filter_input(INPUT_POST, "review");
    $movies_id = filter_input(INPUT_POST, "movies_id");
    $users_id = $userData->id;

    $reviewObj = new Review();

    $movieData = $movieDao->findById($movies_id);

    if($movieData) {

        //Dados minimos
        if(!empty($rating) && !empty($review) && !empty($movies_id)) {

            $reviewObj->rating = $rating;
            $reviewObj->review = $review;
            $reviewObj->movies_id = $movies_id;
            $reviewObj->users_id = $users_id;

            $reviewDao->create($reviewObj);

        } else {

            $message->defineMessage("Você precisa inserir a nota e o comentário!", "error", "back");
        }

    } else {

        $message->defineMessage("Informações inválidas!", "error", "index.php");
    }
    
    


} else {

    $message->defineMessage("Informações inválidas!", "error", "index.php");
}


?>