<?php

/**
 * Description of Helper
 *
 * @author Rezan Achmad <rezanachmad@gmail.com>
 */
class Helper {

    /**
     * Hash data with SHA256 algorithm
     * @param string $data
     * @return string
     */
    public static function hash($data) {
        return hash('sha256', $data);
    }

    /**
     * @return string Current timestamp
     */
    public static function timestamp() {
        return date('Y-m-d H:i:s');
    }
    
    public static function calculateAge($date) {
        $currentYear = date('Y');
        $year = date('Y', strtotime($date));
        $age = $currentYear - $year;
        return $age;
    }
    
    public static function getStandForOfGender($gender) {
        $data = array(
            'L' => 'Laki-laki',
            'P' => 'Perempuan',
        );
        
        if (isset($data[$gender])) {
            return $data[$gender];
        } else {
            $gender;
        }
    }
    
    public static function getAlamatTinggal($caleg) {
        return "{$caleg->kelurahan_tinggal}, {$caleg->kecamatan_tinggal}, {$caleg->kab_kota_tinggal}, {$caleg->provinsi_tinggal}";
    }
    
    public static function calculatePersen($num1, $num2) {
        $persen = ceil(($num1 / $num2) * 100);
        if ($persen > 100) {
            $persen = 100;
        } else if ($persen < 0) {
            $persen = 0;
        }
        
        return $persen;
    }

}
