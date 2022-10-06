<?php


Class view {

    function __construct() {

    }
    public function render() {
        $html = <<<"EOT"
        <div>
        tanga
        </div>
        EOT;
        echo $html;
    }
}