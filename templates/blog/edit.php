<?php template('header'); ?>

<main role="main">

    <section class="jumbotron">
        <div class="container">
            <form class="form-signin" action="<?=$action?>" method="post">

            <label for="title" class="sr-only">Title</label>
            <input type="text" id="title" class="form-control" placeholder="Title" required autofocus name="title" value="<?=$post['title']?>">
            <br>

             <label for="picture_url" class="sr-only">Picture Url</label>
             <input type="text" id="picture_url" class="form-control" placeholder="Picture Url" required autofocus name="picture_url" value="<?=$post['picture_url']?>">
             <br>

            <textarea id="" cols="30" rows="10" name="content" class="form-control" ><?=$post['content']?></textarea>
            <br>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Update</button>
            </form>
    </section>
</main>



<?php template('footer'); ?>
