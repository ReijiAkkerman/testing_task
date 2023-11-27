<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ипотечный калькулятор</title>
        <link rel="stylesheet" href="../../css/position.css">
        <link rel="stylesheet" href="../../css/style.css">
        <link rel="stylesheet" href="../../css/fonts.css">
        <link rel="stylesheet" href="../../css/loanCalc/position.css">
        <link rel="stylesheet" href="../../css/loanCalc/style.css">
        <link rel="stylesheet" href="../../css/loanCalc/js_position.css">
    </head>
    <body class="loanCalc">
        <h1 class="service_name">Ипотечный калькулятор</h1>
        <h2>Недвижимость</h2>
        <main class="Form">
            <section class="FormInfo">
                <form class="FormInfoInput">
                    <div class="input_area">
                        <p>Стоимость недвижимости</p>
                        <div>
                            <input type="number" name="principal" class="money" step="10000" min="10000" required pattern="[0-9]+" placeholder="Обязательное поле">
                            <p>&#8381</p>
                        </div>
                    </div>
                    <div class="input_area">
                        <p>Первоначальный взнос</p>
                        <div>
                            <input type="number" name="first_payment" class="money" step="10000" min="0" pattern="[0-9]+">
                            <p>&#8381</p>
                        </div>
                        <div>
                            <button>0%</button>
                            <button>10%</button>
                            <button>15%</button>
                            <button>20%</button>
                            <button>25%</button>
                            <button>30%</button>
                        </div>
                    </div>
                    <div class="input_area">
                        <p>Срок кредита</p>
                        <div>
                            <input type="number" name="payments_amount" step="1" min="0" required pattern="[0-9]+" placeholder="Обязательное поле">
                            <p>Лет</p>
                        </div>
                        <div>
                            <button>5 лет</button>
                            <button>10 лет</button>
                            <button>15 лет</button>
                            <button>20 лет</button>
                        </div>
                    </div>
                    <div class="input_area">
                        <p>Процентная ставка</p>
                        <div>
                            <input type="text" name="interest" pattern="[0-9]+([\,]?[0-9]+)?" placeholder="Обязательное поле">
                            <p>%</p>
                        </div>
                        <div>
                            <button>0,1%</button>
                            <button>4,5%</button>
                            <button>6%</button>
                            <button>7%</button>
                            <button>7,5%</button>
                            <button>9,1%</button>
                            <button>10%</button>
                        </div>
                    </div>
                </form>
                <div class="FormInfoOutput">
                    <div class="payment">
                        <div>
                            <p class="money">0 &#8381</p>
                            <p class="comment">Ваш ежемесячный платеж</p>
                        </div>
                        <button>
                            <svg viewBox="0 0 16 16">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.60696 16H11.393C12.037 16 12.5685 16 13.0015 15.9646C13.4511 15.9279 13.8645 15.8491 14.2528 15.6512C14.8549 15.3444 15.3444 14.8549 15.6512 14.2528C15.8491 13.8645 15.9279 13.4511 15.9646 13.0015C16 12.5685 16 12.037 16 11.3931V10.4C16 9.95817 15.6418 9.6 15.2 9.6C14.7582 9.6 14.4 9.95817 14.4 10.4V11.36C14.4 12.0453 14.3994 12.5111 14.37 12.8712C14.3413 13.2219 14.2894 13.4013 14.2256 13.5264C14.0722 13.8274 13.8274 14.0722 13.5264 14.2256C13.4013 14.2894 13.2219 14.3413 12.8712 14.37C12.5111 14.3994 12.0453 14.4 11.36 14.4H4.64C3.95474 14.4 3.4889 14.3994 3.12883 14.37C2.7781 14.3413 2.59874 14.2894 2.47362 14.2256C2.17256 14.0722 1.92779 13.8274 1.77439 13.5264C1.71064 13.4013 1.6587 13.2219 1.63004 12.8712C1.60062 12.5111 1.6 12.0453 1.6 11.36V10.4C1.6 9.95817 1.24183 9.6 0.800001 9.6C0.358173 9.6 7.26503e-07 9.95817 7.26503e-07 10.4L3.45033e-07 11.393C-9.85928e-06 12.037 -1.82509e-05 12.5685 0.0353556 13.0015C0.0720958 13.4511 0.150947 13.8645 0.34878 14.2528C0.655575 14.8549 1.14511 15.3444 1.74723 15.6512C2.1355 15.8491 2.54886 15.9279 2.99854 15.9646C3.4315 16 3.96298 16 4.60696 16ZM7.43432 10.9657C7.74673 11.2781 8.25327 11.2781 8.56569 10.9657L12.5657 6.96568C12.8781 6.65326 12.8781 6.14673 12.5657 5.83431C12.2533 5.52189 11.7467 5.52189 11.4343 5.83431L8.8 8.46863V0.8C8.8 0.358172 8.44183 0 8 0C7.55817 0 7.2 0.358172 7.2 0.8V8.46863L4.56569 5.83431C4.25327 5.52189 3.74673 5.52189 3.43431 5.83431C3.1219 6.14673 3.1219 6.65326 3.43431 6.96568L7.43432 10.9657Z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="credit">
                        <pre>Кредит</pre>
                        <div></div>
                        <pre>0 &#8381</pre>
                    </div>
                    <div class="interest">
                        <pre>Проценты</pre>
                        <div></div>
                        <pre>0 &#8381</pre>
                    </div>
                    <div class="summary">
                        <pre>Проценты + кредит</pre>
                        <div></div>
                        <pre>0 &#8381</pre>
                    </div>
                    <div class="income">
                        <pre>Необходимый доход</pre>
                        <div></div>
                        <pre>0 &#8381</pre>
                    </div>
                    <button class="payments" onclick="loan.calc()">
                        <p>Вывести график платежей</p>
                    </button>
                </div>
            </section>
        </main>
        <section class="Actions">
            <button onclick="loan.download();">Подать заявку онлайн</button>
            <button>Переслать себе на E-mail</button>
        </section>
        <h2>График платежей</h2>
        <section class="Calculation">
            
        </section>
        <script src="../../js/loan.js"></script>
        <template class="CalculationHeader">
            <div class="title">НОМЕР ПЛАТЕЖА</div>
            <div class="title">ДАТА ПЛАТЕЖА</div>
            <div class="title">ОСТАТОК ДОЛГА</div>
            <div class="title">В ПОГАШЕНИЕ ДОЛГА</div>
            <div class="title">В ПОГАШЕНИЕ ПРОЦЕНТОВ</div>
            <div class="title">ПЛАТЕЖ</div>
        </template>
        <template class="CalculationMain">
            <div class="number"></div>
            <div class="payment_date"></div>
            <div class="balance"></div>
            <div class="principal"></div>
            <div class="interest"></div>
            <div class="payment"></div>
        </template>
        <template class="CalculationFooter">
            <div class="summary" id="summary">ВСЕГО</div>
            <div class="summary principal"></div>
            <div class="summary interests"></div>
            <div class="summary payments"></div>
        </template>
    </body>
</html>