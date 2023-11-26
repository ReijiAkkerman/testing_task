class Loan {
    calc() {
        let xhr = new XMLHttpRequest();
        let form = document.querySelector('.FormInfoInput');
        let data = new FormData(form);
        xhr.open('POST', '../async/loan/getLoanInformation');
        xhr.send(data);
        xhr.responseType = 'json';
        xhr.onload = () => {
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
        };
    }

    download() {

    }

    sendLoanRequest() {

    }
}

var loan = new Loan;