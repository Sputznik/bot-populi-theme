<?php

class BTP_SEARCH_FILTERS_FORM extends BTP_SINGLETON{

	function __construct(){

		/* LOAD ASSETS */
		add_action('wp_enqueue_scripts', array( $this, 'assets' ) );

		add_shortcode( 'btp_filters', array( $this, 'btpFilters' ) );

	}

	function assets(){
		if( is_page_template("page_archive.php") ){
			//ENQUEUE STYLES
			wp_enqueue_style('btp-filters-css', BTP_DIR_URI.'/lib/filters/assets/css/filters.css', array(), time() );

			//ENQUEUE SCRIPTS
			wp_enqueue_script( 'btp-filters-dropdown-js', BTP_DIR_URI.'/lib/filters/assets/js/dropdown-checkboxes.js', array('jquery'), time(), true );
		}
	}

	// GET ALL THE FILTERS AS ARRAY
	function getFilters(){
		return array(
			array(
				'form' 						=> 'dropdown',
				'type'						=> 'tax',
				'typeval'					=> 'section',
				'default_option'	=> 'All sections',
				'items'						=> $this->getTerms('category')
			),
			array(
				'form' 						=> 'dropdown',
				'type'						=> 'tax',
				'typeval'					=> 'author',
				'default_option'	=> 'All authors',
				'items'						=> $this->getTerms('author'),
				'class'						=> 'dropdown-lg author'
			),
			array(
				'form' 						=> 'dropdown',
				'type'						=> 'custom',
				'typeval'					=> 'type',
				'default_option'	=> 'All types',
				'items'						=> $this->getTypes()
			),
			// array(
			// 	'form' 						=> 'chips',
			// 	'type'						=> 'tax',
			// 	'typeval'					=> 'keywords',
			// 	'default_option'	=> 'All keywords',
			// 	'items'						=> $this->getTerms('post_tag')
			// ),
			array(
				'form' 						=> 'dropdown',
				'type'						=> 'custom',
				'typeval'					=> 'sort',
				'default_option'	=>	'Newest to oldest',
				'items'						=> array( array(
					'slug' => 'asc',
					'name' => 'Oldest to newest'
				) ),
			),
		);

	}

	function getTerms( $term_type ){
		$terms = get_terms( array(
	    'taxonomy'    => $term_type,
			'exclude'			=> 1,
	    'hide_empty'  => false,
	  ) );

		$new_items = array();

		foreach( $terms as $term ){
			array_push( $new_items, array( 'slug' => $term->slug, 'name'	=> $term->name ) );
		}

		return $new_items;
	}

	function getTypes(){
		return array(
			array(
				'slug' => 'article',
				'name' => 'Article'
			),
			array(
				'slug' => 'podcast',
				'name' => 'Podcast'
			),
			array(
				'slug' => 'video',
				'name' => 'Video'
			)
		);
	}

	function getTaxQuery( $params ){

		if( empty( $params['section'] ) && empty( $params['keywords'] ) ) return array();

		$tax_query = array('relation'=> 'OR');
		$taxonomies = array(
			'category' => 'section',
			'post_tag' => 'keywords'
		);

    foreach ( $taxonomies as $taxonomy => $alias ){
			if( isset( $params[$alias] ) && $params[$alias] ){
				array_push( $tax_query, array(
          'taxonomy' => $taxonomy,
          'field' => 'slug',
          'terms' => $params[$alias],
        ) );
      }
			else{
				array_push( $tax_query, array(
          'taxonomy' => $taxonomy,
          'field' => 'slug',
          'terms' => wp_list_pluck( $this->getTerms( $taxonomy ), 'slug' ),
        ) );
			}
    }

		return $tax_query;

  }

	function getCurrentURL(){
    global $wp;

    // get current url with query string.
    $current_url =  home_url( $wp->request );

		// get the position where '/page.. ' text start.
		$pos = strpos( $current_url , '/page' );

    // REMOVE PAGINATION PARAMETERS
    if( $pos !== false ){
      // remove string from the specific postion
      $current_url = substr( $current_url, 0, $pos );
    }

    return $current_url;
  }

	public static function getResultChips( $params ){
		$res_chips = array();

		if( isset( $params ) ){
	    foreach( $params as $slug => $value ){
	      if( isset( $slug ) && !empty( $value ) ){
	        if( $slug != 'sort' ){
	          $res_chips[$slug] = $value;
	        }
	        else{
	          $new_val = ( $value == 'asc' ) ? 'Oldest to newest': ( empty( $value ) ? 'Newest to oldest' : '' );
	          $res_chips[$slug] = $new_val;
	        }
	      }
	    }
	  }

		return $res_chips;

	}

	public static function paramsCount( $params ){
		return ( count( self::getResultChips( $params ) ) );
	}

	/* SHORTCODE CALLBACK */
	function btpFilters( $atts ){
		ob_start();
    include( 'templates/search-filters.php' );
    return ob_get_clean();

	}

}

BTP_SEARCH_FILTERS_FORM::getInstance();
