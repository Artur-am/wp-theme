<?php 
class GetPosts {
    private $query;
    private $post_type = '';

    private function getCountPosts(){
        if( empty($this->query->query['posts_per_page']) ){
            return get_query_var('posts_per_page');
        }else{
            return absint( $this->query->query['posts_per_page'] );
        }
    }


    public function __construct($args){

        if( is_array($args) ){

            $args['paged'] = get_query_var('paged') ? get_query_var('paged') : 1;
            $this->post_type = $args['post_type'];
            $this->query = new WP_Query( $args );

        }

    }

    public function have_posts(){
        if( isset($this->query) ){
            return $this->query->have_posts();
        }else{
            return have_posts();
        }
    }

    public function the_post(){
        if( isset($this->query) ){
            return $this->query->the_post();
        }else{
            return the_post();
        }
    }

    public function pagination(){
        if( !isset($this->query) ){
            global $wp_query;
            $max = ( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1;
        }else{
            $max = ceil( wp_count_posts( $this->post_type )->publish / $this->getCountPosts() );
        }

        $a['total'] = $max;
        $a['mid_size'] = 3; // сколько ссылок показывать слева и справа от текущей
        $a['end_size'] = 1; // сколько ссылок показывать в начале и в конце
        $a['prev_text'] = '&laquo;'; // текст ссылки "Предыдущая страница"
        $a['next_text'] = '&raquo;'; // текст ссылки "Следующая страница"
        
        return '<div class="pagination v-b-middle">' . paginate_links( $a ) . '</div>';
    }

}
