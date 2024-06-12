<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('genres/edit/'.$genre['id']); ?>

    <label for="description">Description</label>
    <input type="input" name="description" value="<?php echo $genre['description']; ?>" /><br />

    <input type="submit" name="submit" value="Update genre" />

</form>
