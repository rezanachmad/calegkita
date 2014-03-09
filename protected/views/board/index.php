<?php
/* @var $this BoardController */
/* @var $dapil Dapil */
/* @var $dapils Dapil[] */

$this->pageTitle = Yii::app()->name . ' - Board';
$this->breadcrumbs = array(
    'Board',
);
?>
<h1>My Board</h1>

<div class="row">
    <div class="col-md-2 col-xs-3">
        <h3>Lembaga</h3>
        <ul class="nav nav-stacked">
            <?php foreach ($dapils as $d) : ?>
                <li class="<?php echo ($dapil->lembaga == $d->lembaga) ? 'active' : '' ?>">
                    <a href="<?php echo Yii::app()->createUrl('board/index', array('lembaga' => $d->lembaga)); ?>">
                        <?php echo $d->lembaga ?>
                        <div style="height: 5px; margin-bottom: 5px" class="progress">
                            <div class="progress-bar progress-bar-success dapil-<?php echo $d->id ?>" 
                                 data-count-read="<?php echo $d->count_read ?>"
                                 data-count="<?php echo $d->count ?>"
                                 role="progressbar"
                                 aria-valuenow="<?php echo Helper::calculatePersen($d->count_read, $d->count) ?>" 
                                 aria-valuemin="0" 
                                 aria-valuemax="100" 
                                 style="width: <?php echo Helper::calculatePersen($d->count_read, $d->count) ?>%;">
                            </div>
                        </div>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    
    <div class="col-md-10 col-xs-9">
        <h3>Caleg <?php echo $dapil->lembaga ?> <?php echo $dapil->nama ?></h3>
        <div class="progress">
            <div class="progress-bar progress-bar-success dapil-<?php echo $dapil->id ?>" role="progressbar" 
                 data-count-read="<?php echo $dapil->count_read ?>"
                 data-count="<?php echo $dapil->count ?>"
                 aria-valuenow="<?php echo Helper::calculatePersen($dapil->count_read, $dapil->count) ?>" aria-valuemin="0" aria-valuemax="100" 
                 style="width: <?php echo Helper::calculatePersen($dapil->count_read, $dapil->count) ?>%;">
                
            </div>
        </div>
        <?php $this->renderPartial($view, array('partais' => $partais, 'dapil' => $dapil, 'calegs' => $calegs, 'calegsGroup' => $calegsGroup)); ?>
    </div>
</div>

<script type="text/javascript">
    $('.caleg').on('click', function() {
        var $this = $(this);
        var id = $(this).data('id');
        var detail = $(this).next();
        var dapilClass = 'dapil-<?php echo $dapil->id ?>';
        
        if ($(detail).is(':hidden')) {
            $(detail).show('fast');
            
            // Read!
            var url = '<?php echo Yii::app()->createUrl('caleg/read', array('id' => '_id_')) ?>';
            $.ajax({
                url: url.replace(/_id_/, id),
                success: function(data, textStatus, jqXHR) {
                    if ($this.find('.badge.unread').length > 0 || $this.prev().find('.badge.unread').length > 0) {
                        // update progress
                        var countRead = (+$('.' + dapilClass).attr('data-count-read')) + 1;
                        var count = $('.' + dapilClass).attr('data-count');
                        var percent = Math.ceil(countRead / count * 100);

                        $('.' + dapilClass).attr('data-count-read', countRead);
                        $('.' + dapilClass).attr('aria-valuenow', percent);
                        $('.' + dapilClass).width(percent + '%')
                    }
                    
                    // remove badge
                    $this.find('.badge.unread').attr('class', '');
                    $this.prev().find('.badge.unread').attr('class', '');
                }   
            });
            
            // Load detail!
            if (!$this.hasClass('has-been-load')) {
                $.ajax({
                    url: 'http://api.pemiluapi.org/candidate/api/caleg/' + id + '?apiKey=<?php echo APICaller::API_KEY ?>',
                    success: function (data, textStatus, jqXHR) {
                        $this.addClass('has-been-load');
                        
                        var caleg = data.data.results.caleg[0];
                        var pendidikan = '';
                        var pekerjaan = '';
                        var organisasi = '';
                        
                        for (var i in caleg.riwayat_pendidikan) {
                            pendidikan += (caleg.riwayat_pendidikan[i].ringkasan + '<br />');
                        }
                        for (var i in caleg.riwayat_pekerjaan) {
                            pekerjaan += (caleg.riwayat_pekerjaan[i].ringkasan + '<br />');
                        }
                        for (var i in caleg.riwayat_organisasi) {
                            organisasi += (caleg.riwayat_organisasi[i].ringkasan + '<br />');
                        }
                        
                        var $pendidikan = $(detail).find('.pendidikan');
                        var $pekerjaan = $(detail).find('.pekerjaan');
                        var $organisasi = $(detail).find('.organisasi');
                        
                        if (pendidikan === '') {
                            pendidikan = '-';
                        }
                        if (pekerjaan === '') {
                            pekerjaan = '-';
                        }
                        if (organisasi === '') {
                            organisasi = '-';
                        }
                        
                        $pendidikan.html(pendidikan);
                        $pekerjaan.html(pekerjaan);
                        $organisasi.html(organisasi);
                    }
                });
            }
        } else {
            $(detail).hide();
        }
    });

    $('.caleg-head').on('click', function() {
        $(this).next().click();
    });

    $('.like-caleg').on('click', function(event) {
        event.preventDefault();
        var url = $(this).attr('href');
        var ref = $(this).data('ref');
        
        $.ajax({
            url: url,
            success: function(data, textStatus, jqXHR) {
                $(ref).find('.like-info').show();
                $(ref).next().find('.like-caleg').hide();
                $(ref).next().find('.unlike-caleg').show();
            }
        });
    });
    
    $('.unlike-caleg').on('click', function(event) {
        event.preventDefault();
        var url = $(this).attr('href');
        var ref = $(this).data('ref');
        
        $.ajax({
            url: url,
            success: function(data, textStatus, jqXHR) {
                $(ref).find('.like-info').hide();
                $(ref).next().find('.like-caleg').show();
                $(ref).next().find('.unlike-caleg').hide();
            }
        });
    });
</script>