<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?></title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<?php wp_head(); ?>

        <link rel="preload" href="<?= THEME_URL ?>/fonts/montserrat-v24-latin-ext_latin_cyrillic-ext_cyrillic-300.woff2" as="font" type="font/woff2" crossorigin>
        <link rel="preload" href="<?= THEME_URL ?>/fonts/montserrat-v24-latin-ext_latin_cyrillic-ext_cyrillic-300.woff2" as="font" type="font/woff2" crossorigin>
		
		<?php $header_scripts = get_field('header_scripts', 'options'); ?>
		<?php if($header_scripts) echo $header_scripts; ?>
	</head>
	<body <?php body_class(); ?>>
		<?php
		$logo = get_field('logo', 'options');
		$logo_white = get_field('logo_white', 'options');
		$logo_scroll = get_field('logo_scroll', 'options');
		$logo_scroll_white = get_field('logo_scroll_white', 'options');
		$cookies_text = get_field('cookies_text', 'options');
		$cookies_more_info_page = get_field('cookies_more_info_page', 'options');
		?>

		<header>
            <?php if(is_front_page()): ?>
                <div id="frontpage_header">
                    <div class="header_wrapper d-flex justify-content-between align-items-start">
                        <?php if($logo_white): ?>
                            <a class="home_url" href="<?= home_url() ?>">
                                <img class="no-lazy" src="<?= $logo['url'] ?>" alt="<?= $logo['alt'] ?>" width="<?= $logo['width'] ?>" height="<?= $logo['height'] ?>" />
                            </a>
                        <?php endif; ?>

                        <div class="header_right d-flex align-items-center">
                            <?php if($header_reservation_link): ?>
                                <a class="reservation_link btn white transparent xsmall" href="<?= $header_reservation_link['url'] ?>"<?= $header_reservation_link['target'] ? ' target="'.$header_reservation_link['target'].'"' : '' ?>><?= $header_reservation_link['title'] ?></a>
                            <?php endif; ?>

                            <div class="hamburger hamburger--squeeze js-hamburger">
                                <div class="hamburger-box">
                                    <div class="hamburger-inner"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div id="page_header">
                    <div class="header_wrapper d-flex justify-content-between align-items-start">
                        <div class="header_left d-flex">
                            <?php if($logo): ?>
                                <a class="home_url" href="<?= home_url() ?>">
                                    <img class="no-lazy" src="<?= $logo['url'] ?>" alt="<?= $logo['alt'] ?>" width="<?= $logo['width'] ?>" height="<?= $logo['height'] ?>" />
                                </a>
                            <?php endif; ?>

                            <div class="header_menu">
                                <?php template_nav(); ?>
                            </div>
                        </div>

                        <div class="header_right d-flex align-items-center">
                            <div class="language_switcher">
                                <?php do_action('wpml_add_language_selector') ?>
                            </div>

                            <?php if($header_reservation_link): ?>
                                <a class="reservation_link btn white xsmall" href="<?= $header_reservation_link['url'] ?>"<?= $header_reservation_link['target'] ? ' target="'.$header_reservation_link['target'].'"' : '' ?>><?= $header_reservation_link['title'] ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div id="burger_menu">
                <div class="header_wrapper h100">
                    <div class="d-flex header_menu_container h100">
                        <div class="header_menu w100 d-flex flex-column justify-content-between align-items-center">
                            <div class="header_top w100 d-flex justify-content-center align-items-center">
                                <?php if($header_reservation_link): ?>
                                    <a class="reservation_link btn blue xsmall" href="<?= $header_reservation_link['url'] ?>"<?= $header_reservation_link['target'] ? ' target="'.$header_reservation_link['target'].'"' : '' ?>><?= $header_reservation_link['title'] ?></a>
                                <?php endif; ?>

                                <div class="hamburger rotate d-xl-block d-none">
                                    <div class="hamburger-box">
                                        <div class="hamburger-inner"></div>
                                    </div>
                                </div>
                                
                                <div class="hamburger hamburger--squeeze js-hamburger d-xl-none d-block">
                                    <div class="hamburger-box">
                                        <div class="hamburger-inner"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="header_center">
                                <?php template_nav(); ?>
                                <span class="newsletter"><?= __('') ?></span>
                            </div>

                            <div class="header_bottom">
                                <?php if($header_other_restorants_link): ?>
                                    <a class="other_restorants_link arrow_link noHover" href="<?= $header_other_restorants_link['url'] ?>"<?= $header_other_restorants_link['target'] ? ' target="'.$header_other_restorants_link['target'].'"' : '' ?>><?= $header_other_restorants_link['title'] ?></a>
                                <?php endif; ?>
                                <?php if($header_other_restorants_link1): ?>
                                    <a class="other_restorants_link1 arrow_link noHover" href="<?= $header_other_restorants_link1['url'] ?>"<?= $header_other_restorants_link1['target'] ? ' target="'.$header_other_restorants_link1['target'].'"' : '' ?>><?= $header_other_restorants_link1['title'] ?></a>
                                <?php endif; ?>


                                <div class="language_switcher">
                                    <?php do_action('wpml_add_language_selector') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="header_scroll"<?= is_front_page() ? ' class="transparent_mob"' : '' ?>>
                <div class="header_wrapper d-flex justify-content-xl-between justify-content-start align-items-center">
                    <div class="header_left d-flex align-items-center">
                        <?php if($logo_scroll): ?>
                            <a class="home_url" href="<?= home_url() ?>">
                                <img class="no-lazy" src="<?= $logo_scroll['url'] ?>" alt="<?= $logo_scroll['alt'] ?>" width="<?= $logo_scroll['width'] ?>" height="<?= $logo_scroll['height'] ?>" />
                            </a>
                        <?php endif; ?>

                        <div class="header_menu d-xl-block d-none">
                            <?php template_nav(); ?>
                        </div>
                    </div>

                    <div class="header_right d-xl-flex d-none align-items-center">
                        <div class="language_switcher">
                            <?php do_action('wpml_add_language_selector') ?>
                        </div>

                        <?php if($header_reservation_link): ?>
                            <a class="reservation_link btn white xsmall" href="<?= $header_reservation_link['url'] ?>"<?= $header_reservation_link['target'] ? ' target="'.$header_reservation_link['target'].'"' : '' ?>><?= $header_reservation_link['title'] ?></a>
                        <?php endif; ?>
                        <?php if($header_reservation_link1): ?>
                            <a class="reservation_link1 btn white xsmall" href="<?= $header_reservation_link1['url'] ?>"<?= $header_reservation_link1['target'] ? ' target="'.$header_reservation_link1['target'].'"' : '' ?>><?= $header_reservation_link1['title'] ?></a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="hamburger hamburger--squeeze js-hamburger d-xl-none d-block">
                    <div class="hamburger-box">
                        <div class="hamburger-inner"></div>
                    </div>
                </div>
            </div>
		</header>