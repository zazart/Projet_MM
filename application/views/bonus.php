<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php echo form_open('saveBonus', array('method' => 'post')); ?>
        <input class="form-control" type="date" name="date" placeholder="Date " />
        <input class="form-control" type="numeric" name="amount" placeholder="3000" />
        <?php echo form_error('amount', '<div class="text-danger">', '</div>'); ?>
        <button type="submit" class="btn btn-primary">Save</button>
    <?php echo form_close(); ?>
</body>
</html>