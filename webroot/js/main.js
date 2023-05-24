
document.addEventListener("DOMContentLoaded", function (event) {
    const element = document.querySelectorAll('[visibility]');
    console.log(element)
    if (element.length) {
        element.forEach(e => {
            e.parentElement.parentElement.style.display = "none";
            const visibility = e.getAttribute('visibility');
            if (visibility) {
                const json = JSON.parse(visibility);
                fields = document.querySelectorAll(`[name=${json.field}]`);
                if (fields.length) {
                    fields.forEach(field => {
                        field.addEventListener('change', (event) => {
                            if(event.target.value === json.value) {
                                e.parentElement.parentElement.style.display = "block";
                            }
                            else {
                                e.parentElement.parentElement.style.display = "none";
                            }
                        });
                        if (field.value === json.value){
                            e.parentElement.parentElement.style.display = "block";
                        }
                    })
                }
            }
        })
    }
});
