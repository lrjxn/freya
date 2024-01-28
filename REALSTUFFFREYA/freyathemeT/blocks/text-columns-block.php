<?php
   /**
    * Text Columns Block Layout.
    *
    * @param   array $block The block settings and attributes.
    * @param   string $content The block inner HTML (empty).
    * @param   bool $is_preview True during AJAX preview.
    * @param   (int|string) $post_id The post ID this block is saved to.
   */

    $blockSlug = 'text-columns-block';
    $uniqueID = $blockSlug . '-' . $block['id'];
    $className = $blockSlug;

    if(!empty($block['anchor'])) {
        $uniqueID = $block['anchor'];
    }

    if(!empty($block['className'])) {
        $className .= ' ' . $block['className'];
    }
   
    $add_rectangle = get_field('add_rectangle', $block['id']);
    $columns = get_field('columns', $block['id']);
    $button = get_field('button', $block['id']);
?>

<?php if($columns): ?>
    <div id="<?php echo esc_attr($uniqueID); ?>" class="<?php echo esc_attr($className); ?>">
        <?php if($add_rectangle == 1): ?>
            <div class="black-rect"></div>
        <?php endif; ?>

       <div class="row">
           <?php foreach($columns as $column): ?>
                <?php $text = $column['text']; ?>
                <?php if($text): ?>
                    <div class="col col-md-6 col-12" style="width:80%;height:90%;background-color:#f7ead2;margin-left:10%;padding:70px;padding-top:100px;">
                        <?= $text ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
       </div>

       <?php if($button): ?>
            <a class="btn white xsmall" href="<?= $button['url'] ?>"<?= $button['target'] ? ' target="'.$button['target'].'"' : '' ?>><?= $button['title'] ?></a>
        <?php endif; ?>
    </div>
<?php endif; ?>