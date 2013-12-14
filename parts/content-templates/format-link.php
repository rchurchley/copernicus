<h1><a class="external-link" href="<?php echo esc_url( copernicus_get_link_url() ); ?>">
    <?php the_title(); ?>
</a></h1>

<?php if( has_post_thumbnail() ) : ?>
    <img class="alignleft" src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" alt=""/>
<?php endif;?>

<?php the_content(); ?>