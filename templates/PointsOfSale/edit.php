<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PointsOfSale $pointsOfSale
 */

$this->loadHelper('Form', [
    'templates' => 'materialize_form',
]);

?>

<section class="pointsOfSale index card">
    <div class="card-header">
        <div class="card-icon">
            <i class="fal fa-users"></i>
        </div>

        <h2 class="title"><?= __('Edit Points Of Sale') ?></h2>
    </div>
    
    <div class="card-content">
        <div class="row">
            <div class="col s12 m8 l6 offset-m2 offset-l3">
                
                <?= $this->Form->create($pointsOfSale, ['class' => 'form']) ?>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('phone');
                    echo $this->Form->control('contact');
                    echo $this->Form->control('address');
                    echo $this->Form->control('country_id', ['options' => $countries, 'empty' => true]);
                    echo $this->Form->control('city_id', ['options' => $cities, 'empty' => true]);
                    echo $this->Form->control('customer_id', ['options' => $customers, 'empty' => true]);
                ?>

                <div class="form-submit d-flex jc-end">
                    <?= $this->Html->link(__('Cancel'), ['controller' => 'pointsOfSale', 'action' => 'index'], ['class' => ['btn', 'cancel']]) ?>
                    <?= $this->Form->button(__('Submit'), ['class' => 'btn']) ?>
                </div>

                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function (event) {
    let countriesSelect = document.getElementById('country-id');

    countriesSelect.onchange = function () {
        let country = countriesSelect.value;
        console.log(country);
        getCitiesBycountry(country);
    };

    function clearSelect(selectElement) {
        for (let index = selectElement.options.length - 1; index >= 0 ; index--) {
            selectElement.remove(index);
        }

        console.log(selectElement);
        var instances = M.FormSelect.init(selectElement);
    }

    function updateSelect(selectElement, options) {

        for (let index = 0; index < options.length; index++) {
            let option = options[index];
            let optionElement = document.createElement("option");
            optionElement.text = option.text;
            optionElement.value = option.value;
            selectElement.add(optionElement);
        }

        var instances = M.FormSelect.init(selectElement);
    }

    function getCitiesBycountry(country) {
        let citiesSelect = document.getElementById('city-id');
        
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                cities = JSON.parse(this.response).cities;
                const options = cities.map(function(city) {
                    return {value: city.id, text: city.name};
                })

                const selectElement = document.getElementById('city-id');
                clearSelect(selectElement);
                updateSelect(selectElement, options)
            }
        };
        xhttp.open("GET", "<?= $this->Url->build('/') . 'api/cities/getByCountry/' ?>" + country + ".json", true);
        xhttp.send();
    }
});
</script>