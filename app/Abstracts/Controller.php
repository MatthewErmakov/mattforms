<?php

namespace MattForms\App\Abstract;

/**
 * Describes behaviour of Controllers
 */
abstract class Controller {

    protected $plugin;

    /**
     * @param \MattForms\App\Kernel $plugin
     */
    public function __construct( \MattForms\App\Kernel $plugin ) {
        $this->plugin = $plugin; 
    }
}