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
    public function run()
    {
        $this->testOk();
        $this->testFail();
    }
    
    public function testOk()
    {
        $parser = new \banana\JSONParser();
        $result = $parser->parse('{"a":"b"}');
        $this->assert($result, ['a' => 'b']);
    }
    
    public function testFail()
    {
        $parser = new \banana\JSONParser();
        try {
            $result = $parser->parse('{"a":\'b\'}');
            $this->assertTrue(false);
        } catch (Exception $e) {
            $this->assert($e->getCode(), 1001);
        }
    }
}
