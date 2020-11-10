import { isEmpty } from "lodash";

export const formValid = (rules) => {
    let valid = true;

    let rulesName = Object.keys(rules);

    rulesName.map((ruleName) => {
        if (rules[ruleName]['isInvalid']) {
            valid = false;
        }
    })

    return valid;
};

export const emailRegex = RegExp(
    /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[A-Z]{2,4}$/i
);

export const numberRegex = RegExp(
    /^[0-9]+$/
);

export const dateRegex = RegExp(
    /^([0-9]{4})-([0-9]{2})-([0-9]{2})$/
) 

export const validate = (rules, value, requestValidation, touched) => {
    let inputName = Object.getOwnPropertyNames(touched)[0];
    let inputNameSanitize = inputName.replace('[]', '')

    // Validate if the field is required and have characters
    if (value !== undefined) { 
        if (rules[inputNameSanitize]['type'] === 'text' || rules[inputNameSanitize]['type'] === 'email' || rules[inputNameSanitize]['type'] === 'numeric' || rules[inputNameSanitize]['type'] === 'url') {

            if (rules[inputNameSanitize]['required'] === true && value.length === 0) {
                rules[inputNameSanitize]['isEmpty'] = true;
                rules[inputNameSanitize]['isInvalid'] = true;
                rules[inputNameSanitize]['message'] = `El campo ${rules[inputNameSanitize]['name']} es requerido.`;
            } else if (rules[inputNameSanitize]['max'] && value.length > rules[inputNameSanitize]['max']) {
                rules[inputNameSanitize]['isEmpty'] = false;
                rules[inputNameSanitize]['isInvalid'] = true;
                rules[inputNameSanitize]['message'] = `El campo ${rules[inputNameSanitize]['name']} debe ser menor a ${rules[inputNameSanitize]['max']} caracteres.`;
            } else if (rules[inputNameSanitize]['type'] === 'email' && !emailRegex.test(value)) {
                rules[inputNameSanitize]['isEmpty'] = false;
                rules[inputNameSanitize]['isInvalid'] = true;
                rules[inputNameSanitize]['message'] = `El formato del ${rules[inputNameSanitize]['name']} es inválido.`;
            } else if (rules[inputNameSanitize]['type'] === 'numeric' && isNaN(Number(value)) && !numberRegex.test(value)) {
                rules[inputNameSanitize]['isEmpty'] = false;
                rules[inputNameSanitize]['isInvalid'] = true;
                rules[inputNameSanitize]['message'] = `El campo ${rules[inputNameSanitize]['name']} debe ser un número.`;
            } else {
                rules[inputNameSanitize]['isEmpty'] = false;
                rules[inputNameSanitize]['isInvalid'] = false;
                rules[inputNameSanitize]['message'] = '';
                requestValidation[inputNameSanitize] = '';
            }
        } else {
            if (rules[inputNameSanitize]['type'] === 'checkbox' && rules[inputNameSanitize]['required'] === true) {
                let inputElements = document.getElementsByName(inputName);
                let countTrues = 0;
                for (var i = 0; i < inputElements.length; i++) {
                    if (inputElements[i].type == 'checkbox') {
                        if (inputElements[i].checked) {
                            countTrues++;
                        }
                    }
                }

                if (countTrues == 0) {
                    rules[inputNameSanitize]['isInvalid'] = true;
                    rules[inputNameSanitize]['isEmpty'] = true;
                    rules[inputNameSanitize]['message'] = `El campo ${rules[inputNameSanitize]['name']} es requerido.`;
                } else if (countTrues > 0) {
                    rules[inputNameSanitize]['isInvalid'] = false;
                    rules[inputNameSanitize]['isEmpty'] = false;
                    rules[inputNameSanitize]['message'] = '';
                    requestValidation[inputNameSanitize] = '';
                }
            } else if (rules[inputNameSanitize]['type'] === 'radio' && value == '') {
                rules[inputNameSanitize]['isEmpty'] = true;
                rules[inputNameSanitize]['isInvalid'] = true;
                rules[inputNameSanitize]['message'] = `El campo ${rules[inputNameSanitize]['name']} es requerido.`;
            } else if (rules[inputNameSanitize]['type'] === 'date') {
                if(isEmpty(value)){
                    rules[inputNameSanitize]['isEmpty'] = true;
                    rules[inputNameSanitize]['isInvalid'] = true;
                    rules[inputNameSanitize]['message'] = `El campo ${rules[inputNameSanitize]['name']} es requerido.`;
                }else if(!dateRegex.test(value) && !isEmpty(value)){
                    rules[inputNameSanitize]['isEmpty'] = false;
                    rules[inputNameSanitize]['isInvalid'] = true;
                    rules[inputNameSanitize]['message'] = `El campo ${rules[inputNameSanitize]['name']} debe ser una fecha.`;
                }else{
                    rules[inputNameSanitize]['isEmpty'] = false;
                    rules[inputNameSanitize]['isInvalid'] = false;
                    rules[inputNameSanitize]['message'] = '';
                }
            } else if(rules[inputNameSanitize]['type']==='file'){
                if(isEmpty(value)){
                    rules[inputNameSanitize]['isEmpty'] = true;
                    rules[inputNameSanitize]['isInvalid'] = true;
                    rules[inputNameSanitize]['message'] = `El campo ${rules[inputNameSanitize]['name']} es requerido.`;
                }else{
                    rules[inputNameSanitize]['isEmpty'] = false;
                    rules[inputNameSanitize]['isInvalid'] = false;
                    rules[inputNameSanitize]['message'] = '';
                }
            } else {
                rules[inputNameSanitize]['isEmpty'] = false;
                rules[inputNameSanitize]['isInvalid'] = false;
                rules[inputNameSanitize]['message'] = '';
                requestValidation[inputNameSanitize] = '';
            }
        }
    }

    return rules;
}