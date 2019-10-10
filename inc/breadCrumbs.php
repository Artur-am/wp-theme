<?php

class breadCrumbs {
    public $breadcrumbs;
    public $countBreadcrumb = 0;
    
    public $taxonomy;
	
	public function __construct(){
        
        $this->set( 'Home' , site_url() );

        $this->taxonomy = empty( get_query_var( 'taxonomy' ) ) ? 'category' : get_query_var( 'taxonomy' );

        $this->ActivePage();

    }
    
    private function ActivePage(){
        $term = get_queried_object();

        if( empty($term) ){
            $this->is();
            return null;
        }
        $title = '';

        if( array_key_exists( 'name',  $term ) ){
            $title = $term->name;
            $this->getCategory( $term->term_id );
        }
        else if( array_key_exists( 'post_name', $term ) ){
            $title = $term->post_name;
            $this->getPostCategori();
        }

        $this->set( $title );
    }

    private function getPostCategori(){
        global $post;
        
        foreach( get_object_taxonomies( $post ) as $taxonomy ) {

            if( !empty( _get_term_hierarchy( $taxonomy ) ) ){
                $this->taxonomy = $taxonomy;
                break;
            }

        }

        $cats = wp_get_object_terms( $post->ID, $this->taxonomy );

        for( $i = count( $cats ) - 1; $i >= 0; $i--){
            
            $this->getCategory( $cats[$i], true );

        }
    }

    private function getCategory($parent_id, $first = false){

        $cat = get_term( $parent_id, $this->taxonomy, OBJECT, 'raw' );

        if( $cat->parent !== 0 ) {
            $this->getCategory( $cat->parent, true );
        }

        if( $first ){
            $this->set( $cat->name, get_category_link( $cat->term_id ) );
        }
    }
	
	private function set($title, $href = ''){
		if( empty($href) ){
			$this->breadcrumbs .= '<span>' . $title . '</span>';
		}else{
			$this->breadcrumbs .= '<a href="'. $href .'">'. $title .'</a>';
        }
        $this->countBreadcrumb++;
    }

    private function is(){
        global $wp_query;

        if( $wp_query->is_search ){
            $this->set( __( '_Search title', DOMAIN_LANG ) .' "' . get_search_query() . '"');
        }

    }
	
}