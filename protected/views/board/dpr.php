<div class="row">

    <?php $partaiI = 1; ?>
    <?php foreach ($partais as $partai) : ?>
    <div class="col-xs-12 col-md-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center"><h4><?php echo $partai->id ?></h4></th>
                    <th>
                        <h4>
                            <img height="50" src="<?php echo $partai->url_logo_small ?>" />
                            <?php echo $partai->nama ?>
                        </h4>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                if (isset($calegsGroup[$partai->id])) {
                    $calegs = $calegsGroup[$partai->id];
                } else {
                    $calegs = array();
                }
                ?>
                <?php foreach ($calegs as $caleg) : ?>
                <?php
                $age = Helper::calculateAge($caleg->tanggal_lahir);
                if ($age < 18) {
                    $age = $caleg->tanggal_lahir;
                }
                $caleg->rate = Caleg::getRate(Yii::app()->user->getId(), $caleg->id);
                ?>
                <tr id="caleg-<?php echo $caleg->id ?>" class="caleg" data-id="<?php echo $caleg->id ?>">
                    <td class="text-center">
                        <span class="<?php echo Caleg::isRead(Yii::app()->user->getId(), $caleg->id) ? '' : 'badge unread' ?>">
                            <?php echo $i++; ?>
                        </span>
                    </td>
                    <td>
                        <span 
                            <?php echo ($caleg->rate == 1) ? '' : 'style="display:none"' ?>
                            style="font-size: 15px" class="glyphicon glyphicon-thumbs-up text-info like-info"></span>
                        <?php echo $caleg->nama ?>
                    </td>
                </tr>
                <tr style="display: none">
                    <td colspan="2">
                        <div class="text-center">
                            <img style="width: 75px" src="<?php echo $caleg->foto_url ?>" />
                            <a <?php echo ($caleg->rate == 0) ? '' : 'style="display:none"' ?> alt="Like" class="like-caleg" href="<?php echo Yii::app()->createUrl('caleg/like', array('id' => $caleg->id)); ?>" data-ref="#caleg-<?php echo $caleg->id ?>">
                                <span style="font-size: 15px" class="glyphicon glyphicon-thumbs-up text-info"></span>
                            </a>

                            <a <?php echo ($caleg->rate == 1) ? '' : 'style="display:none"' ?> alt="Unlike" class="unlike-caleg" href="<?php echo Yii::app()->createUrl('caleg/unlike', array('id' => $caleg->id)); ?>" data-ref="#caleg-<?php echo $caleg->id ?>">
                                <span style="font-size: 15px" class="glyphicon glyphicon-thumbs-up text-muted"></span>
                            </a>
                        </div>
                        
                        <span class="label label-info"><?php echo $age; ?> tahun</span>
                        <span class="label label-info"><?php echo Helper::getStandForOfGender($caleg->jenis_kelamin) ?></span>
                        <span class="label label-info"><?php echo $caleg->agama ?></span>
                        <span class="label label-info"><?php echo $caleg->status_perkawinan ?></span>
                        <br/>
                        <br/>
                        <table>
                            <tr>
                                <td>Domisili</td>
                                <td style="padding-left: 3px; font-size: 80%">
                                    <?php
                                    $domisili = "$caleg->kelurahan_tinggal, $caleg->kecamatan_tinggal, $caleg->kab_kota_tinggal";
                                    echo trim($domisili, ', ');
                                    ?>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td>Pendidikan</td>
                                <td class="pendidikan" style="padding-left: 3px; font-size: 80%">
                                    <span class="glyphicon glyphicon-refresh"></span>
                                </td>
                            </tr>
                            <tr>
                                <td>Pekerjaan</td>
                                <td class="pekerjaan" style="padding-left: 3px; font-size: 80%">
                                    <span class="glyphicon glyphicon-refresh"></span>
                                </td>
                            </tr>
                            <tr>
                                <td>Organisasi</td>
                                <td class="organisasi" style="padding-left: 3px; font-size: 80%">
                                    <span class="glyphicon glyphicon-refresh"></span>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php
    if ($partaiI % 3 == 0) {
        echo '<div class="clearfix"></div>';
    }
    $partaiI++;
    ?>
    <?php endforeach; ?>
</div>
