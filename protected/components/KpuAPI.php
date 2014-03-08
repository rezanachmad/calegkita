<?php

Yii::import('ext.SimpleHTMLDOM.SimpleHTMLDOM');

/**
 * KpuAPI
 *
 * @author rezanachmad@gmail.com
 */
class KpuAPI {
    
    const SELECTOR = '#theForm > div.fboxbody > .form > .field';
    const TPS_SELECTOR = '#theForm > div.fboxbody > div.formcontainer > div > table > tbody > td';

    public function getDataPemilih($nik) {
        $simpleHTML = new SimpleHTMLDOM;
        $html = $simpleHTML->file_get_html('http://data.kpu.go.id/dps.php?cmd=cari&nik=' . $nik);
        $attrs = array(
            1 => 'nama',
            2 => 'jenis_kelamin',
            3 => 'kelurahan',
            4 => 'kecamatan',
            5 => 'kabupaten',
            6 => 'provinsi',
        );
        
        $result = array();
        $element = $html->find(self::SELECTOR);
        foreach ($attrs as $idx => $attr) {
            if (isset($element[$idx])) {
                $result[$attr] = trim($element[$idx]->plaintext);
            }
        }
        
        // Info TPS
        $element = $html->find(self::TPS_SELECTOR);
        $result['no_tps'] = $element[2]->plaintext;
        $result['alamat_tps'] = $element[5]->plaintext;
        
        return $result;
    }

}
