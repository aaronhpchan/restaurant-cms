<?php 

$id = $_GET['id'] ?? '1'; 

$subject_set = find_subjects_by_page($id);

?> 

<div class="container-md">
    <h1 class="page-title display-3 text-center py-5"><?php echo $page['menu_name']; ?></h1>

    <?php foreach($subject_set as $i => $value) { ?>
        <div class=" row align-items-center pt-4 pb-5 pb-lg-4">
            <div class="col-lg-6 <?php echo $i % 2 == 0 ? 'order-1 pe-lg-4' : 'order-1 order-lg-2 ps-lg-4'; ?>">
                <h2 class="text-center pb-4"><?php echo $value['menu_name']; ?></h2>
                <p class="about-p px-lg-4"><?php echo $value['content']; ?></p>
            </div>
            <div class="col-lg-6 <?php echo $i % 2 == 0 ? 'order-2 ps-lg-4' : 'order-2 order-lg-1 pe-lg-4'; ?>">
                <img class="img" src="<?php echo url_for('/images/' . $page['menu_name'] . $value['position'] . '.jpg'); ?>" alt="<?php echo $subject['menu_name']; ?>" />
            </div>
        </div>
    <?php } ?>

    <div class="pt-4">
        <p class="marker text-center pt-5">"Come and take a bite!"</p>
        <p class="marker text-center pb-5">Erin - Owner</p>
    </div>
</div>