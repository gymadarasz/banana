<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class BananaTest extends TestCase
{
    public function setup()
    {
        $this->delivery = new \banana\BananaDelivery();
    }
    
    public function testOk()
    {
        $results = $this->delivery->sorting([
            [
                "from" => "Adolfo Suárez Madrid–Barajas Airport, Spain",
                "to" => "London Heathrow, UK"
            ],
            [
                "from" => "Fazenda São Francisco Citros, Brazil",
                "to" => "São Paulo–Guarulhos International Airport, Brazil"
            ],
            [
                "from" => "London Heathrow, UK",
                "to" => "Loft Digital, London, UK"
            ],
            [
                "from" => "Porto International Airport, Portugal",
                "to" => "Adolfo Suárez Madrid–Barajas Airport, Spain"
            ],
            [
                "from" => "São Paulo–Guarulhos International Airport, Brazil",
                "to" => "Porto International Airport, Portugal"
            ]
        ]);
        
        $this->assertEquals($results, [
            "Fazenda São Francisco Citros, Brazil",
            "São Paulo–Guarulhos International Airport, Brazil",
            "Porto International Airport, Portugal",
            "Adolfo Suárez Madrid–Barajas Airport, Spain",
            "London Heathrow, UK",
            "Loft Digital, London, UK"
        ]);
    }
    
    public function testMisspelledOk()
    {
        $results = $this->delivery->sorting([
            [
                'from' => 'AAA',
                'to' => 'BBB',
            ],[
                'from' => 'BBB',
                'to' => 'CC?', // <- misspelled
            ],[
                'from' => 'CCC',
                'to' => 'DDD',
            ],
        ]);
        
        $this->assertEquals($results, [
            'AAA', 'BBB', 'CCC', 'DDD'
        ]);
    }
    
    public function testNoStartFail()
    {
        try {
            $results = $this->delivery->sorting([
                [
                    'from' => 'AAA',
                    'to' => 'BBB',
                ],[
                    'from' => 'BBB',
                    'to' => 'CCC',
                ],[
                    'from' => 'CCC',
                    'to' => 'AAA',
                ],
            ]);
            $this->assertTrue(false);
        } catch (Exception $e) {
            $this->assertEquals($e->getCode(), 1002);
        }
    }
}