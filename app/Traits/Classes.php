<?php 

namespace MattForms\App\Trait;

/**
 * * USED IN KERNEL *
 * 
 * @see wp-content/plugins/mattforms/app/Kernel.php
 */
trait Classes {

    /**
     * Creates an instance of a class found in a directory
     * and runs 'actions' method
     * 
     * @param string $path
     * @param string $namespace
     */
    public function init_actions( $path, $namespace ) {
        $files = glob( $path );
        $mask = str_replace( '*.php', '', $path );

        if ( ! $files ) {
            return;
        }

        foreach ( $files as $file ) {
            $classname = str_replace( '.php', '', $file );
            $classname = str_replace( $mask, '', $classname );
            $classname = $namespace . $classname;

            if ( class_exists( $classname ) && method_exists( $classname, 'actions' ) ) {
                ( new ( $classname ) ( $this ) )->actions();
            }
        }
    }
}