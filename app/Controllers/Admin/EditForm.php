<?php

namespace MattForms\App\Controller\Admin;

use \MattForms\App\Abstract\Controller;
use \MattForms\App\Trait\TemplateRenderer;
use \MattForms\App\Trait\FormDB;
use \MattForms\App\Model\Form;

class EditForm extends Controller {

    use TemplateRenderer;
    use FormDB;

    public function __construct( \MattForms\App\Kernel $plugin ) {
        global $wpdb;

        $this->wpdb = $wpdb;
        $this->plugin = $plugin;
    }

    public function actions() {
        add_action( 'wp_ajax_matt_save_form', [ $this, 'save_form' ] );
        add_action( 'wp_ajax_nopriv_matt_save_form', [ $this, 'save_form' ] );
    }

    public function renderPage() : void {
        $form_id = isset( $_GET['id'] ) ? $_GET['id'] : 0;
        $form = $form_id ? $this->get_form_by_id( $form_id ) : new Form ("", [], 0);
        $author_id = $form->get_author_id();

        $this->render( 'admin/edit-form', [
            'id' => $form_id,
            'title' => $form->get_title(),
            'fields' => $form->get_fields(),
            'author_id' => $author_id === 0 ? get_current_user_id() : $author_id
        ] );
    }

    /**
     * * POST method *
     */
    public function save_form() : void {
        $nonce = isset( $_POST['nonce'] ) ? $_POST['nonce'] : '';
        $result = false;

        if ( ! wp_verify_nonce( $nonce, 'matt_save_form' ) ) {
            wp_send_json( [
                'error' => 'Nonce is not verified'
            ], 403 );
        }

        if ( isset( $_POST['formTitle'] ) && $_POST['formTitle'] !== '' ) {
            $form = new Form(
                $_POST['formTitle'],
                isset( $_POST['fields'] ) ? json_decode( stripslashes( $_POST['fields'] ) ) : [],
                isset( $_POST['authorId'] ) ? intval( $_POST['authorId'] ) : 0,
                date( "Y-m-d H:i:s", time() )
            );

            if ( isset( $_POST['formId'] ) && $_POST['formId'] !== 0 ) {
                $form->set_id( $_POST['formId'] );
            }

            $result = $this->flush( $form ); 
        }

        if ( $result instanceof Form ) {
            wp_send_json( [
                'form_id' => $result->get_id(),
                'action'  => isset( $_POST['formId'] ) && intval( $_POST['formId'] ) === 0 ? 'created' : 'updated',
                'result'  => true
            ], 200 );
        } else {
            wp_send_json( [
                'result'  => false
            ], 200 );
        }
    }
}