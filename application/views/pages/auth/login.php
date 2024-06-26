
<?php echo validation_errors(); ?>

<?php echo isset($error) ? $error : ''; ?>

<?php echo form_open('login/auth/login'); ?>
    <label for="email">Email</label>
    <input type="email" name="email" /><br />

    <label for="password">Password</label>
    <input type="password" name="password" /><br />

    <input type="submit" name="submit" value="Login" />
</form>
