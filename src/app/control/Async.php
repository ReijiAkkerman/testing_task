<?php
    namespace Project;

    require_once __DIR__ . '/../model/Loan.php';

    class Async {
        public function loan($args): void {
            $method = $args[0];
            $loan = new Loan;
            $loan->$method();
        }
    }