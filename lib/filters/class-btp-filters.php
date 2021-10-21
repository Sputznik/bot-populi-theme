<?php

class BTP_SEARCH_FILTERS_FORM extends BTP_SINGLETON{

	function __construct(){

		/* LOAD ASSETS */
		add_action('wp_enqueue_scripts', array( $this, 'assets' ) );

		add_shortcode( 'btp_filters', array( $this, 'btpFilters' ) );

	}

	function assets(){

		//ENQUEUE STYLES
		wp_enqueue_style('btp-filters-css', BTP_DIR_URI.'/lib/filters/assets/css/filters.css', array(), time() );

		//ENQUEUE SCRIPTS
		wp_enqueue_script( 'btp-filters-dropdown-js', BTP_DIR_URI.'/lib/filters/assets/js/dropdown-checkboxes.js', array('jquery'), time(), true );
	}

	// GET ALL THE FILTERS AS ARRAY
	function getFilters(){
		return array(
			array(
				'form' 						=> 'dropdown',
				'type'						=> 'tax',
				'typeval'					=> 'category',
				'default_option'	=> 'All sections',
				'items'						=> $this->getTerms('category')
			),
			array(
				'form' 						=> 'dropdown',
				'type'						=> 'custom',
				'typeval'					=> 'type',
				'default_option'	=> 'All types',
				'items'						=> $this->getTypes()
			),
			array(
				'form' 						=> 'chips',
				'type'						=> 'tax',
				'typeval'					=> 'post_tag',
				'default_option'	=> 'All keywords',
				'items'						=> $this->getTerms('post_tag')
			)
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

	/* SHORTCODE CALLBACK */
	function btpFilters( $atts ){
		ob_start();
    include( 'templates/search-filters.php' );
    return ob_get_clean();

	}

}

BTP_SEARCH_FILTERS_FORM::getInstance();
