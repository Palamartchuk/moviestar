<?php 


    if(empty($values->image)) {
        $values->image = "movie_cover.jpg";
    }
?>



<div class="card movie-card">
    <div class="card-img-top" style="background-image: url('<?= $BASE_URL ?>img/movies/<?= $values->image?>') ;"></div>
    <div class="card-body">
        <p class="card-rating">
            <i class="fas fa-star"></i>
            <span class="rating">9</span>
        </p>
        <h5 class="card-title">
            <a href="<?= $BASE_URL ?>movie.php?id=<?= $values->id?>"><?= $values->title?></a>
        </h5>
        <a href="<?= $BASE_URL ?>movie.php?id=<?= $values->id?>" class="btn btn-primary rate-btn">Avaliar</a>
        <a href="<?= $BASE_URL ?>movie.php?id=<?= $values->id?>" class="btn btn-primary card-btn">Conhecer</a>
    </div>
</div>