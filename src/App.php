<?php

namespace banana;

use Exception;

/**
 * App
 *
 * @author gyula
 */
class App
{
    
    /**
     *
     * @var BananaDelivery
     */
    protected $sorter;
    
    /**
     *
     * @var JSONParser
     */
    protected $parser;
    
    /**
     * Application
     */
    public function __construct()
    {
        $this->sorter = new BananaDelivery();
        $this->parser = new JSONParser();
        $stops = $this->getStops();
        $results = $this->sorter->sorting($stops);
        $json = $this->parser->encode($results);
        echo $json;
    }
    
    /**
     *
     * @return array of journey steps
     * @throws Exception
     */
    protected function getStops(): array
    {
        if (!isset($_REQUEST['stops']) || !$_REQUEST['stops']) {
            throw new Exception('Request should contains "stops"', -1);
        }
        $stops = $_REQUEST['stops'];
        if (!is_string($stops)) {
            throw new Exception('"stop" should be a JSON string', -1);
        }
        $parsed = $this->parser->parse($stops, true);
        return $parsed;
    }
}
