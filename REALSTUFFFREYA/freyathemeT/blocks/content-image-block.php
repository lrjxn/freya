<?php
   /**
    * Content Image Block Layout.
    *
    * @param   array $block The block settings and attributes.
    * @param   string $content The block inner HTML (empty).
    * @param   bool $is_preview True during AJAX preview.
    * @param   (int|string) $post_id The post ID this block is saved to.
   */

    $blockSlug = 'content-image-block';
    $uniqueID = $blockSlug . '-' . $block['id'];
    $className = $blockSlug;

    if(!empty($block['anchor'])) {
        $uniqueID = $block['anchor'];
    }

    if(!empty($block['className'])) {
        $className .= ' ' . $block['className'];
    }
   
    $image = get_field('image', $block['id']);
?>

<?php if($image): ?>
    <div id="<?php echo esc_attr($uniqueID); ?>" class="<?php echo esc_attr($className); ?>">
        <div class="fade-in-up">
            <?= wp_get_attachment_image($image['id'], 'content_image') ?>
        </div>
    </div>
<?php endif; ?>