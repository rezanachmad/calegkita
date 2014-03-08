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

    public function call($url, $params = array()) {
        $params['apiKey'] = self::API_KEY;
        $completeUrl = self::ENDPOINT . self::GEO_API_POINT . '?' . http_build_query($params);
        $result = file_get_contents($completeUrl);
        return json_decode($result);
    }

}
