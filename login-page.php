<div class="row py-5 align-items-center" id="login-form">
    <form class="form-signin" method="post" action="<?php user_authentification(); ?>">
        <h1 class="h3 mb-3 font-weight-normal text-center">Logowanie</h1>
        <label for="username" class="sr-only">Username</label>
        <input type="text" name="username" class="form-control" placeholder="Login" required autofocus value="DSH">
        <label for="password" class="sr-only">Hasło</label>
        <input type="password" name="password" class="form-control" placeholder="Hasło" value="12345" required>
        <div class="col-12 text-center text-danger">
            <?php
            if (!empty($_GET['error']))
                print_r($_GET['error']) ?></div>
        <button class="btn btn-lg btn-primary btn-block col-12 mt-3" name="submit-login" type="submit">Zaloguj się</button>
    </form>