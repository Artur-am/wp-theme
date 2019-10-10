<?php

class CPT {
	protected $names;
	protected $name;
	protected $_name;
	protected $slug;
	protected $icon;
	protected $archive;
	protected $public;

	public function __construct($names, $name, $_name, $slug, $icon = 'dashicons-admin-page', $archive = false, $public = true) {
		$this->names = $names;
		$this->name = $name;
		$this->_name = $_name;
		$this->slug = $slug;
		$this->icon = $icon;
		$this->archive = $archive;
		$this->public = $public;
		$this->registration();
	}

	protected function Labels(){
		$name = mb_strtolower($this->name);
		return array( 
			'name'                       => $this->names,
			'singular_name'              => $this->name,
			'all_items'                  => 'Вся ' . $this->_name,
			'edit_item'                  => 'Редактировать ' . $name,
			'add_new'                    => 'Добавить ' . $name,
			'view_item'                  => 'Посмотреть ' . $name,
			'update_item'                => 'Сохранить ' . $name,
			'add_new_item'               => 'Добавить новую ' . $name,
			'new_item_name'              => 'Новая ' . $this->_name,
			'parent_item'                => 'Родительская ' . $this->_name,
			'search_items'               => 'Поиск по ' . mb_strtolower($this->names),
			'popular_items'              => 'Популярные метки',
			'separate_items_with_commas' => 'Список Меток (разделяются запятыми)',
			'add_or_remove_items'        => 'Добавить или удалить метку - 8',
			'choose_from_most_used'      => 'Выбрать метку',
			'not_found'                  => 'Метки не заданы',
			'back_to_items'              => 'Назад на страницу меток',
			'not_found'                  => 'Ничего не найдено',
			'not_found_in_trash'         => 'В корзине ничего не найдено'
		);
	}

	protected function cptArray() {
		return array(
			'labels' 			=> $this->Labels(),
			'public'            => $this->public,
			'supports'          => array( 'title', 'editor', 'thumbnail', 'comments' ),
			'rewrite'           => array( 'slug' => $this->slug ),
			'has_archive'       => $this->archive,
			'hierarchical'      => true,
			'show_in_nav_menus' => true,
			'taxonomies' 		=> array( 'post_tag' ),
			'menu_icon'         => $this->icon
		);
	}
	protected function registration() {
		register_post_type( strtolower($this->slug), $this->cptArray() );
		flush_rewrite_rules();
	}
}

class CPT_Taxonomy {
	protected $names;
	protected $name;
	protected $_name;
	protected $post_type;
	protected $slug;
	protected $public;
	protected $hierarchical;

	public function __construct( $names, $name, $_name, $post_type, $slug, $public, $hierarchical = true ) {
		$this->post_type = $post_type;
		$this->name = $names;
		$this->names = $name;
		$this->_name = $_name;
		$this->slug = $slug;
		$this->public = $public;
		$this->hierarchical = $hierarchical;
		$this->registration();
	}

	protected function Labels(){
		return array(
			'name'                          => $this->names,
			'singular_name'                 => $this->name,
			'search_items'                  => 'Поиск рубрик '.$this->names,
			'popular_items'                 => 'Популярние рубрики '.$this->name,
			'all_items'                     => 'Вся рубрика '.$this->name,
			'parent_item'                   => 'Родительская рубрика '.$this->name,
			'edit_item'                     => 'Изменить рубрику '.$this->name,
			'update_item'                   => 'Обновить рубрику  '.$this->name,
			'add_new_item'                  => 'Добавить новую рубрику'.$this->name,
			'add_or_remove_items'           => 'Add or remove '.$this->name.'s',
			'choose_from_most_used'         => 'Choose from most used '.$this->name.'s'
		);
	}

	protected function taxonomyArray() {
		return array(
			'label'                         => $this->name,
			'labels'                        => $this->Labels(),
			'public'                        => $this->public,
			'hierarchical'                  => $this->hierarchical,
			'show_in_nav_menus'             => true,
			'args'                          => array( 'orderby' => 'term_order' ),
			'query_var'                     => true,
			'show_ui'                       => true,
			'rewrite'                       => true,
			'show_admin_column'             => true
		);
	}
	protected function registration() {
		register_taxonomy(strtolower($this->slug),strtolower($this->post_type),$this->taxonomyArray());
		flush_rewrite_rules();
	}
}