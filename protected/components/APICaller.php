<?php

/**
 * APICaller
 *
 * @author rezanachmad@gmail.com
 */
class APICaller {
    const API_KEY = '6939bbd599689d621ab7aeb4c1974fd5';
    const ENDPOINT = 'http://api.pemiluapi.org';
    
    const GEO_API_POINT= '/geographic/api/point';
    const CANDIDATE_API_CALEG = '/candidate/api/caleg';
    const CANDIDATE_API_PARTAI = '/candidate/api/partai';

    public function call($url, $params = array()) {
        $params['apiKey'] = self::API_KEY;
        $completeUrl = self::ENDPOINT . $url . '?' . http_build_query($params);
        $result = file_get_contents($completeUrl);
        return json_decode($result);
    }
    
    public function getPartais() {
        function cmpPartais($p1, $p2) {
            return ($p1->id < $p2->id) ? -1 : 1;
        }
        
        $response = $this->call(APICaller::CANDIDATE_API_PARTAI);
        $partais = $response->data->results->partai;
        
        usort($partais, 'cmpPartais');
        
        return $partais;
    }
    
    public function getCalegsGroupByPartai($dapil, $lembaga, $tahun = 2014) {
        $response = $this->call(self::CANDIDATE_API_CALEG, array(
            'dapil' => $dapil,
            'lembaga' => $lembaga,
            'tahun' => $tahun,
            'limit' => 1000,
        ));
        
        $calegs = $response->data->results->caleg;
        $partais = array();
        foreach ($calegs as $caleg) {
            $partais[$caleg->partai->id][] = $caleg;
        }
        
        return $partais;
    }
    
    public function getCalegsDPD($dapil, $lembaga, $tahun = 2014) {
        $response = $this->call(self::CANDIDATE_API_CALEG, array(
            'provinsi' => $dapil,
            'lembaga' => $lembaga,
            'tahun' => $tahun,
            'limit' => 1000,
        ));
        
        $calegs = $response->data->results->caleg;
        return $calegs;
    }

}
