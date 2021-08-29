<?php 
    get_header(); 
    
    $s = get_search_query();
    

    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'date-desc'; 
                
    switch ($sort) {
        case 'date-asc':
            $orderby = "date";
            $order   = "ASC";
            break;
        case 'title-asc':
            $orderby = "title";
            $order   = "ASC";
            break;
        case 'title-desc':
            $orderby = "title";
            $order   = "DESC";
            break;
        default:
            $orderby = "date";
            $order   = "DESC";
    }

?>

<div class="container overlay-div">
	<div class="row">
		<div class="col-md-12">
           <h1 class="search-title">Search Results</h1>
           <div class="btp-separator d-none d-md-block"></div>
             
           <form method="GET" action="<?php bloginfo('url');?>">
                <div class="d-flex flex-row flex-grow-1">
                    <input class="form-control border-right-0 rounded-0" name="s" placeholder="Enter search query" value="<?php _e($s);?>">
                    <button class="btn btn-outline-secondary border-left-0 rounded-0 rounded-right btn-search" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
                <div class="sort-wrapper">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary btn-sort" type="submit">Sort by :</button>
                        </div>
                        <select name="sort" class="custom-select">
                            <option <?php $sort == 'date-desc' ? _e('selected') : '' ?> value="date-desc">Newest to oldest</option>
                            <option <?php $sort == 'date-asc' ? _e('selected') : '' ?> value="date-asc">Oldest to newest</option>
                            <option <?php $sort == 'title-asc' ? _e('selected') : '' ?> value="title-asc">A to Z</option>
                            <option <?php $sort == 'title-desc' ? _e('selected') : '' ?> value="title-desc">Z to A</option>
                        </select>
                    </div>
                </div>
        
            </form>
        
            <div class="btp-separator"></div>

        </div>
    </div>
    <div class="row col-md-12 tag mt-5">    
        <?php
            $output = do_shortcode('[orbit_query post_type="post,podcast,episode,video" s="'. $s .'" order="'. $order .'" orderby="'. $orderby .'" pagination="1" style="list" posts_per_page="6"]');

            echo $output; ?>        
    
        </div>
    </div>
</div>    



<?php get_footer();?>
