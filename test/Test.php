<?php

namespace banana\test;

use Exception;

/**
 * Test
 *
 * @author gyula
 */
class Test
{
    protected static $counter = 0;
    
    protected function assert($a, $b)
    {
        if ($a === $b) {
            self::$counter++;
            echo '.';
            return true;
        }
        $details = "A:\n" . print_r($a, true);
        $details .= "B:\n" . print_r($b, true);
        throw new Exception('Assert error: ' . $details, 1);
    }
    
    protected function assertTrue($a)
    {
        $this->assert($a, true);
    }
    
    public static function status()
    {
        echo "\n" . self::$counter . " assert OK\n";
    }
}
