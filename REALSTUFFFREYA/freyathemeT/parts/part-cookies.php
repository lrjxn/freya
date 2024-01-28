<?php
$cookies_more_info_page = get_field('cookies_more_info_page', 'options');
$cookies_text = get_field('cookies_text', 'options');
?>
<?php if($cookies_text && $cookies_more_info_page): ?>
    <div class="part-cookies">
        <div id="cookies">
            <div class="cookies_container">
                <div class="cookies_text">
                    <?= $cookies_text ?>
                </div>
                <div class="cookies_checkboxes">
                    <div class="checkboxes">
                        <label class="checkbox_container disabled">
                            <input type="checkbox" checked="checked" disabled="disabled">
                            <p><?php _e('Site functionality', 'freya cookies'); ?></p>
                            <span class="checkmark"></span>
                        </label>

                        <label class="checkbox_container">
                            <input name="analytics" type="checkbox" checked="checked">
                            <p><?php _e('Google Analytics', 'freya cookies'); ?></p>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
                <div class="cookies_buttons d-flex flex-wrap align-items-center">
                    <span id="cookies_save" class="btn"><?= __('Save preferences', 'freya cookies') ?></span>
                    <a id="cookies_info" href="<?= $cookies_more_info_page ?>"><?= __('More info', 'freya cookies') ?></a>
                </div>

            </div>
        </div>
    </div>
<?php endif; ?>