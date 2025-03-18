<?php

namespace Rtwpvgp\Controllers\Admin; 

use Rtwpvgp\Controllers\Admin\Meta\MetaController;

class AdminController {

    public function __construct() {  
        new MetaController();
        new ScriptLoader(); 
        new AdminFilter(); 
    } 
}