<?php

class Application {

    private $controller = null;

    private $params = array();

    private $controller_name;

    private $action_name;

    public function __construct() {
        $this->splitUrl();
        if (!$this->controller_name) {
            require(APP . 'controller/LoginController.php');
            $page = new LoginController();
            $page->index();
        } else {
            if (file_exists(APP . 'controller/' . $this->controller_name . '.php')) {
                require(APP . 'controller/' . $this->controller_name . '.php');
                $this->controller = new $this->controller_name();
                if (method_exists($this->controller, $this->action_name)) {
                    if (!empty($this->parameters)) {
                        call_user_func_array(array($this->controller, $this->action_name), $this->parameters);
                    } else {
                        $this->controller->{$this->action_name}();
                    }
                } else {
                    require(APP . 'controller/ErrorController.php');
                    $this->controller = new ErrorController;
                    $this->controller->error404();
                }
            } else {
                require(APP . 'controller/ErrorController.php');
                $this->controller = new ErrorController;
                $this->controller->error404();
            }
        }
    }

    private function splitUrl()
    {
        if (isset($_GET['url'])) {
            // split URL
            $url = trim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            // put URL parts into according properties
            $this->controller_name = isset($url[0]) ? $url[0] : null;
            $this->action_name = isset($url[1]) ? $url[1] : 'index';
            // remove controller name and action name from the split URL
            unset($url[0], $url[1]);
            // rebase array keys and store the URL parameters
            $this->parameters = array_values($url);
        }
    }
}
?>