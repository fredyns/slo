<?php

/* @var $this yii\web\View */

$this->title = Yii::$app->name;
?>
<style>
    #callcenter a {
        font-family: monospace;
        font-size: 1.2em;
        font-weight: bold;
    }
</style>
<div class="site-index">

    <div class="row">
        <div id="callcenter" class="col-lg-4 pull-right well">
            <b>Call Center:</b> <br/>
            <!-- <a href="https://wa.me/6282112596503?text=Hallo%20VGM" target="_blank">+62 821-1259-6503</a> (Telp, SMS)<br/> -->
            <a href="" >+62 21 430 10 17</a> (Telp)<br/>
            <a href="" >+62 21 430 17 03</a> (Telp)<br/>
            <a href="" >+62 21 4393 70 21</a> (Telp)<br/>
            <a href="" >+62 21 435 32 91</a> (Telp)<br/>
            <a href="mailto: eni@bki.co.id">eni@bki.co.id</a>
        </div>
    </div>

    <div class="jumbotron">
        <h1>
            <?= Yii::$app->name; ?>
        </h1>

        <p class="lead">
            <?= Yii::$app->params['appTitle']; ?>
        </p>

    </div>


    <br/>
    <br/>
    <br/>


    <div class="body-content">

        <div class="row">
            <div class="col-lg-6">
                <h2>What is SLO?</h2>

                <p>
                    Aplikasi Sistem Registrasi Sertifikat Laik Operasi(SLO) Online bagi lembaga Inspeksi teknik (LIT) Penunjkan Mentri ESDM.
                </p>

                <p>

                </p>

            </div>

            <div class="col-lg-6">
                <h2>Ind. Classification Bureau</h2>

                <p>
                    Indonesian Classification Bureau (BKI) was established on July 1, 1964 and remained the only national classification bureau appointed by the government of the Republic of Indonesia to give class of Indonesian-flagged vessels. This task was then legalized in the Decree of Minister of  Sea Transportation No. Th. 1/17/2, dated September 26, 1964, relating Manual of for Indonesian flagged vessel to have a classification certificate from BKI. Vessel classification is an activity to give class of vessel based on hull construction, machinery, and electricity, with the goal to asses weather a vessel is merit to sail.
                </p>

            </div>
        </div>

    </div>
</div>