<?php
    namespace Project;

    require_once __DIR__ . '/../model/Loan.php';

    class Model {
        public function loan($args): void {
            $method = $args[0];
            $loan = new Loan;
        }
    }