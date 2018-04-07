<?php

class View {

    public function render($file_name) {
        require(APP . 'view/'
        . (
            isset($_SESSION['UROLE'])
            ? ($_SESSION['UROLE'] . '/') 
            : ''
        ) . 
        'header.php');
        require(APP . 'view/'
        . (
            isset($_SESSION['UROLE']) && $file_name != 'error/404'
            ? ($_SESSION['UROLE'] . '/' . $file_name) 
            : $file_name
        ) . '.php');
        require(APP . 'view/'
        . (
            isset($_SESSION['UROLE']) 
            ? ($_SESSION['UROLE'] . '/') 
            : ''
        ) . 
        'footer.php');
    }
}
?>