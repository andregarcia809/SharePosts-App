<?php require APPROOT . '/views/include/header.php'; ?>
<a href="<?php echo URLROOT?>/posts" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<h1><?php echo $data['post']->title; ?></h1>
<div class="bg-secondary text-white p-2 mb-3">
    Written by <?php echo $data['user']->name; ?> on <?php echo $data['user']->created_at; ?>
</div>
<p><?php echo $data['post']->body?></p>
<hr>
<?php if ($data['post']->user_id == $_SESSION['user_id']) :?>
<a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post']->id; ?>" class="btn btn-dark">Edit</a>
<form action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id?>" method="post" class="pull-right">
    <button type="submit" value="Delete" class="btn btn-danger">Delete</button>
</form>
<?php endif; ?>
<?php require APPROOT . '/views/include/footer.php'; ?>