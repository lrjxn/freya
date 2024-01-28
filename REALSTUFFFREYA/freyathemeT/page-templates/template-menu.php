<?php
/*
Template Name: Menu Template
*/

get_header();
?>

<main id="content" class="menu_template">
	<?php if(have_posts()): ?>
        <?php while(have_posts()): the_post(); ?>
            <?php
            $menu = get_field('menu');

            $args = array(
 
                'order' => 'ASC'
            );

            $menu_pages = get_posts($args);
            $menu_buttons = get_field('menu_buttons', 'options');
            ?>

            <?php if($menu_pages || $menu_buttons): ?>
                <div class="menu_links_fixed">
                    <div class="container">
                        <div class="menu_links_container d-flex">
                            <div class="menu_links d-flex flex-lg-nowrap flex-wrap">
                                <?php if($menu_pages): ?>
                                    <?php foreach($menu_pages as $menu_page): ?>
                                        <a <?= $post->ID == $menu_page->ID ? 'class="active" ' : '' ?>href="<?= get_permalink($menu_page->ID) ?>"><?= $menu_page->post_title ?></a>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                                <?php if($menu_buttons): ?>
                                    <?php foreach($menu_buttons as $btn): ?>
                                        <?php if($btn['menu_text'] && $btn['button_text']): ?>
                                            <?php if($btn['dont_show_pages'] && in_array($post->ID, $btn['dont_show_pages'])): ?>
                                                <?php if($menu_pages): ?>
                                                    <?php foreach($menu_pages as $menu_page): ?>
                                                        <?php if(!in_array($menu_page->ID, $btn['dont_show_pages'])): ?>
                                                            <a href="<?= get_permalink($menu_page->ID) . '#scroll=' . sanitize_title($btn['button_text']) ?>"><?= $btn['menu_text']?></a>
                                                            <?php break; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <span data-scroll="<?= sanitize_title($btn['button_text']) ?>"><?= $btn['menu_text']?></a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="container title_container">
                <h1><?= get_the_title($parent); ?></h1>
            </div>

     
                <?php if($menu_pages || $menu_buttons): ?>
                    <div class="container">
                        <div class="menu_links_container d-lg-flex d-none">
                            <div class="menu_links d-flex">
                                <?php if($menu_pages): ?>
                                    <?php foreach($menu_pages as $menu_page): ?>
                                        <a <?= $post->ID == $menu_page->ID ? 'class="active" ' : '' ?>href="<?= get_permalink($menu_page->ID) ?>"><?= $menu_page->post_title ?></a>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                                <?php if($menu_buttons): ?>
                                    <?php foreach($menu_buttons as $btn): ?>
                                        <?php if($btn['menu_text'] && $btn['button_text']): ?>
                                            <?php if($btn['dont_show_pages'] && in_array($post->ID, $btn['dont_show_pages'])): ?>
                                                <?php if($menu_pages): ?>
                                                    <?php foreach($menu_pages as $menu_page): ?>
                                                        <?php if(!in_array($menu_page->ID, $btn['dont_show_pages'])): ?>
                                                            <a href="<?= get_permalink($menu_page->ID) . '#scroll=' . sanitize_title($btn['button_text']) ?>"><?= $btn['menu_text']?></a>
                                                            <?php break; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <span data-scroll="<?= sanitize_title($btn['button_text']) ?>"><?= $btn['menu_text']?></a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

		    <div class="container">
			<div class="" style="width:90%;height:80%;background-color:#f7ead2;margin-left:50px;padding:20px;">
                <div class="menu">
                    <?php if($menu): ?>
                        <?php foreach($menu as $category): ?>
                            <?php
                            $cat = $category['category'];
                            $items = $category['category_items'];
                            ?>
                            <?php if($items): ?>
                                <div class="category">
                                    <?php if($cat): ?>
                                        <h4><?= $cat ?></h4>
                                    <?php endif; ?>
                                    
                                    <?php foreach($items as $item): ?>
                                        <?php
                                        $name = $item['name'];
                                        $price = $item['price'];
										$description = $item['description'];
                                        $gvl = $item['gvl'];
									

										
                                        ?>

                                        <?php if($name): ?>
                                            <div class="item d-flex flex-lg-nowrap flex-md-nowrap flex-wrap justify-content-between">
                                                <div class="name col col-lg col-md col-sm col-8">
                                                    <?= $name ?>
                                                </div>
                                                <div class="price col col-lg col-md col-sm col-4">
                                                    <?= $price ? '<span>'.$price.'</span>' : '' ?>
                                                </div>
												 </div>

												<div class="item d-flex flex-lg-nowrap flex-md-nowrap flex-wrap justify-content-between">
												<div class="description col col-lg col-md col-sm col-4">
                                                    <?= $description ? '<span>'.$description.'</span>' : '' ?>
                                                </div></div>

												
												<div class="gvl">
                                                    <?= $gvl ? '<span>'.$gvl.'</span>' : '' ?>
                                                </div>
								
											
<br>

                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>

                   
                </div>
            </div>
        <?php endwhile; ?>
	<?php endif; ?>
</main>

<?php get_footer(); ?>