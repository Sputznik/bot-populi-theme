


        </main> <!-- end of main section  -->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <?php $logo = BTP_DIR_URI . '/assets/images/logo-footer.png'; ?> 
                        <a href="<?php _e(home_url());?>">
                            <img src="<?php _e($logo);?>" alt="site-logo-footer" class="site-logo-footer">
                        </a>
                        <?php 
                        if ( is_active_sidebar( 'footer-sidebar' ) ) {
                            dynamic_sidebar( 'footer-sidebar' );
                        } ?>
                    </div>
                </div>
            </div>
        </footer>
        
    </div> <!-- end of #site  -->
<?php wp_footer(); ?>    
</body>
</html>