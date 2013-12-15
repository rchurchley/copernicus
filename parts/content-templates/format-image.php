<figure class="format-image">
    <?php if( has_post_thumbnail() ) : ?>
        <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" alt=""/>
    <?php endif;?>

    <figcaption><?php the_content(); ?></figcaption>
</figure>