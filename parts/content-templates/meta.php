<footer class="post-meta">
    <ul>
        <li class="posted">Posted
            <?php echo sprintf( '<time class="post-date" datetime="%1$s">%2$s</time>',
                esc_attr( get_the_date( 'c' ) ),
                get_the_date() 
            ); ?>
        </li>
        <?php if( (get_the_modified_time( 'U' ) - get_the_time( 'U' )) > 1*60*60*24 ) : ?>
            <li class="updated">Last updated
                <?php echo sprintf( '<time class="post-updated" datetime="%1$s">%2$s</time>',
                        esc_attr( get_the_modified_date( 'c' ) ),
                        get_the_modified_date() 
                ); ?>
            </li>
        <?php endif; ?>
        <?php if( has_category() ) : ?>
            <li class="categories"><?php the_category(' &bull; '); ?></li>
        <?php endif; ?>
        <?php if ( has_tag() ) : ?>
            <li class="tags"><?php the_tags('',' # '); ?></li>
        <?php endif; ?>
        <?php if ( get_field( 'credits' ) ) : ?>
            <li class="credits"><?php the_field( 'credits' ); ?></li>
        <?php endif; ?>
        <?php if ( get_field( 'photo_credits' ) ) : ?>
            <li class="photo-credits"><?php the_field( 'photo_credits' ); ?></li>
        <?php endif; ?>
    </ul>
</footer>