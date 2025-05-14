<?php
$vr_gaming_archive_element_sortable = get_theme_mod('vr_gaming_archive_element_sortable', array('option1', 'option2', 'option3', 'option4', 'option5'));
?>

<div class="blog-grid-layout">
    <div id="post-<?php the_ID(); ?>" <?php post_class('post-box mb-4 p-3 wow zoomIn'); ?>>
        <?php foreach ($vr_gaming_archive_element_sortable as $value) : ?>
            
            <?php if ($value === 'option1') : ?>
                <div class="post-thumbnail mb-2">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail(); ?>
                        <?php else : ?>
                            <div class="slider-alternate">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/banner.png'; ?>">
                            </div>
                        <?php endif; ?>
                    </a>
                </div>
            <?php endif; ?>

            <?php if ($value === 'option2') : ?>
                <div class="post-meta my-3">
                    <i class="far fa-user me-2"></i>
                    <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                        <?php the_author(); ?>
                    </a>
                    <span class="ms-3">
                        <i class="far fa-comments me-2"></i>
                        <?php comments_number(esc_html__('0', 'vr-gaming'), esc_html__('1', 'vr-gaming'), esc_html__('%', 'vr-gaming')); ?>
                        <?php esc_html_e('comments', 'vr-gaming'); ?>
                    </span>
                </div>
            <?php endif; ?>

            <?php if ($value === 'option3') : ?>
                <h3 class="post-title mb-3 mt-0">
                    <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
                </h3>
            <?php endif; ?>

            <?php if ($value === 'option4') : ?>
                <div class="post-content mb-2">
                    <?php echo wp_trim_words(get_the_content(), get_theme_mod('vr_gaming_post_excerpt_number', 15)); ?>
                </div>
            <?php endif; ?>

            <?php if ($value === 'option5') : ?>
                <div class="edit-cat">
                    
                    <?php $vr_gaming_categories_list = get_the_category_list(', ');
                    if ($vr_gaming_categories_list) : ?>
                        <div class="post-categories">
                            <i class="fas fa-folder me-2"></i> <?php echo $vr_gaming_categories_list; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        <?php echo esc_html(vr_gaming_edit_link()); ?>
    </div>
</div>
