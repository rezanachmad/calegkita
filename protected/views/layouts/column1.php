<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="container">
    <?php echo $content; ?>

    <hr>

    <footer>
        <p><?php echo Yii::app()->name ?> &copy; Company 2014</p>
    </footer>
</div> <!-- /container -->
<?php $this->endContent(); ?>