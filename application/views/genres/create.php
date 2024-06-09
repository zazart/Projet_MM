<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Créer un Genre</title>
</head>
<body>
    <h1>Créer un Nouveau Genre</h1>

    <?php echo validation_errors(); ?>

    <?php echo form_open('genres/create'); ?>

    <label for="description">Description</label>
    <input type="text" name="description" /><br />

    <input type="submit" name="submit" value="Créer le Genre" />

    </form>
</body>
</html>
