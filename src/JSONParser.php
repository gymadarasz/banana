<?php

namespace banana;

use Exception;

/**
 * JSONParser
 *
 * @author gyula
 */
class JSONParser
{
    
    /**
     * 
     * @param string $json
     * @param bool $assoc
     * @return mixed
     */
    public function parse(string $json, bool $assoc = true)
    {
        $data = json_decode($json, $assoc);
        switch (json_last_error()) {
            case JSON_ERROR_NONE:
                $msg = '';
            break;
            case JSON_ERROR_DEPTH:
                $msg = ' - Maximum stack depth exceeded';
            break;
            case JSON_ERROR_STATE_MISMATCH:
                $msg = ' - Underflow or the modes mismatch';
            break;
            case JSON_ERROR_CTRL_CHAR:
                $msg = ' - Unexpected control character found';
            break;
            case JSON_ERROR_SYNTAX:
                $msg = ' - Syntax error, malformed JSON';
            break;
            case JSON_ERROR_UTF8:
                $msg = ' - Malformed UTF-8 characters, possibly incorrectly encoded';
            break;
            default:
                $msg = ' - Unknown error';
            break;

        }
        if ($msg) {
            throw new Exception('JSON parse error' . $msg, -1);
        }
        return $data;
    }
    
    /**
     * 
     * @param mixed $data
     * @return string
     * @throws Exception
     */
    public function encode($data): string
    {
        $json = json_encode($data);
        if ($json === false) {
            throw new Exception(json_last_error());
        }
        return $json;
    }
}
