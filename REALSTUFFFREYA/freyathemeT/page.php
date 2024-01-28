<?php get_header(); ?>

<main id="content" class="default_page">

    <?php if(have_posts()): while(have_posts()): the_post(); ?>
        <div class="container">
            <div class="row">
                <div class="col title rect">
                    <h1><?php the_title(); ?></h1>
                </div>
            </div>
            <div class="content">
                <?php the_content(); ?>
            </div>
        </div>
    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>