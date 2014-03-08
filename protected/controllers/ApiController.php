<?php

/**
 * APIController
 *
 * @author rezanachmad@gmail.com
 */
class ApiController extends Controller {

    public function actionGetAddress($nik) {
        $api = new KpuAPI();
        $pemilih = $api->getDataPemilih($nik);
        echo
        $pemilih['kelurahan'] . ', ' .
        $pemilih['kecamatan'] . ', ' .
        $pemilih['kabupaten'] . ', ' .
        $pemilih['provinsi'];
    }

}
