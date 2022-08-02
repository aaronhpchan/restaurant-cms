<?php if(!isset($page_title)) { $page_title = 'Staff'; } ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo url_for('/styles/staff.css'); ?>" media="all">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo url_for('/images/apple-touch-icon.png'); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo url_for('/images/favicon-32x32.png'); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo url_for('/images/favicon-16x16.png'); ?>">
    <link rel="manifest" href="<?php echo url_for('/images/site.webmanifest'); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title><?php echo $page_title; ?> | Restaurant CMS</title>
</head>
<body class="d-flex flex-column min-vh-100">
    <header class="header w-100 py-2">
        <h1 class="text-center"><a href="<?php echo url_for('/staff/index.php'); ?>" class="text-decoration-none text-black">Restaurant CMS</a></h1>
    </header>
    <nav class="overflow-auto">
        <ul class="sub-header d-flex justify-content-center w-100 py-2 border-bottom border-1 list-unstyled text-uppercase">
            <li class="d-inline mx-1 mx-sm-2"><a href="<?php echo url_for('/staff/pages/index.php') ?>">Pages</a></li>
            <li class="d-inline mx-1 mx-sm-2"><a href="<?php echo url_for('/staff/subjects/index.php') ?>">Subjects</a></li>
            <li class="d-inline mx-1 mx-sm-2"><a href="<?php echo url_for('/staff/products/index.php') ?>">Products</a></li>
            <li class="d-inline mx-1 mx-sm-2"><a href="<?php echo is_logged_in() ? url_for('/staff/logout.php') : url_for('/staff/login.php'); ?>"><?php echo is_logged_in() ? 'Logout' : 'Login'; ?></a></li>
        </ul>
    </nav>
    <?php echo display_session_messages(); ?>
    