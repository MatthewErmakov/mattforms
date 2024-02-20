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

    public function actions() {
        add_action( 'admin_notices', [ $this, 'admin_notices_output' ] );
    }

    public function renderPage() {
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

    public function admin_notices_output() {
        global $pagenow;
            
        if ( $pagenow == 'admin.php' && isset( $_GET['page'] ) && $_GET['page'] === 'matt_all_forms' ) {
            $message = isset( $_COOKIE['matt_forms_notice'] ) ? $_COOKIE['matt_forms_notice'] : '';
                
            if ( $message !== '' ) {
                echo sprintf( '<div class="notice notice-warning is-dismissible">%s</div>', $message );
            }
        }
    }
}