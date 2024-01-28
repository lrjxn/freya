<?php
    $form_shortcode = get_field('form_shortcode');
    $form_description = get_field('form_description');
?>

<div class="part-private-form container">
    <div class="row mrg32">
        <?php if($form_description): ?>
            <div class="col col-lg col-12 pdd32">
                <div class="form_desc">
                    <?= $form_description;?>
                </div>
            </div>
        <?php endif; ?>
        <?php if($form_shortcode): ?>
            <div class="col col-lg col-12 pdd32 private_form">
                <?= do_shortcode($form_shortcode);?>
            </div>
    </div>
</div>
<?php endif; ?>