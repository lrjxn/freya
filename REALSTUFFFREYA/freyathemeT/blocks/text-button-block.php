<?php
   /**
    * Text Button Block Layout.
    *
    * @param   array $block The block settings and attributes.
    * @param   string $content The block inner HTML (empty).
    * @param   bool $is_preview True during AJAX preview.
    * @param   (int|string) $post_id The post ID this block is saved to.
   */

    $blockSlug = 'text-button-block';
    $uniqueID = $blockSlug . '-' . $block['id'];
    $className = $blockSlug;

    if(!empty($block['anchor'])) {
        $uniqueID = $block['anchor'];
    }

    if(!empty($block['className'])) {
        $className .= ' ' . $block['className'];
    }

if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
   
    $text = get_field('text', $block['id']);
    $link = get_field('link', $block['id']);
?>

<?php if($text): ?>
    <div id="<?php echo esc_attr($uniqueID); ?>" class="<?php echo esc_attr($className); ?>">
        <div class="text">
            <?= $text ?>
        </div>

        <?php if($link): ?>
            <a class="btn small" href="<?= $link['url'] ?>" <?= $link['target'] ? ' target="'.$link['targt'].'"' : '' ?>><?= $link['title'] ?></a>
        <?php endif; ?>
</div>
  <style type="text/css">
        <?php echo $id; ?> 
    </style>
</div>
<?php endif; ?>