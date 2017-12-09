<?php include('views/partials/header.base.view.php') ?>
<div class="login-box">
    <h3>Sign in</h3>
    <form method="POST" action="/loginPost">
        <label for="email">E-mail Address</label><BR />
        <input type="text" name="email" class="input" /><BR />
        <label for="password">Password</label><BR />
        <input type="password" name="password" class="input" /><BR />
        <button type="submit" class="submit">Login</button>
    </form>

    <?php if(isset($_COOKIE['login_error'])): ?>
        <?php echo $_COOKIE['login_error']; ?>
        <?php setcookie("login_error", "", time()-3600); ?>
    <?php endif; ?>
</div>