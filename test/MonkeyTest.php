<?php

namespace banana\test;

/**
 * Description of MonkeyTest
 *
 * @author gyula
 */
class MonkeyTest extends Test
{
    public function run()
    {
        $delivery = new \banana\BananaDelivery();
        $results = $delivery->sorting([
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
        
        $this->assert($results, [
            "Fazenda São Francisco Citros, Brazil",
            "São Paulo–Guarulhos International Airport, Brazil",
            "Porto International Airport, Portugal",
            "Adolfo Suárez Madrid–Barajas Airport, Spain",
            "London Heathrow, UK",
            "Loft Digital, London, UK"
        ]);
    }
}
