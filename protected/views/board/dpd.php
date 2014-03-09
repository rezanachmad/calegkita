<div class="row">

    <?php $i = 1; ?>
    <?php foreach ($calegs as $caleg) : ?>
        <?php
        $age = Helper::calculateAge($caleg->tanggal_lahir);
        if ($age < 18) {
            $age = $caleg->tanggal_lahir;
        }
        ?>
        <div class="col-xs-12 col-md-4">
            <table class="table table-bordered">
                <tr class="caleg-head" style="cursor: pointer">
                    <td colspan="2" class="text-left">
                        <h5><span class="<?php echo Caleg::isRead(Yii::app()->user->getId(), $caleg->id) ? '' : 'badge unread' ?>"><?php echo $caleg->urutan ?>. <?php echo $caleg->nama; ?></span></h5>
                    </td>
                </tr>
                <tr class="caleg" data-id="<?php echo $caleg->id ?>">
                    <td>
                        <img width="120" src="<?php echo $caleg->foto_url ?>" />
                    </td>
                    <td>
                        <span class="label label-info"><?php echo $age; ?> tahun</span>
                        <span class="label label-info"><?php echo Helper::getStandForOfGender($caleg->jenis_kelamin) ?></span>
                        <span class="label label-info"><?php echo $caleg->agama ?></span>
                        <span class="label label-info"><?php echo $caleg->status_perkawinan ?></span>
                    </td>
                </tr>
                <tr style="display: none">
                    <td colspan="2">
                        <table>
                             <tr>
                                <td>Domisili</td>
                                <td style="padding-left: 3px; font-size: 80%">
                                    <?php
                                    $domisili = "$caleg->kelurahan_tinggal, $caleg->kecamatan_tinggal, $caleg->kab_kota_tinggal";
                                    echo trim($domisili, ', ');
                                    ?>
                                    <?php // echo $caleg->kelurahan_tinggal ?>, <?php echo $caleg->kecamatan_tinggal ?>, <?php echo $caleg->kab_kota_tinggal ?>
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
            </table>
        </div>
        <?php
        if ($i% 3 == 0) {
            echo '<div class="clearfix"></div>';
        }
        $i++;
        ?>
    <?php endforeach; ?>

</div>