<?php 

namespace MattForms\App\Controller\Front;

use \MattForms\App\Abstract\Controller;
use \MattForms\App\Trait\FormDB;
use \MattForms\App\Trait\TemplateRenderer;

class Shortcode extends Controller {

    use FormDB;
    use TemplateRenderer;

    // init all actions
    public function actions() {
        add_shortcode( 'mattform', [ $this, 'renderTemplate' ] );
    }

    public function renderTemplate( array $atts = [] ) : string {
        $form_id = isset( $atts['id'] ) ? $atts['id'] : 0;
        $style = isset( $atts['style'] ) ? $atts['style'] : '';
        $form = $this->get_form_by_id( $form_id );

        if ( ! is_null( $form ) && $form->get_id() !== 0 && $style !== '' ) {
            return $this->render( "front/templates/{$style}", [
                'title' => $form->get_title(),
                'fields' => $this->renderFormFields( $form->get_fields() )
            ], false );
        }

        return '';
    }

    protected function renderFormFields( array $fields ) : string {
        $output = '';

        if ( ! empty ( $fields ) && is_array( $fields ) ) {
            foreach( $fields as $field ) {
                switch( $field->type ) {

                    case 'text':
                        $output .= $this->render( 'front/partials/text', [
                            'type' => property_exists( $field, 'type' ) ? $field->type : '',
                            'label' => property_exists( $field, 'label' ) ? $field->label : '',
                            'required' => property_exists( $field, 'required' ) ? $field->required : '',
                            'description' => property_exists( $field, 'description' ) ? $field->description : '',
                            'placeholder' => property_exists( $field, 'placeholder' ) ? $field->placeholder : '',
                            'class_name' => property_exists( $field, 'className' ) ? $field->className : '',
                            'name' => property_exists( $field, 'name' ) ? $field->name : '',
                            'access' => property_exists( $field, 'access' ) ? $field->access : '',
                            'subtype' => property_exists( $field, 'subtype' ) ? $field->subtype : '',
                            'max_length' => property_exists( $field, 'maxLength' ) ? $field->maxLength : ''
                        ], false );
                        break;

                    case 'number':
                        $output .= $this->render( 'front/partials/number', [
                            'type' => property_exists( $field, 'type' ) ? $field->type : '',
                            'label' => property_exists( $field, 'label' ) ? $field->label : '',
                            'required' => property_exists( $field, 'required' ) ? $field->required : '',
                            'description' => property_exists( $field, 'description' ) ? $field->description : '',
                            'placeholder' => property_exists( $field, 'placeholder' ) ? $field->placeholder : '',
                            'class_name' => property_exists( $field, 'className' ) ? $field->className : '',
                            'name' => property_exists( $field, 'name' ) ? $field->name : '',
                            'access' => property_exists( $field, 'access' ) ? $field->access : '',
                            'subtype' => property_exists( $field, 'subtype' ) ? $field->subtype : '',
                            'min' => property_exists( $field, 'min' ) ? $field->min : '',
                            'max' => property_exists( $field, 'max' ) ? $field->max : '',
                            'length' => property_exists( $field, 'length' ) ? $field->length : '',
                        ], false );
                        break;

                    case 'paragraph':
                        $output .= $this->render( 'front/partials/paragraph', [
                            'subtype' => property_exists( $field, 'subtype' ) ? $field->subtype : '',
                            'label' => property_exists( $field, 'label' ) ? $field->label : '',
                            'class_name' => property_exists( $field, 'className' ) ? $field->className : '',
                            'access' => property_exists( $field, 'access' ) ? $field->access : ''
                        ], false );
                        break;

                    case 'hidden':
                        $output .= $this->render( 'front/partials/hidden', [
                            'name' => property_exists( $field, 'name' ) ? $field->name : '',
                            'value' => property_exists( $field, 'value' ) ? $field->value : '',
                            'access' => property_exists( $field, 'access' ) ? $field->access : ''
                        ], false );
                        break;

                    case 'file':
                        $output .= $this->render( 'front/partials/file', [
                            'required' => property_exists( $field, 'required' ) ? $field->required : '',
                            'label' => property_exists( $field, 'label' ) ? $field->label : '',
                            'class_name' => property_exists( $field, 'className' ) ? $field->className : '',
                            'name' => property_exists( $field, 'name' ) ? $field->name : '',
                            'description' => property_exists( $field, 'description' ) ? $field->description : '',
                            'placeholder' => property_exists( $field, 'placeholder' ) ? $field->placeholder : '',
                            'multiple' => property_exists( $field, 'multiple' ) ? $field->multiple : '',
                            'access' => property_exists( $field, 'access' ) ? $field->access : '',
                            'multiple' => property_exists( $field, 'multiple' ) ? $field->multiple : ''
                        ], false );
                        break;

                    case 'radio-group':
                        $output .= $this->render( 'front/partials/radio', [
                            'required' => property_exists( $field, 'required' ) ? $field->required : '',
                            'label' => property_exists( $field, 'label' ) ? $field->label : '',
                            'class_name' => property_exists( $field, 'className' ) ? $field->className : '',
                            'name' => property_exists( $field, 'name' ) ? $field->name : '',
                            'access' => property_exists( $field, 'access' ) ? $field->access : '',
                            'values' => property_exists( $field, 'values' ) ? $field->values : ''
                        ], false );
                        break;

                    case 'checkbox-group':
                        $output .= $this->render( 'front/partials/checkbox', [
                            'required' => property_exists( $field, 'required' ) ? $field->required : '',
                            'label' => property_exists( $field, 'label' ) ? $field->label : '',
                            'description' => property_exists( $field, 'description' ) ? $field->description : '',
                            'toggle' => property_exists( $field, 'toggle' ) ? $field->toggle : '',
                            'inline' => property_exists( $field, 'inline' ) ? $field->inline : '',
                            'class_name' => property_exists( $field, 'className' ) ? $field->className : '',
                            'name' => property_exists( $field, 'name' ) ? $field->name : '',
                            'access' => property_exists( $field, 'access' ) ? $field->access : '',
                            'other' => property_exists( $field, 'other' ) ? $field->other : '',
                            'values' => property_exists( $field, 'values' ) ? $field->values : ''
                        ], false );
                        break;

                    case 'textarea':
                        $output .= $this->render( 'front/partials/textarea', [
                            'required' => property_exists( $field, 'required' ) ? $field->required : '',
                            'label' => property_exists( $field, 'label' ) ? $field->label : '',
                            'description' => property_exists( $field, 'description' ) ? $field->description : '',
                            'placeholder' => property_exists( $field, 'placeholder' ) ? $field->placeholder : '',
                            'class_name' => property_exists( $field, 'className' ) ? $field->className : '',
                            'name' => property_exists( $field, 'name' ) ? $field->name : '',
                            'access' => property_exists( $field, 'access' ) ? $field->access : '',
                            'value' => property_exists( $field, 'value' ) ? $field->value : '',
                            'max' => property_exists( $field, 'maxlength' ) ? $field->maxlength : '',
                            'rows' => property_exists( $field, 'rows' ) ? $field->rows : ''
                        ], false );
                        break;

                    case 'select':
                        $output .= $this->render( 'front/partials/select', [
                            'required' => property_exists( $field, 'required' ) ? $field->required : '',
                            'label' => property_exists( $field, 'label' ) ? $field->label : '',
                            'class_name' => property_exists( $field, 'className' ) ? $field->className : '',
                            'name' => property_exists( $field, 'name' ) ? $field->name : '',
                            'access' => property_exists( $field, 'access' ) ? $field->access : '',
                            'multiple' => property_exists( $field, 'multiple' ) ? $field->multiple : '',
                            'values' => property_exists( $field, 'values' ) ? $field->values : ''
                        ], false ); 
                        break;

                    case 'button':
                        $output .= $this->render( 'front/partials/button', [
                            'required' => property_exists( $field, 'required' ) ? $field->required : '',
                            'subtype' => property_exists( $field, 'subtype' ) ? $field->subtype : '',
                            'label' => property_exists( $field, 'label' ) ? $field->label : '',
                            'class_name' => property_exists( $field, 'className' ) ? $field->className : '',
                            'name' => property_exists( $field, 'name' ) ? $field->name : '',
                            'access' => property_exists( $field, 'access' ) ? $field->access : '',
                            'multiple' => property_exists( $field, 'multiple' ) ? $field->multiple : '',
                            'value' => property_exists( $field, 'value' ) ? $field->value : ''
                        ], false ); 
                        break;

                    case 'header':
                        $output .= $this->render( 'front/partials/header', [
                            'label' => property_exists( $field, 'label' ) ? $field->label : '',
                            'subtype' => property_exists( $field, 'subtype' ) ? $field->subtype : '',
                            'class_name' => property_exists( $field, 'className' ) ? $field->className : '',
                        ], false ); 
                        break;
                    case 'date':
                        $output .= $this->render( 'front/partials/date', [
                            'type' => property_exists( $field, 'type' ) ? $field->type : '',
                            'label' => property_exists( $field, 'label' ) ? $field->label : '',
                            'required' => property_exists( $field, 'required' ) ? $field->required : '',
                            'description' => property_exists( $field, 'description' ) ? $field->description : '',
                            'placeholder' => property_exists( $field, 'placeholder' ) ? $field->placeholder : '',
                            'class_name' => property_exists( $field, 'className' ) ? $field->className : '',
                            'name' => property_exists( $field, 'name' ) ? $field->name : '',
                            'access' => property_exists( $field, 'access' ) ? $field->access : '',
                            'subtype' => property_exists( $field, 'subtype' ) ? $field->subtype : '',
                            'min' => property_exists( $field, 'min' ) ? $field->min : '',
                            'max' => property_exists( $field, 'max' ) ? $field->max : '',
                            'length' => property_exists( $field, 'length' ) ? $field->length : '',
                        ], false );
                        break;

                    default:
                        $output .= sprintf( '<div class="%s">%s</div>', 'warning', 'Unrecognized element' );
                        break;                        
                    
                }
            }
        }

        return $output;
    }
}