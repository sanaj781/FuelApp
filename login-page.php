<div class="row py-5 align-items-center" id="login-form">
    <form class="form-signin" method="post" action="<?php user_authentification(); ?>">
        <h1 class="h3 mb-3 font-weight-normal text-center">Załoguj się</h1>
        <label for="username" class="sr-only">Login</label>
        <input type="text" name="username" class="form-control" placeholder="Login" required autofocus>
        <label for="password" class="sr-only">Hasło</label>
        <input type="password" name="password" class="form-control" placeholder="Hasło" required>
        <button class="btn btn-lg btn-primary btn-block col-12 mt-3" type="submit">Załoguj się</button>
    </form>
</div>