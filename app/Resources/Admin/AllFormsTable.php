<?php

namespace MattForms\App\Resource\Admin;

/**
 * All forms table class on 'All forms' page
 * generating all the rows with existing content
 */
class AllFormsTable extends \WP_List_Table {

	protected $plugin;
	protected $forms;

	public function __construct( \MattForms\App\Kernel $plugin, array $forms ){
		parent::__construct( array(
			'singular' => 'log',
			'plural'   => 'logs',
			'ajax'     => false,
		) );

		$this->plugin = $plugin;
		$this->forms = $forms;

		$this->bulk_action_handler();

		// screen option
		add_screen_option( 'per_page', array(
			'label'   => 'Forms per page',
			'default' => 20,
			'option'  => 'logs_per_page',
		) );

		$this->prepare_items();

		add_action( 'wp_print_scripts', [ __CLASS__, '_list_table_css' ] );
	}

	// создает элементы таблицы
	public function prepare_items(){
		global $wpdb;

		// пагинация
		$per_page = get_user_meta( get_current_user_id(), get_current_screen()->get_option( 'per_page', 'option' ), true ) ?: 20;

		$this->set_pagination_args( array(
			'total_items' => 3,
			'per_page'    => $per_page,
		) );
		$cur_page = (int) $this->get_pagenum(); // желательно после set_pagination_args()
		
		if( is_array( $this->forms ) ) {
			foreach ( $this->forms as $item ) {
				$author = $item->get_author();
				$form_id = $item->get_id();

				$this->items[] = (object) [
					'id' => $form_id,
					'title' => $item->get_title(),
					'shortcode' => sprintf( '[mattform id="%d"]', $form_id ),
					'fields_quantity' => count( $item->get_fields() ),
					'author' => [
						'url'  => get_edit_user_link( $author->ID ), 
						'name' => property_exists( $author->data, 'display_name' ) ? $author->data->display_name : ''
					],
					'modified_at' => $item->get_modified_at()
				]; 
			}
		}

	}

	// колонки таблицы
	public function get_columns(){
		return array(
			'cb'              => '<input type="checkbox" />',
			'id'              => 'ID',
			'title'           => 'Title',
			'shortcode'       => 'Shortcode',
			'fields_quantity' => 'Fields quantity',
			'author' 	      => 'Author',
			'modified_at'	  => 'Modified at'
		);
	}

	// сортируемые колонки
	public function get_sortable_columns(){
		return array(
			'form_name' => array( 'name', 'desc' ),
			'date' => array( 'name', 'desc' ),
		);
	}

	protected function get_bulk_actions() {
		return array(
			'delete' => 'Delete',
		);
	}

	// вывод каждой ячейки таблицы -------------

	public static function _list_table_css(){
		?>
		<style>
			table.logs .column-id{ width:2em; }
			table.logs .column-shortcode{ width:20em; }
			table.logs .column-shortcode input{ display: block; width: 100%; background: white }
			table.logs .column-title{ width:15%; }
		</style>
		<?php
	}

	// вывод каждой ячейки таблицы...
	public function column_default( $item, $colname ){

		if( $colname === 'title' ){
			// ссылки действия над элементом
			$actions = [
				'edit'     => sprintf( '<a href="?page=matt_edit_form&id=%d">%s</a>', $item->id ,     __( 'Edit', $this->plugin->text_domain ) ),
				'invoices' => sprintf( '<a href="?matt_form_invoices=%d">%s (%d)</a>', $item->id, __( 'Invoices', $this->plugin->text_domain ), $item->id ),
				'trash'    => sprintf( '<a href="?matt_form_delete=%d">%s</a>', $item->id ,  __( 'Delete', $this->plugin->text_domain ) )
			];

			return sprintf( '<a href="?page=matt_edit_form&id=%d">%s</a>', $item->id, esc_html( $item->title ) ) . $this->row_actions( $actions );
		} 
		
		else if ( $colname === 'shortcode' ) {
			return '<input type="text" class="shortcode_input" value="' . esc_attr( $item->shortcode ) . '" readonly>';
		} 
		
		else if( $colname === 'author' ) {
			return sprintf( '<a href="%s">%s</a>', $item->author['url'], $item->author['name'] );
		} 
		
		else {
			return isset($item->$colname) ? $item->$colname : print_r($item, 1);
		}

	}

	// заполнение колонки cb
	public function column_cb( $item ){
		echo '<input type="checkbox" name="licids[]" id="cb-select-'. $item->id .'" value="'. $item->id .'" />';
	}

	// остальные методы, в частности вывод каждой ячейки таблицы...

	// helpers -------------

	private function bulk_action_handler(){
		if( empty($_POST['licids']) || empty($_POST['_wpnonce']) ) return;

		if ( ! $action = $this->current_action() ) return;

		if( ! wp_verify_nonce( $_POST['_wpnonce'], 'bulk-' . $this->_args['plural'] ) )
			wp_die('nonce error');

		// делает что-то...
		die( $action ); // delete
		die( print_r($_POST['licids']) );

	}

	/*
	// Пример создания действий - ссылок в основной ячейки таблицы при наведении на ряд.
	// Однако гораздо удобнее указать их напрямую при выводе ячейки - см ячейку customer_name...

	// основная колонка в которой будут показываться действия с элементом
	protected function get_default_primary_column_name() {
		return 'disp_name';
	}

	// действия над элементом для основной колонки (ссылки)
	protected function handle_row_actions( $post, $column_name, $primary ) {
		if ( $primary !== $column_name ) return ''; // только для одной ячейки

		$actions = array();

		$actions['edit'] = sprintf( '<a href="%s">%s</a>', '#', __('edit','hb-users') );

		return $this->row_actions( $actions );
	}
	*/

}