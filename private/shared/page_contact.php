<?php 

$id = $_GET['id'] ?? '1'; 

$subject_set = find_subjects_by_page($id);

?>     

<div class="container-md">
    <div class="row align-items-center py-5">
        <div class="col-lg-6 mb-5 mb-lg-0">
            <div class="map-container border border-2 border-dark"></div>
        </div>
        <div class="col-lg-6 text-center">
            <h1 class="page-title display-3 mb-4">Stop By!</h1>
            <?php while($subject = mysqli_fetch_assoc($subject_set)) { ?>
                <p class="fs-5 <?php echo $subject['menu_name'] != 'Email' ?: 'fw-bold'; ?>"><?php echo $subject['content']; ?></p>
            <?php } ?>  
        </div>
    </div>
    <p class="marker text-center pt-5">Don't just look at the pics.</p>
    <p class="marker text-center pb-5">Come and see for yourself!</p>
    <div class="py-5">
        <h2 class="display-4 mb-5 text-center text-lg-start">Drop us a line</h2>
        <div class="row">
            <div class="col-lg-7 col-xl-8 pe-lg-5 mb-5 mb-lg-0">
                <form id="form">
                    <input class="mb-4 p-4 border-dashed" type="text" placeholder="Your Name" required="required" />
                    <input class="mb-4 p-4 border-dashed" type="email" placeholder="Email Address" required="required" />
                    <input class="mb-4 p-4 border-dashed" type="tel" pattern="[0-9]{10}" placeholder="Contact Number" required="required" />
                    <textarea class="mb-4 p-4 border-dashed" placeholder="Feel Free to Leave Your Enquiry." required="required"></textarea>
                    <button class="border border-2 border-dark py-4 text-uppercase text-reset form-btn" id="form-btn">Submit</button>
                </form>
                <div class="p-4 confirm-msg">Thank you! Your message has been received! </div>
            </div>
            <div class="col-lg-5 col-xl-4">
                <div class="d-flex justify-content-center">
                    <img class="img vertical-img" src="<?php echo url_for('images/donuts-vertical.jfif'); ?>" alt="Three Donuts Stacked Together" />
                </div>
            </div>
        </div>
    </div>

    <?php mysqli_free_result($subject_set); ?>
</div>