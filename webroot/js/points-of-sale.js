document.addEventListener("DOMContentLoaded", function(event) {
    var countriesSelect = document.getElementById('country-id');

    countriesSelect.onchange = function() {
        var country = countriesSelect.value;
        console.log(country);
    };
});