<?php template('header'); ?>

<main role="main">

    <section class="jumbotron">
        <div class="container">
            <h1 class="jumbotron-heading"><?=$post['title']?></h1>
            <p class="lead text-muted">
                <?= $post['content']; ?>
            </p>
            <p>
                <a href="/blog" class="btn btn-primary my-2">Back</a>
            </p></div>
    </section>
</main>



<?php template('footer'); ?>
