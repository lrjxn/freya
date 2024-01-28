<?php get_header(); ?>

<main id="content" class="front_page">
    <?php if(have_posts()): while(have_posts()): the_post(); ?>
            
<br><br><br><br><br><br>
        <div class="container">
            <div class="content">
                <?php the_content(); ?>
            </div>
        </div>
    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>