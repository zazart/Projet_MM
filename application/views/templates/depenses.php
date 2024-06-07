<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>">
    <!-- BOOTSTRAP STYLE -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap/bootstrap.min.css') ?>">
    <title>Depenses</title>
</head>
<body>
    <div class="container">
        <?php
            $this->load->view($contents);
        ?>
    </div>
</body>
</html>