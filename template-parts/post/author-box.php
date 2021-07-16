<div class="post-author-box">
    <div class="title">About the Author</div>
    <div class="content-wrapper">
        <div class="author-avatar">
        <?php echo get_avatar( get_the_author_meta( 'ID' ) ); ?>
        </div>
        <div class="author-info">
            <div class="author-name"><?php _e(get_the_author());?></div>
            <p class="author-bio">Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto ex, temporibus quas dicta reiciendis minus doloribus ipsam, quisquam laboriosam a, dolor iste. Odit, animi voluptatem.</p>
            <button class="btp-btn">
                <a href="<?php _e(get_author_posts_url($post->post_author)); ?>">Read More </a>
                <i class="fas fa-long-arrow-alt-right"></i>
            </button>
        </div>
    </div>
</div>