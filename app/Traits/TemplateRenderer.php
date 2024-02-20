<?php 

namespace MattForms\App\Trait;

/**
 * * USED IN CONTROLLERS *
 */
trait TemplateRenderer {

    /**
     * Renders template view
     * 
     * @param string $template_name
     * @param array $args = []
     * @param bool $output = true
     * 
     * @return void|bool $output
     */
    public function render( $template_name, $args = [], $output = true ) {
        extract( $args );

        ob_start();
        include $this->plugin->path . 'views/' . $template_name . '.php';
        $result = ob_get_clean();

        if ( $output ) {
            print $result;
        } else {
            return $result;
        }
    } 
}