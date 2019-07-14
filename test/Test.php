<?php

namespace banana\test;

/**
 * Test
 *
 * @author gyula
 */
class Test {
    
    protected $counter = 0;
    
    protected function assert($a, $b) {
        if ($a === $b) {
            $this->counter++;
            echo '.';
            return true;
        }
        $details = "A:\n" . print_r($a, true);
        $details .= "B:\n" . print_r($b, true);
        throw new Exception('Assert error: ' . $details, 1);
    }
    
    public function status() {
        echo "\n{$this->counter} assert OK\n";
    }
    
}
