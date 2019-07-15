<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class JSONParseTest extends TestCase
{
    public function setup()
    {
        $this->parser = new \banana\JSONParser();
    }
    
    public function testOk()
    {
        $result = $this->parser->parse('{"a":"b"}');
        $this->assertEquals($result, ['a' => 'b']);
    }
    
    public function testFail()
    {
        try {
            $result = $this->parser->parse('{"a":\'b\'}');
            $this->assertTrue(false);
        } catch (Exception $e) {
            $this->assertEquals($e->getCode(), 1001);
        }
    }
}