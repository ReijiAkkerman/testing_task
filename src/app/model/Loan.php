<?php
    namespace Project;

    use PHPLoan\Loan as externalLoan;

    // Информация передаваемая клиенту в виде json
    class LoanInfo {
        public $principal;      // стоимость жилья
        public $interests;      // суммарная переплата за пользование кредитом
        public $summary;        // Всего будет оплачено пользователем кредита
        public $income;         // Необходимый доход для получения одобрения на кредитование

        public array $payments;

        public function __construct($principal) {
            $this->principal = $principal;
            $this->interest = 0;
            $this->summary = 0;
            $this->income = 0;
            $this->payments = [];
        }
    }

    // Тип для $payments массива LoanInfo класса
    class Payment {
        public $number;                     // Номер платежа
        public string $date;                // Дата платежа
        public $balance;                    // Остаток долга
        public $principal;                  // В погашение долга
        public $interest;                   // В погашение процентов 
        public $payment;                    // Платеж

        public function __construct($number, $date, $balance, $principal, $interest, $payment) {
            $this->number = $number;
            $this->date = $date;
            $this->balance = $balance;
            $this->principal = $principal;
            $this->interest = $interest;
            $this->payment = $payment;
        }
    }

    class Loan {
        public int $principal;
        public int $first_payment;
        public int $payments_amount;
        public int|float $interest;

        public LoanInfo $data;
        
        private $fields;

        public function __construct() {
            $this->getFieldsNames();
            $this->validateValues();
        }

        public function getLoanInformation(): void{
            $this->payments_amount *= 12; 

            $MROT = 12084;
            $loan = new externalLoan;

            $loanInfo = new LoanInfo($this->principal);

            $date = new \DateTimeImmutable();
            $interval = new \DateInterval('P1M');
            $date = $date->add($interval);

            $delta = $this->principal - $this->first_payment;
            $schedule = $loan->getSchedule($delta, $this->interest, $this->payments_amount);
            foreach($schedule as $row) {
                $row->interest = str_replace(',', '', $row->interest);
                $row->payment = str_replace(',', '', $row->payment);

                $loanInfo->interests += (float)$row->interest;
                $loanInfo->summary += (float)$row->payment;
                $loanInfo->payments[] = new Payment($row->numpayment, $date->format('d.m.o'), $row->balance, $row->principal, $row->interest, $row->payment);
                $date = $date->add($interval);
            }
            $loanInfo->interests = round($loanInfo->interests, 1);
            $loanInfo->summary = round($loanInfo->summary, 1);
            $loanInfo->income = $MROT + round($loanInfo->payments[0]->payment, 1);
            $data = json_encode($loanInfo);
            echo $data;
        }

        // Проверяет наличие неверных символов и исправляет их если это возможно
        private function validateValues(): bool {
            if(!isset($_POST['first_payment'])) $_POST['first_payment'] = '0';
            for($i = 0; $i < sizeof($this->fields); $i++) {
                $prop = $this->fields[$i];
                if(isset($_POST[$this->fields[$i]])) {
                    if($_POST[$this->fields[$i]] == 'interest') {
                        if(preg_match('/[^0-9.]/', $_POST[$this->fields[$i]])) return false;
                        else {
                            if(preg_match('/\./', $_POST[$this->fields[$i]])) $this->$prop = (float)$_POST[$this->fields[$i]];
                            else $this->$prop = (int)$_POST[$this->fields[$i]];
                        }
                    }
                    else {
                        if(preg_match('/[^0-9]/', $_POST[$this->fields[$i]])) return false;
                        else $this->$prop = (int)$_POST[$this->fields[$i]];
                    }
                }
                else return false;
            }
            return true;
        }

        private function getFieldsNames(): void {
            $this->fields = [];
            foreach($_POST as $key => $value) {
                $this->fields[] = $key;
            }
        }
    }