<?php template('header'); ?>

<main role="main">

    <form class="form-signin" action="<?=$action?>" method="post">
        <h1 class="h3 mb-3 font-weight-normal">Please Register</h1>
        <?php if (isset($errors)) : ?>
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li style="color: red"><?=$error?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus name="email">

        <label for="inputEmail" class="sr-only">Name</label>
        <input type="name" id="inputName" class="form-control" placeholder="Name" required name="name">

        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="password">

        <label for="inputPassword2" class="sr-only">Password Confirmation</label>
        <input type="password" id="inputPassword2" class="form-control" placeholder="Password" name="password_confirmation" required>

        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>
</main>

<style>
    .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: auto;
    }
    .form-signin .checkbox {
        font-weight: 400;
    }
    .form-signin .form-control {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
    }
    .form-signin .form-control:focus {
        z-index: 2;
    }
    .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }
    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
</style>


<?php template('footer'); ?>
