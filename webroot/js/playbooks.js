const setSelectOptionDays = (element, input) => {
    element.addEventListener('change', () => {
        const options = element.selectedOptions;
        let selectedOptions = [];
        Array.from(options).forEach(option => {
            selectedOptions.push(option.value);
        });
        document.querySelector(`#${input}`).value = selectedOptions.join(',');
    });
}


document.addEventListener("DOMContentLoaded", function (event) {
    const logicValues = JSON.parse(document.getElementById('logic-values').dataset.value);
    const playlists = JSON.parse(document.getElementById('playlist-values').dataset.value);
    const dayslists = JSON.parse(document.getElementById('days-values').dataset.value);
    const rulesLoad = JSON.parse(document.getElementById('rules-values').dataset.value);

    const addButton = document.getElementById('add-button');
    const removeButton = document.getElementById('remove-button');


    const rulesContainer = document.getElementById('rules');
    let rulesNumber = rulesContainer.children.length;

    if (rulesLoad) {
        rulesLoad.forEach(item => {
            rulesNumber = addComponent(rulesNumber, playlists, logicValues, dayslists, rulesContainer, item);
        });
    }


    removeButton.onclick = function () {
        if (rulesNumber > 0) {
            const lastRuleContainer = rulesContainer.children[rulesContainer.children.length - 1]
            lastRuleContainer.remove();
            rulesNumber--;
        }
    }

    addButton.onclick = function () {
        rulesNumber = addComponent(rulesNumber, playlists, logicValues, dayslists, rulesContainer);
    };

});

function addComponent(rulesNumber, playlists, logicValues, dayslists, rulesContainer, values = {}) {
    console.log(values)
    const ruleContainer = document.createElement("div");
    ruleContainer.setAttribute("id", `rule-${rulesNumber}`);
    ruleContainer.setAttribute("class", "row");

    //ruleContainer.appendChild(createTagInput(rulesNumber));
    ruleContainer.appendChild(createTagSelect(rulesNumber, playlists, values.tag));
    ruleContainer.appendChild(createSelect(rulesNumber, logicValues, values.logic));
    ruleContainer.appendChild(createInputDays(rulesNumber, dayslists, values.days));
    ruleContainer.appendChild(createInputHiddenDays(rulesNumber));
    ruleContainer.appendChild(createInputHour(rulesNumber, 'start_hour', values.start_hour));
    ruleContainer.appendChild(createInputHour(rulesNumber, 'final_hour', values.final_hour));
    ruleContainer.appendChild(createInputOnce(rulesNumber, values.once));
    ruleContainer.appendChild(createInputDate(rulesNumber, values.calendar));

    rulesContainer.appendChild(ruleContainer);
    rulesNumber++;

    var elems = document.querySelectorAll('select');
    M.FormSelect.init(elems, {
        classes: ""
    });

    return rulesNumber;
}

function loadDefaultInputs() {

}





function createTagInput(rulesNumber) {
    const col = document.createElement("div");
    col.setAttribute("class", "col s6");

    const inputContainer = document.createElement("div");
    inputContainer.setAttribute("class", "input-field col s12 text required");

    const input = document.createElement("input");
    input.setAttribute("type", "text");
    input.setAttribute("name", `rules[${rulesNumber}][tag]`);
    input.setAttribute("id", `rules-${rulesNumber}-tag`);

    const label = document.createElement("label");
    label.setAttribute("for", `rules-${rulesNumber}-tag`);
    label.innerText = "Tag";

    inputContainer.appendChild(input);
    inputContainer.appendChild(label);

    col.appendChild(inputContainer);
    return col;
}



function createSelect(rulesNumber, logicValues, value = false) {

    const col = document.createElement("div");
    col.setAttribute("class", "col s6");

    const row = document.createElement("div");
    row.setAttribute("class", "row");

    const selectContainer = document.createElement("div");
    selectContainer.setAttribute("class", "input-field col s12");

    const select = document.createElement("select");
    select.setAttribute("name", "options");
    select.setAttribute("name", `rules[${rulesNumber}][logic]`);
    select.setAttribute("id", `rules-${rulesNumber}-logic`);

    Object.keys(logicValues).forEach(key => {
        const option = document.createElement("option");
        option.setAttribute("value", key);
        option.textContent = logicValues[key];
        select.appendChild(option);
    });

    if (value) {
        select.value = value;
    }

    const label = document.createElement("label");
    label.setAttribute("for", `rules-${rulesNumber}-logic`);
    label.innerText = "Tipo";

    selectContainer.appendChild(select);
    selectContainer.appendChild(label);
    row.appendChild(selectContainer);
    col.appendChild(row);

    return col;
}

function createInputDays(rulesNumber, dayslists, value = false) {

    const col = document.createElement("div");
    col.setAttribute("class", "col s6");

    const row = document.createElement("div");
    row.setAttribute("class", "row");

    const selectContainer = document.createElement("div");
    selectContainer.setAttribute("class", "input-field col s12");

    const select = document.createElement("select");
    select.setAttribute("multiple", 'true');
    select.setAttribute("name", "options");
    select.setAttribute("name", `custom[${rulesNumber}][days]`);
    select.setAttribute("id", `custom-${rulesNumber}-days`);
    select.setAttribute("class", `rules-days`);
    setSelectOptionDays(select, `rules-${rulesNumber}-days`);

    Object.keys(dayslists).forEach(key => {
        const option = document.createElement("option");
        option.setAttribute("value", key);
        option.textContent = dayslists[key];
        select.appendChild(option);
    });

    if (value) {
        var selectedValues = value.split(',');
        for (var i = 0; i < select.options.length; i++) {
            var option = select.options[i];
            option.selected = selectedValues.includes(option.value);
        }
    }

    const label = document.createElement("label");
    label.setAttribute("for", `rules-${rulesNumber}-days`);
    label.innerText = "Días";


    selectContainer.appendChild(select);
    selectContainer.appendChild(label);
    row.appendChild(selectContainer);
    col.appendChild(row);

    return col;
}

function createInputHiddenDays(rulesNumber) {


    const col = document.createElement("div");
    col.setAttribute("class", "col s6");

    const row = document.createElement("div");
    row.setAttribute("class", "row");

    const selectContainer = document.createElement("div");
    selectContainer.setAttribute("class", "input-field col s12");

    const date = document.createElement("input");
    date.setAttribute("name", `rules[${rulesNumber}][days]`);
    date.setAttribute("type", "hidden");
    date.setAttribute("id", `rules-${rulesNumber}-days`);


    selectContainer.appendChild(date);
    row.appendChild(selectContainer);
    col.appendChild(row);

    return col;

}

function createTagSelect(rulesNumber, logicValues, value = false) {
    const col = document.createElement("div");
    col.setAttribute("class", "col s6");

    const row = document.createElement("div");
    row.setAttribute("class", "row");

    const selectContainer = document.createElement("div");
    selectContainer.setAttribute("class", "input-field col s12");

    const select = document.createElement("select");
    select.setAttribute("name", "options");
    select.setAttribute("name", `rules[${rulesNumber}][tag]`);
    select.setAttribute("id", `rules-${rulesNumber}-tag`);


    Object.keys(logicValues).forEach(key => {
        const option = document.createElement("option");
        option.setAttribute("value", key);
        option.textContent = logicValues[key];
        select.appendChild(option);
    });
    if (value) {
        select.value = value;
    }

    const label = document.createElement("label");
    label.setAttribute("for", `rules-${rulesNumber}-tag`);
    label.innerText = "Tag";

    selectContainer.appendChild(select);
    selectContainer.appendChild(label);
    row.appendChild(selectContainer);
    col.appendChild(row);

    return col;
}

function createInputHour(rulesNumber, label, value = false) {

    const col = document.createElement("div");
    col.setAttribute("class", "col s6");

    const row = document.createElement("div");
    row.setAttribute("class", "row");

    const selectContainer = document.createElement("div");
    selectContainer.setAttribute("class", "input-field col s12");

    const date = document.createElement("input");
    date.setAttribute("name", `rules[${rulesNumber}][${label}]`);
    date.setAttribute("type", "text");
    date.setAttribute("id", `rules-${rulesNumber}-${label}`);
    const labelField = document.createElement("label");
    labelField.setAttribute("for", `rules-${rulesNumber}-${label}`);

    if (label == 'start_hour') {
        labelField.innerText = "Hora de inicio";
    }
    else {
        labelField.innerText = "Hora de Fin";
    }

    if (value) {
        date.value = value;
        labelField.setAttribute('class', 'active');
    }



    selectContainer.appendChild(date);
    selectContainer.appendChild(labelField);
    row.appendChild(selectContainer);
    col.appendChild(row);

    return col;
}

function createInputDate(rulesNumber, value = false) {

    const col = document.createElement("div");
    col.setAttribute("class", "col s6");

    const row = document.createElement("div");
    row.setAttribute("class", "row");

    const selectContainer = document.createElement("div");
    selectContainer.setAttribute("class", "input-field col s12");

    const date = document.createElement("input");
    date.setAttribute("name", `rules[${rulesNumber}][calendar]`);
    date.setAttribute("type", "text");
    date.setAttribute("id", `rules-${rulesNumber}-calendar`);

    const labelField = document.createElement("label");
    labelField.setAttribute("for", `rules-${rulesNumber}-calendar`);
    labelField.innerText = "Calendario";

    if (value) {
        date.value = value;
        labelField.setAttribute('class', 'active');
    }

    buildCalendar(date);

    selectContainer.appendChild(date);
    selectContainer.appendChild(labelField);
    row.appendChild(selectContainer);
    col.appendChild(row);

    return col;
}

function createInputOnce(rulesNumber, value = false) {
    const col = document.createElement("div");
    col.setAttribute("class", "col s6");

    const row = document.createElement("div");
    row.setAttribute("class", "row");

    const selectContainer = document.createElement("div");
    selectContainer.setAttribute("class", "input-field col s12 check-custom");

    const date = document.createElement("input");
    date.setAttribute("name", `rules[${rulesNumber}][once]`);
    date.setAttribute("type", "checkbox");
    date.setAttribute("id", `rules-${rulesNumber}-once`);
    if (value) {
        date.value = value;
    }

    const elem2 = document.createElement('label');
    elem2.innerHTML = "Unica canción";

    selectContainer.appendChild(elem2);

    selectContainer.appendChild(date);
    row.appendChild(selectContainer);
    col.appendChild(row);

    return col;
}

function buildCalendar(element) {
    const picker = new LitepickerMin({
        element: element,
        lang: "es-ES",
        firstDay: 1,
        format: "DD/MM/YYYY",
        singleMode: false,
    });
}
