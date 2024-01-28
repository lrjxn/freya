		<?php
        $contact = get_field('contact', 'options');
        $social_media = get_field('social_media', 'options');
        $location = get_field('location', 'options');
        $location_link = get_field('location_link', 'options');
        $open_times = get_field('open_times', 'options');
        $company_details = get_field('company_details', 'options');
        $copyright = get_field('copyright', 'options');

        if($copyright) {
            if(strpos($copyright, '[year]') !== false) $copyright = str_replace('[year]', date('Y'), $copyright);
        }
        ?>
        <footer class="d-md-flex justify-content-center align-items-center">
			<div class="container">
                <div class="row">
                    <div class="left col col-md-6 col-12">
                        <p class="col_header"><?= __('Contact', 'freya') ?></p>

                        <?php if($contact): ?>
                            <div class="contact">
                                <?= $contact ?>
                            </div>
                        <?php endif; ?>

                        <?php if($social_media): ?>
                            <div class="social_media d-flex justify-content-start align-items-start">
                                <?php foreach($social_media as $social_item): ?>
                                    <?php
                                    $icon = $social_item['icon'];
                                    $url = $social_item['url'];
                                    ?>
                                    <?php if($icon && $url): ?>
                                        <a href="<?= $url ?>" target="_BLANK">
                                            <?= wp_get_attachment_image($icon['id'], 'full') ?>
                                        </a>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                       

                        <span class="newsletter btn blue"><?= __('') ?></span>
                    </div>
					
                    <div class="right col col-md-6 col-12 d-flex flex-column justify-content-start align-items-md-end align-items-start">
                        <p class="col_header"><?= __('Location', 'freya') ?></p>

                        <?php if($location): ?>
                            <div class="location">
                                <?= $location ?>
                            </div>
                        <?php endif; ?>

                        <?php if($location_link): ?>
                            <a class="location_link btn" href="<?= $location_link['url'] ?>"<?= $location_link['target'] ? ' target="'.$location_link['target'].'"' : '' ?>><?= $location_link['title'] ?></a>
                        <?php endif; ?>

                        <?php if($open_times): ?>
                            <div class="open_times">
                                <?= $open_times ?>
                            </div>
                        <?php endif; ?>

                    
                    </div>
                </div>
            </div>

            <div class="footer_bottom">
                <div class="container">
                    <div class="row">
                        <div class="company_details col col-md-6 col-12">
                            <?php if($company_details): ?>
                                <div class="row">
                                    <?php foreach($company_details as $key => $detail): ?>
                                        <div class="col <?= $key == 0 ? ' col-md-auto col-12' : 'col-auto' ?>">
                                            <p><?= $detail['text'] ?></p>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="copyright col col-md-6 col-12">
                            <?php if($copyright): ?>
                                <p><?= $copyright ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
		</>
        
      

        <input id="siteurl" type="hidden" value="<?= site_url() ?>" />
        <input id="sitelang" type="hidden" value="<?= ICL_LANGUAGE_CODE ?>" />

		<?php $footer_scripts = get_field('footer_scripts', 'options'); ?>
		<?php if($footer_scripts) echo $footer_scripts; ?>

		<?php wp_footer(); ?>
	</body>
</html>