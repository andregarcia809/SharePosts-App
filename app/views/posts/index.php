<?php require APPROOT . '/views/include/header.php'; ?>
<?php flash('post_message'); ?>
<div class="row ">
    <div class="col-md-6">
        <h1>Post</h1>
    </div>
    <div class="col-md-6 mb-3">
        <a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary pull-right">
            <i class="fa fa-pencil" aria-hidden="true"></i> Add Post
        </a>
    </div>
</div>
<?php foreach($data['posts'] as $posts) : ?>
<div class="card card-body mb-3">
    <h4 class="card-title"><?php echo $posts->title; ?></h4>
    <div class="bg-light p-2 mb-3">
        Written by <?php echo $posts->name; ?> on <?php echo $posts->postCreated; ?>
    </div>
    <p class="card-text"><?php echo $posts->body; ?></p>
    <a href="<?php echo URLROOT; ?>/posts/show/<?php echo $posts->postId; ?>" class="btn btn-dark">More</a>
</div>
<?php endforeach; ?>
<?php require APPROOT . '/views/include/footer.php'; ?>