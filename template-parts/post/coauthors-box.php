<div class="post-author-box">
    <div class="title">About the Author(s)</div>
    <?php
      $coauthors = get_coauthors();
      foreach ( $coauthors as $coauthor ):
    ?>
      <div class="content-wrapper" style="margin-bottom: 50px;">
        <div class="author-avatar">
          <?php echo get_avatar( $coauthor->ID ); ?>
        </div>
        <div class="author-info">
          <div class="author-name"><?php _e( $coauthor->display_name ); ?></div>
          <p class="author-bio">
            <?php _e( $coauthor->description ); ?>
          </p>
          <button class="btp-btn">
            <a href="<?php _e( get_author_posts_url( $coauthor->ID, $coauthor->user_nicename ) ); ?>">Read More</a>
            <i class="fas fa-long-arrow-alt-right"></i>
          </button>
        </div>
      </div>
    <?php endforeach;?>
</div>
