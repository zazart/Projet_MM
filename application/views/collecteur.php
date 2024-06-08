<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php echo form_open('saveCollecteur', array('method' => 'post')); ?>
        <input class="form-control" type="text" name="nom" placeholder="Rakoto " /><br>
        <?php echo form_error('nom', '<div class="text-danger">', '</div>'); ?>
        <input class="form-control" type="text" name="contact" placeholder="034*******" /><br>
        <?php echo form_error('contact', '<div class="text-danger">', '</div>'); ?>
        <input class="form-control" type="text" name="adresse" placeholder="Adresse " /><br>
        <?php echo form_error('adresse', '<div class="text-danger">', '</div>'); ?>
        <input class="form-control" type="date" name="date" value="<?= date(('Y-m-d'));?>" /><br>
        <?php echo form_error('date', '<div class="text-danger">', '</div>'); ?>
        <select name="genre" id="">
            <option value="">Genre</option>
            <option value="1">Femme</option>
            <option value="2">Homme</option>
        </select><br>
        <?php echo form_error('genre', '<div class="text-danger">', '</div>'); ?>
        <button type="submit" class="btn btn-primary">Save</button>
    <?php echo form_close(); ?>
</body>
</html>