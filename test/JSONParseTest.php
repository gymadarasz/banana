<?php

namespace banana\test;

use Exception;

/**
 * JSONParseTest
 *
 * @author gyula
 */
class JSONParseTest extends Test
{
    
    public function setup() {
        $this->parser = new \banana\JSONParser();
    }
    
    public function run()
    {
        $this->testOk();
        $this->testFail();
    }
    
    public function testOk()
    {
        $result = $this->parser->parse('{"a":"b"}');
        $this->assert($result, ['a' => 'b']);
    }
    
    public function testFail()
    {
        try {
            $result = $this->parser->parse('{"a":\'b\'}');
            $this->assertTrue(false);
        } catch (Exception $e) {
            $this->assert($e->getCode(), 1001);
        }
    }
}
