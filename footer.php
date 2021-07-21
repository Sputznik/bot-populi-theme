


        </main> <!-- end of main section  -->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12"> <?php 
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