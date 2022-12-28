
document.addEventListener("DOMContentLoaded", function (event) {
    const logicValues = JSON.parse(document.getElementById('logic-values').dataset.value);

    const addButton = document.getElementById('add-button');
    const removeButton = document.getElementById('remove-button');


    const rulesContainer = document.getElementById('rules');
    let rulesNumber = 0;

    removeButton.onclick = function () {
        if (rulesNumber > 0) {
            console.log("Remove")
            const lastRuleContainer = document.getElementById(`rule-${rulesNumber - 1}`);
            lastRuleContainer.remove();
            rulesNumber--;
        }
    }

    addButton.onclick = function () {
        const ruleContainer = document.createElement("div");
        ruleContainer.setAttribute("id", `rule-${rulesNumber}`);
        ruleContainer.setAttribute("class", "row");

        ruleContainer.appendChild(createTagInput(rulesNumber));
        ruleContainer.appendChild(createSelect(rulesNumber, logicValues));

        rulesContainer.appendChild(ruleContainer);
        rulesNumber++;

        var elems = document.querySelectorAll('select');
        M.FormSelect.init(elems, {
            classes: ""
        });
    };
});

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

function createSelect(rulesNumber, logicValues) {

    const col = document.createElement("div");
    col.setAttribute("class", "col s6");

    const selectContainer = document.createElement("div");
    selectContainer.setAttribute("class", "input-field col s12");

    const select = document.createElement("select");
    select.setAttribute("name", "options");
    select.setAttribute("name", `rules[${rulesNumber}][logic]`);
    select.setAttribute("id", `rules-${rulesNumber}-logic`);

    // Create the options for the dropdown
    const option1 = document.createElement("option");
    option1.setAttribute("value", "1");
    option1.textContent = "Option 1";

    Object.keys(logicValues).forEach(key => {
        const option = document.createElement("option");
        option.setAttribute("value", key);
        option.textContent = logicValues[key];
        select.appendChild(option);
    });

    selectContainer.appendChild(select);
    col.appendChild(selectContainer);



    return col;
}
