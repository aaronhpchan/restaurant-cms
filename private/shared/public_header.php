<?php $page_id = $page_id ?? ''; // set default value to prevent error on index page ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo url_for('/styles/public.css'); ?>" media="all">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo url_for('/images/apple-touch-icon.png'); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo url_for('/images/favicon-32x32.png'); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo url_for('/images/favicon-16x16.png'); ?>">
    <link rel="manifest" href="<?php echo url_for('/images/site.webmanifest'); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title><?php echo $page_id != '' ? $page['menu_name'] . ' | ' : 'Home' . ' | '; ?>Humphrey's Doughnuts</title>
</head>

<body>
    <?php if($page_id == '' || $page['menu_name'] != 'Order') { ?>
    <div> 
        <div class="container-md d-flex align-items-center justify-content-sm-center py-3">
            <a href="<?php echo url_for('index.php'); ?>" class="text-reset text-decoration-none">
                <img src="<?php echo url_for('/images/apple-touch-icon.png'); ?>" class="d-inline-block align-top logo"alt="Logo" />
                <span class="d-none d-sm-inline brand">Humphrey's Doughnuts</span>
                <span class="d-inline-block d-sm-none brand-small">Humphrey's<br>Doughnuts</span>
            </a>
        </div>
    </div>
    <?php } else { ?>
    <div>
        <div class="container-md d-flex align-items-center justify-content-between py-3">
            <a href="<?php echo url_for('index.php'); ?>" class="text-reset text-decoration-none d-flex align-items-center">
                <img src="<?php echo url_for('/images/apple-touch-icon.png'); ?>" class="d-inline-block align-top me-2 logo"alt="Logo" />
                <span class="d-inline-block brand-small">Humphrey's<br />Doughnuts</span>
            </a>
            <div class="d-flex align-items-center text-decoration-none cart-div">
                <i class="fas fa-shopping-cart fa-2x"></i>
                <div class="d-inline ms-1 cart-qty">0</div>
            </div>
        </div>
    </div>
    <?php } ?>

    <?php include(SHARED_PATH . '/public_navigation.php'); ?>
    