<?php $subject_set = find_all_product_types(['visible' => $visible]); ?>

<div class="container-md px-3 px-md-0 mb-5">
    <h1 class="page-title display-3 pt-5 pb-4"><?php echo $page['menu_name']; ?></h1>

    <?php foreach($subject_set as $i => $subject) { ?>
        <h2 class="display-5 pt-5<?php echo $i != 0 ? ' mt-5 mt-lg-0' : null; ?>"><?php echo h($subject['menu_name']); ?></h2>

        <?php $product_set = find_products_by_subject($subject['id'], ['visible' => $visible]); ?>
        <div class="row d-flex align-items-center pt-4<?php echo $i % 2 != 0 ? ' pt-lg-5' : null; ?>">
            <div class="col-lg-6 menu <?php echo $i % 2 == 0 ? 'pe-lg-5' : 'ps-lg-5 order-1 order-lg-2'; ?>">
                <?php foreach ($product_set as $product) { ?>
                    <div><span><?php echo $product['menu_name']; ?></span><span>$<?php echo $product['price']; ?></span></div>
                <?php } ?>
            </div>
            <div class="col-lg-6 mt-4 mt-lg-0<?php echo $i % 2 != 0 ? ' order-2 order-lg-1' : null; ?>">
                <img class="img" src="<?php echo url_for('/images/menu_' . strtolower($subject['menu_name'])) . '.jpg'; ?>" alt="<?php echo $subject['menu_name']; ?>" />
            </div>
        </div>
    <?php } ?>
</div>