<?php 
    require_once "globals.php";
    require_once "db.php"; 
    require_once "templates/header.php"; 

    /* var_dump($boxs_de_msgs); */
    
    
?>


    <div id="main-container" class="container-fluid">
        <div class="col-md-12">
            <div class="row" id="auth-row">
                <div class="col-md-4" id="login-container">
                    <h2>Entrar</h2>
                    <form action="<?= $BASE_URL ?>auth_process.php" method="POST">
                        <input type="hidden" name="type" value="login">
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="E-mail"> 
                        </div>
                        <div class="form-group">
                            <label for="password">Senha</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Senha"> 
                        </div> 
                        <input type="submit" class="btn card-btn" value="Entrar">
                    </form>
                </div>
                <div class="col-md-4" id="register-container">
                    <h2>Registrar-se</h2>
                    <form action="<?= $BASE_URL ?>auth_process.php" method="POST">
                        <input type="hidden" name="type" value="register">
                        <div class="form-group">
                            <label for="email">Nome:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nome"> 
                        </div>
                        <div class="form-group">
                            <label for="email">Sobrenome:</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Sobrenome"> 
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail:</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="E-mail"> 
                        </div>
                        <div class="form-group">
                            <label for="password">Senha:</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Senha"> 
                        </div>
                        <div class="form-group">
                            <label for="confirmpassword">Cofirme sua senha:</label>
                            <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirme a senha"> 
                        </div> 
                        <input type="submit" class="btn card-btn" value="Registrar">
                    </form>
                </div>
            </div>
        </div>
    </div>


<?php

    require_once "templates/footer.php"; 

?>

    