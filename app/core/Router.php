<?php
    namespace Project;

    require_once __DIR__ . '/../control/View.php';
    require_once __DIR__ . '/../control/Async.php';

    class Router {
        public array $URI;
        public string $controller;
        public string $method;
        public array $args;

        public function action(): void {
            if($this->controller && $this->method) $this->args ?
                (new $this->controller)->{$this->method}($this->args) :
                (new $this->controller)->{$this->method}();
            else header('Location: view/loanCalc');
        }

        public function __construct() {
            $this->getURI();
            $this->processURI();
        }

        private function getURI(): void {
            if($_GET) {
                $array = explode('?', $_SERVER['REQUEST_URI']);
                $controls = explode('/', $array[0]);
                $this->URI = $controls;
            }
            else $this->URI = explode('/', $_SERVER['REQUEST_URI']);
        }

        private function processURI(): void {
            if(!$this->URI[1]) {
                header('Location: view/loanCalc');
                exit;
            }
            $controllerPart = file_exists(__DIR__ . '/../control/' . ucfirst($this->URI[1]) . '.php') ? $this->URI[1] : 'view';
            $methodPart = method_exists('Project\\' . ucfirst($controllerPart), $this->URI[2]) ? $this->URI[2] : 'error';
            $counterPart = count($this->URI);
            $argsPart = [];
            for($i = 3; $i < $counterPart; $i++) $argsPart[] = $this->URI[$i];

            $this->controller = !empty($controllerPart) ? 'Project\\' . ucfirst($controllerPart) : '';
            $this->method = !empty($methodPart) ? $methodPart : '';
            $this->args = !empty($argsPart) ? $argsPart : [];
        }
    }