<?php require_once('../private/initialize.php'); ?>

<?php 

$preview = false;
if(isset($_GET['preview'])) {
    $preview = $_GET['preview'] == 'true' && is_logged_in() ? true : false;
}
$visible = !$preview;

if(isset($_GET['id'])) {
    $page_id = $_GET['id'];
    $page = find_page_by_id($page_id, ['visible' => $visible]);
    if(!$page) {
        redirect_to(url_for('/index.php'));
    }
}

?>

<?php include(SHARED_PATH . '/public_header.php'); ?>
<?php include(SHARED_PATH . '/public_navigation.php'); ?>

<main class="pb-5">
    <?php 
        if(isset($page)) {
            // display page according to menu_name
            include(SHARED_PATH . '/page_' . h(u(strtolower($page['menu_name']))) . '.php');
        } else {
            // display home page
            include(SHARED_PATH . '/static_homepage.php'); 
        }       
    ?>
</main>

<?php include(SHARED_PATH . '/public_footer.php'); ?>