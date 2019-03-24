<?php template('header'); ?>

<main role="main">

    <section class="jumbotron">
        <div class="container">
                <a href="/blog/create" class="btn btn-primary my-2">Create</a>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <?php foreach ($posts as $post) : ?>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <p class="card-text"><?=$post['title']?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                </div>
                                <small class="text-muted">
                                    <a href="/blog/view/<?=$post['id']?>" class="btn btn-success">View</a>
                                    <?php if (user()['id'] == $post['user_id']) : ?>
                                    <a href="/blog/edit/<?=$post['id']?>" class="btn btn-danger">Edit</a>
                                    <a href="/blog/delete/<?=$post['id']?>" class="btn btn-danger">Delete</a>
                                    <?php endif; ?>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>



<?php template('footer'); ?>
