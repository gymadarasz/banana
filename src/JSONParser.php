<?php

namespace banana;

/**
 * JSONParser
 *
 * @author gyula
 */
class JSONParser {
    
    public function parse($json) {
        $data = json_decode($json);
        $msg = '';
        switch (json_last_error()) {
            case JSON_ERROR_NONE:
                $msg = ' - No errors';
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
    
}
