class Loan {
    validation;

    constructor() {
        this.calc = this.calc.bind(this);
    }

    calc() {
        this.validateFirstPayment();
        if(this.validation) this.validateInterest();
        if(this.validation) {
            let xhr = new XMLHttpRequest();
            let form = document.querySelector('.FormInfoInput');
            let data = new FormData(form);
            xhr.open('POST', '../async/loan/getLoanInformation');
            xhr.send(data);
            xhr.responseType = 'json';
            xhr.onload = () => {
                this.#createTable(xhr);
                this.#completeOutput(xhr);
            };
        }
        else {
            alert('Введите корректные данные');
        }
    }

    download() {

    }

    sendLoanRequest() {
        
    }

    validateFirstPayment() {
        let principal = document.querySelector('.FormInfoInput .input_area [name="principal"]');
        let first_payment = document.querySelector('.FormInfoInput .input_area [name="first_payment"]');
        if(+first_payment.value >= +principal.value) {
            first_payment.style.color = '#f00';
            this.validation = false;
        }
        else {
            first_payment.style.color = '#000';
            this.validation = true;
        }
    }

    validateInterest() {
        let interest = document.querySelector('.FormInfoInput .input_area input[name="interest"]');
        this.validation = /^[0-9]+([\,]?[0-9]+)?$/.test(interest.value);
    }

    pasteFirstPayment(event) {
        let first_payment = document.querySelector('.FormInfoInput .input_area [name="first_payment"]');
        let principal = document.querySelector('.FormInfoInput .input_area [name="principal"]');
        if(+principal.value) {
            let value = (+principal.value * (+this.textContent.split('%')[0] / 100));
            first_payment.value = value; 
        }
        else {
            first_payment.value = 0;
        }
        event.preventDefault();
    }

    pasteTerm(event) {
        let field = document.querySelector('.FormInfoInput .input_area [name="payments_amount"]');
        field.value = this.textContent.split(' ')[0];
        event.preventDefault();
    }

    pasteInterest(event) {
        let field = document.querySelector('.FormInfoInput .input_area [name="interest"]');
        field.value = this.textContent.split('%')[0];
        event.preventDefault();
    }

    inputComplete() {
        let input = document.querySelector(`.FormInfoInput .input_area input[type="range"].${this.name}`);
        input.value = this.value;

        let element = document.querySelector(`.FormInfoInput .input_area div.${this.name}`);
        let delta = (+input.value / +input.max) * 100;
        element.style.width = `${delta}%`;
    }

    sliderComplete() {
        let input = document.querySelector(`.FormInfoInput .input_area input[name="${this.className}"]`);
        input.value = this.value;

        let element = document.querySelector(`.FormInfoInput .input_area div.${this.className}`);
        let delta = (+this.value / this.max) * 100;
        element.style.width = `${delta}%`;
    }

    sliderInit() {
        let array = [
            'principal',
            'first_payment',
            'payments_amount',
            'interest'
        ];
        for(let item of array) {
            let input = document.querySelector(`.FormInfoInput .input_area input[type="range"].${item}`);
            let slider = document.querySelector(`.FormInfoInput .input_area .slider.${item}`);
            let delta = (+input.value / +input.max) * 100;
            slider.style.width = `${delta}%`;
        }
    }

    #completeOutput(xhr) {
        let obj = {
            credit: "principal",
            interest: "interests",
            summary: "summary",
            income: "income"
        }
        let element;
        for(let key in obj) {
            element = document.querySelector(`.FormInfoOutput .${key} pre:last-of-type`);
            let value = String(xhr.response[`${obj[key]}`]);
            let text = this.#separateString(value);
            element.textContent = text;
        }

        element = document.querySelector('.FormInfoOutput .money');
        let value = String(xhr.response['payments'][0]['payment']);
        let text = this.#separateString(value);
        element.textContent = text;
    }

    #createTable(xhr) {
        let title = document.querySelector('.loanCalc h2:last-of-type');
        title.style.display = 'block';

        let insert_place = document.querySelector('.Calculation');
        insert_place.innerHTML = '';

        let template = document.querySelector('.CalculationHeader');
        let table_header = template.content.cloneNode(true);
        insert_place.append(table_header);

        for(let i = 0; i < xhr.response['payments'].length; i++) {
            template = document.querySelector('.CalculationMain');
            let content = template.content.cloneNode(true);
            content.querySelector('.number').append(xhr.response['payments'][i]['number']);
            content.querySelector('.payment_date').append(xhr.response['payments'][i]['date']);
            content.querySelector('.balance').append(xhr.response['payments'][i]['balance']);
            content.querySelector('.principal').append(xhr.response['payments'][i]['principal']);
            content.querySelector('.interest').append(xhr.response['payments'][i]['interest']);
            content.querySelector('.payment').append(xhr.response['payments'][i]['payment']);
            insert_place.append(content);
        }

        template = document.querySelector('.CalculationFooter');
        let table_footer = template.content.cloneNode(true);
        table_footer.querySelector('.principal').append(xhr.response['principal']);
        table_footer.querySelector('.interests').append(xhr.response['interests']);
        table_footer.querySelector('.payments').append(xhr.response['summary']);
        insert_place.append(table_footer);
    }

    #separateString(value) {
        let sign = ' ₽';
        if(/\./.test(value)) {
            value = value.replace('.', ',');
            let array = value.split(',');
            let integer = array[0];
            let fraction = array[1];
            let number_array = [];
            for(let i = integer.length; i > 0; i -= 3) {
                if(i - 3 < 0) {
                    number_array.push(integer.slice(0, i));
                }
                else {
                    number_array.push(integer.slice(i - 3, i));
                }
            }
            let text = '';
            for(let i = number_array.length - 1; i >= 0; i--) {
                if(i == number_array.length - 1) {
                    text += number_array[i];
                }
                else {
                    text += ' ' + number_array[i];
                }
            }
            text += ',' + fraction + sign;
            return text;
        }
        else {
            let number_array = [];
            for(let i = value.length; i > 0; i -= 3) {
                if(i - 3 < 0) {
                    number_array.push(value.slice(0, i));
                }
                else {
                    number_array.push(value.slice(i - 3, i));
                }
            }
            let text = '';
            for(let i = number_array.length - 1; i >= 0; i--) {
                if(i == number_array.length - 1) {
                    text += number_array[i];
                }
                else {
                    text += ' ' + number_array[i];
                }
            }
            text += sign;
            return text;
        }
    }
}

var loan = new Loan;

document.addEventListener('DOMContentLoaded', function() {
    let elements = document.querySelectorAll('.FormInfoInput .input_area:nth-of-type(2) button');
    elements.forEach((element) => {
        element.addEventListener('click', loan.pasteFirstPayment);
    });

    elements = document.querySelectorAll('.FormInfoInput .input_area:nth-of-type(3) button');
    elements.forEach((element) => {
        element.addEventListener('click', loan.pasteTerm);
    });

    elements = document.querySelectorAll('.FormInfoInput .input_area:nth-of-type(4) button');
    elements.forEach((element) => {
        element.addEventListener('click', loan.pasteInterest);
    });

    elements = document.querySelectorAll('.FormInfoInput .input_area input[pattern]');
    elements.forEach((element) => {
        element.addEventListener('input', loan.inputComplete);
    });

    elements = document.querySelectorAll('.FormInfoInput .input_area input[type="range"]');
    elements.forEach((element) => {
        element.addEventListener('input', loan.sliderComplete);
    });

    let element = document.querySelector('.FormInfoInput .input_area input[name="first_payment"]');
    element.addEventListener('input', loan.validateFirstPayment);

    element = document.querySelector('.FormInfoInput .input_area input[name="principal"]');
    element.addEventListener('input', loan.validateFirstPayment);

    element = document.querySelector('.FormInfoInput .input_area input[type="range"].first_payment');
    element.addEventListener('input', loan.validateFirstPayment);

    element = document.querySelector('.FormInfoInput .input_area input[type="range"].principal');
    element.addEventListener('input', loan.validateFirstPayment);

    loan.sliderInit();
});