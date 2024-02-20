<?php 

namespace MattForms\App;

use \MattForms\App\Trait\Classes;

class Kernel {

    use Classes;

    public $version;
    public $path;
    public $url;

    public function run() {
        $this->register_controllers();
        $this->enqueue_assets();
    }

    public function __construct( 
        string $plugin_version, 
        string $plugin_text_domain, 
        string $plugin_path, 
        string $plugin_url 
    ) {
        $this->version = $plugin_version;
        $this->text_domain = $plugin_text_domain;
        $this->path = $plugin_path;
        $this->url = $plugin_url;
    }

    /**
     * Registers all the files from app/Controllers/ folder and
     * looking for "actions" method and runs it once it's found
     * 
     * @param void
     * @return void
     */
    protected function register_controllers() {
        $path = $this->path . 'app/Controllers/';
        $namespace = __NAMESPACE__ . '\\Controller\\';

        foreach ( [ 'Admin', 'Front' ] as $part ) {
            $this->init_actions( $path . $part . '/*.php', $namespace . $part . '\\' );
        }
    }

    public function admin_assets() {
        wp_register_script( 'form-builder', $this->url . 'public/assets/admin.min.js', ['jquery'], $this->version, true );
        wp_register_script( 'jquery-ui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.min.js', ['jquery'], '1.12.1', true );

        wp_enqueue_script( 'form-builder' );
        wp_enqueue_script( 'jquery-ui' );

        wp_localize_script( 'form-builder', 'mattforms', [
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce( 'matt_save_form' )
        ] );
    }

    public function front_assets() {
        wp_enqueue_script( 'form-builder', $this->url . 'public/assets/front.min.js', ['jquery'], $this->version, true );
    }

    protected function enqueue_assets() {
        add_action( 'admin_enqueue_scripts', [ $this, 'admin_assets' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'front_assets' ] );
    }
}