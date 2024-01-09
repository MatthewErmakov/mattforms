<?php 

namespace MattForms\App\Controller\Admin;

use \MattForms\App\Abstract\Controller;
use \MattForms\App\Resource\Admin\AllFormsTable;
use \MattForms\App\Model\Form;
use \MattForms\App\Trait\FormDB;
use \MattForms\App\Trait\TemplateRenderer;

class AllForms extends Controller {

    use TemplateRenderer;
    use FormDB;

    public function __construct( \MattForms\App\Kernel $plugin ) {
        global $wpdb;

        $this->wpdb = $wpdb;
        $this->plugin = $plugin;
    }

    public function renderPage() {
        $form = new Form( "Title333", [ 'field'=>'field' ], 4 );
        
        $this->render( 'admin/all-forms', [
            'admin_page_title' => get_admin_page_title(),

            /**
             * AllFormsTable class extends \WP_List_Table
             * 
             * @see wp-content/plugins/mattforms/app/Resources/Admin/AllFormsTable.php
             */
            'table_view' => $GLOBALS['AllFormsTable']
        ] );
    }

    public function init() {
        $GLOBALS['AllFormsTable'] = new AllFormsTable( $this->plugin, $this->get_forms() );
    }

}