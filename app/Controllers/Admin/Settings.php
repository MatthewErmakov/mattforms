<?php

namespace MattForms\App\Controller\Admin;

use \MattForms\App\Abstract\Controller;

class Settings extends Controller {

    public function actions() {
        add_action( 'admin_menu', [ $this, 'add_pages' ] );
    }

    public function add_pages() {
        $all_forms = new AllForms( $this->plugin );
        $edit_form = new EditForm( $this->plugin );

        $all_forms_hook = add_menu_page( 
            'All forms', 
            'All forms', 
            'edit_others_posts', 
            'matt_all_forms', 
            [ $all_forms, 'renderPage' ], 
            'dashicons-forms', 
            6
        );
        $edit_form_hook = add_submenu_page( 
            'matt_all_forms', 
            'New form', 
            'New form', 
            'edit_others_posts', 
            'matt_edit_form', 
            [ $edit_form, 'renderPage' ], 
            1 
        );

        add_action( "load-$all_forms_hook", [ $all_forms, 'init' ] );
    }
}