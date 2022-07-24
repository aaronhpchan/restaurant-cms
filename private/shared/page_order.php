<?php $subject_set = find_all_product_types(['visible' => true]); ?> 

<div class="container-md px-3 px-md-0 mb-5">
    <?php while($subject = mysqli_fetch_assoc($subject_set)) { ?>
        <h2 class="display-6 pt-5"><?php echo h($subject['menu_name']); ?></h2>
        
        <?php $product_set = find_products_by_subject($subject['id']); ?>
        <div class="row pt-4">
            <?php foreach ($product_set as $value) { ?>
                <div class="col-lg-6 mb-3">
                    <div class="card-light p-3 pb-2">
                        <div class="h5"><?php echo $value['menu_name']; ?></div>
                        <div class="card-light-text"><?php echo $value['description']; ?></div>
                        <div class="h6 pt-4">$<?php echo $value['price']; ?></div>
                    </div>
                </div>
            <?php } ?>
        </div>  
    <?php } ?>
    <?php mysqli_free_result($subject_set); ?>
</div>

<div class="overflow-hidden modal">
    <div class="modal-content"><span class="close">&times;</span>
        <div class="h5 modal-heading"> </div>
        <div class="pt-3 pb-4 modal-desc"> </div>
        <div class="d-flex justify-content-between align-items-center">
            <div class="h6">Qty <i class="fas fa-minus-circle"></i><span class="mx-2 quantity">1</span><i class="fas fa-plus-circle"></i></div>
            <div class="h6 modal-price"> </div>
        </div><button class="mt-3 py-1 rounded-1 add-cart">Add to Cart</button>
    </div>
</div>

