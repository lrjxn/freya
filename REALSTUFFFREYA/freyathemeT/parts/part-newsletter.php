<?php
$mailerlite_api = get_field('mailerlite_api', 'options');
$mailerlite_group_id = get_field('mailerlite_group_id', 'options');
$newsletter_form = get_field('newsletter_form', 'options');
?>
<?php if($mailerlite_api && $mailerlite_group_id && $newsletter_form): ?>
    <div class="part-newsletter">
        <div id="newsletter">
            <div class="newsletter_wrapper w100 h100 d-flex justify-content-center align-items-center">
                <div class="newsletter_container">
                    <p class="title"><?= __('Join our newsletter', 'freya') ?></p>
                    <?= do_shortcode($newsletter_form); ?>
                    <div class="close_newsletter"></div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>