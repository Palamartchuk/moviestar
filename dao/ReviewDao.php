<?php 


    require_once "models/Review.php";
    require_once "models/Message.php";
    require_once "dao/UserDao.php";

    class ReviewDao implements ReviewInterface {

        private $conn;
        private $url;
        private $message;

        public function __construct(PDO $conn, $url)
        {
            $this->conn = $conn;
            $this->url = $url;
            $this->message = new Message($url);
        }

        public function buildReview($data) {

            $reviewObj = new Review();

            $reviewObj->id = $data["id"];
            $reviewObj->rating = $data["rating"];
            $reviewObj->review = $data["review"];
            $reviewObj->users_id = $data["users_id"];
            $reviewObj->movies_id = $data["movies_id"];

            return $reviewObj;

        }
        public function create(Review $review) {


            $stmt = $this->conn->prepare("INSERT INTO reviews (rating, review, movies_id, users_id) VALUES (:rating, :review, :movies_id, :users_id)");

            $stmt->bindParam(":rating", $review->rating);
            $stmt->bindParam(":review", $review->review);
            $stmt->bindParam(":movies_id", $review->movies_id);
            $stmt->bindParam(":users_id", $review->users_id);


            $stmt -> execute();
            //msg de sucesso add filme
            $this->message->defineMessage("Comentário adicionado com sucesso! ", "success", "index.php");


        }
        public function getMoviesReview($id) {

        }
        public function hasAlreadyReviewed($id, $userId) {

        }
        public function getRatings($id) {

        }


    }

?>