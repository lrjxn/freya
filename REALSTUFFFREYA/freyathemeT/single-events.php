<?php get_header(); ?>

<main id="content" class="default_page single_event">
    <?php if(have_posts()): while(have_posts()): the_post(); ?>
        <?php
        $price = get_field('price');
        $contact = get_field('contact');
        ?>
        <div class="container">
            <div class="row">
                <div class="col title">
                    <h1><?php the_title(); ?></h1>
                    <span class="rect fade-in-up"></span>
                </div>
            </div>
            <div class="content">
                <div class="row">
                    <div class="col col-md-6 col-12">
                        <?= wp_get_attachment_image(get_post_thumbnail_id(), 'half_column', false, array('class' => 'fade-in-up')) ?>
                    </div>
                    <div class="col col-md-6 col-12">
                        <div class="text">
                            <?php the_content(); ?>
                        </div>

                        <?php if($price): ?>
                            <p class="price"><?= $price ?></p>
                        <?php endif; ?>

                        <?php if($contact): ?>
                            <div class="contact">
                                <?= $contact ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>