<?php
declare(strict_types=1);
?>

<div class="image-mobile mt-0 pt-0">
    <img src="https://via.placeholder.com/350x300" width="100%">
</div>

<div class="image-desktop mt-0 pt-0">
    <img src="/resources/assets/images/test_image.jpg" width="100%">
</div>

<div class="container page">
    <div class="mt-5 mb-5">
        <h1 class="text-center">Opgericht in 1953</h1>
        <p class="text-center">
            Het Christelijk gemend koor "Wijdt Hem Uw Kunst" uit Harderwijk werd
            opgericht in 1953 en heeft op dit moment 65 leden. Sinds 2018 staat
            het
            koor onder leiding van Marijn de Jong. Daarvoor stond het koor 23
            jaar
            onder leiding van Evert van de Veen. Het koor verleent haar
            medewerking
            aan verschillende zangavonden in Harderwijk en omgeving zoals de
            jaarlijks terugkerende Kerstzangdienst en Paaszangdienst in de Chr.
            Geref. Kerk te Harderwijk. De naam van het koor is ontleend aan het
            tweede vers van Psalm 33: "Wijdt Hem uw kunst". Dit is dan ook de
            doelstelling van het koor. Het koor oefent iedere woensdagavond.
        </p>
    </div>
</div>

<div class="image-mobile m-0 p-0">
    <img src="https://via.placeholder.com/350x300" width="100%">
</div>

<div class="image-desktop m-0 p-0">
    <img src="https://via.placeholder.com/1519x300" width="100%">
</div>

<div class="container page">
    <div class="mt-5 mb-5">
        <h1 class="text-center">Komende concerten in november</h1>

        <?php
        $date = new \App\Support\DateTime(new \Cake\Chronos\Chronos());
        for ($x = 8; $x < 15; $x++) : ?>
            <div class="row event event-border rounded shadow">
                <div class="col-1 pt-2 default-color">
                <span class="h3 font-weight-bold">
                    <?= $x ?>
                </span>
                    <span class="text-uppercase">
                    <?= $date->toShortMonth() ?>
                </span>
                </div>
                <div class="col-11 pt-2">
                    <h5 class="font-weight-bold text-uppercase">
                        Concert in de grote kerk - Kaatsheuvel
                    </h5>

                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <i class="fa fa-calendar-o" aria-hidden="true"></i>
                            Maandag
                        </li>
                        <li class="list-inline-item">
                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                            12:30 uur
                        </li>
                        <li class="list-inline-item">
                            <i class="fas fa-map-marker-alt"
                               aria-hidden="true"></i>
                            Grote kerk
                        </li>
                    </ul>
                </div>
            </div>
        <?php endfor; ?>
    </div>
</div>
