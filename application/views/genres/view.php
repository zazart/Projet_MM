<h2><?php echo $title; ?></h2>

<div>
    <p><?php echo $genre['description']; ?></p>
</div>

<p><a href="<?php echo site_url('genres/edit/'.$genre['id']); ?>">Edit Genre</a></p>
<p><a href="<?php echo site_url('genres/delete/'.$genre['id']); ?>">Delete Genre</a></p>
