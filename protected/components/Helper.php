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

}
