<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
    <div class="container">
        <h2>Membantu Kamu untuk Mengenali Calegmu!</h2>
        <p>
            1. Cukup menggunakan No KTP untuk mengetahui daftar caleg yang akan dipilih<br />
            2. Terdapat learning progress untuk mengetahui sejauh mana kamu telah mengenali calegmu<br />
            3. Tampilan dibuat mirip seperti surat suara agar kamu dapat dengan mudah mengingat caleg pilihanmu<br />
            4. Kamu dapat memasukkan caleg ke daftar favorit dengan cara menekan tombol like<br />
            5. CalegKita akan mengingatkan kamu mengenai calon mana yang belum kamu review<br />
            6. Pada tanggal 9 April 2014 pagi, CalegKita akan mengirimkan email yang berisi daftar caleg favorit kamu
        </p>
        <p><a href="<?php echo Yii::app()->createUrl('register/index') ?>" class="btn btn-primary btn-lg" role="button">Register &raquo;</a></p>
    </div>
</div>

<div class="container">
    <!--
    
    <div class="row">
        <div class="col-md-4">
            <h2>Heading</h2>
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
        <div class="col-md-4">
            <h2>Heading</h2>
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
        <div class="col-md-4">
            <h2>Heading</h2>
            <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
    </div>
    -->

    <hr>

    <footer>
        <p>&copy; <?php echo Yii::app()->name ?> 2014</p>
    </footer>
</div> <!-- /container -->
