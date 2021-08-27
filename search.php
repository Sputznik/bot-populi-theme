<?php get_header(); ?>

<div class="container overlay-div">
	<div class="row">
		<div class="col-md-12" style="margin-top:200px;">
           <h1>Search Results</h1>
           <div class="btp-separator"></div>
             
           <form method="GET" action="<?php bloginfo('url');?>" class="d-flex align-items-center">
                <div class="d-flex flex-row flex-grow-1">
                    <input class="form-control border-right-0 rounded-0" name="s" placeholder="Enter search query">
                    <button class="btn btn-outline-secondary border-left-0 rounded-0 rounded-right" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
                <div style="margin-left: 23px;">
                    <div class="input-group" style="height: 50px;border-radius: unset;">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary" type="button" style="    border-right: unset;height: inherit;border-radius: unset;">Sort by :</button>
                        </div>
                        <select class="custom-select" id="inputGroupSelect03" aria-label="Example select with button addon" style="border-left: unset;height: 50px;border-color: #a566c6;border-radius: unset;background-color: inherit;color: #a566c6;font-size: inherit;font-weight: 500;text-transform: uppercase;">
                            <option selected="">Choose...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>
        
            </form>
        
            <div class="btp-separator"></div>

        </div>
    </div>
    <div class="row col-md-12 tag mt-5">    
        <?php
            $s = get_search_query();
            $output = do_shortcode('[orbit_query post_type="post,podcast,episode,video" s="'. $s .'" pagination="1" style="list" posts_per_page="6"]');

            echo $output; ?>        
    
        </div>
    </div>
</div>    



<?php get_footer();?>
