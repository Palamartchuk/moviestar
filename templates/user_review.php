<?php
    require_once "models/User.php";

    $userModel = new User();

    $fullName = $userModel->getFullName($valuesReview->user);


    //Checar se o user tem imagem de perfil 
    if($valuesReview->user->image == "") {
        $valuesReview->user->image = "user.png";
    }
?>


<div class="col-md-12 review">
    <div class="row">
        <div class="col-md-1">
            <div class="profile-image-container review-image" style="background-image: url('<?= $BASE_URL ?>img/users/<?=$valuesReview->user->image?>')"></div>
        </div>
        <div class="col-md-9 author-details-container">
            <h4 class="author-name">
                <a href="<?=$BASE_URL?>profile.php?id=<?=$valuesReview->user->id ?>"><?= $fullName ?></a>
            </h4>
            <p>
                <i class="fas fa-star"></i> <?= $valuesReview->rating?>
            </p>
        </div>
    </div>
    <div class="col-md-12">
        <p class="comment-title">Comentário:</p>
        <p><?= $valuesReview->review?></p>
    </div>
</div>