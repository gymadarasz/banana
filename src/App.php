<?php

namespace banana;

use Exception;

/**
 * App
 *
 * @author gyula
 */
class App {
    
    protected $sorter;
    
    protected $parser;
    
    public function __construct() {
        $this->sorter = new BananaDelivery();
        $this->parser = new JSONParser();
        $this->sorter->sorting($this->getStart(), $this->getStops());        
    }
    
    protected function getStart() {
        if (!isset($_REQUEST['start']) || !$_REQUEST['start']) {
            throw new Exception('Request should contains "start"', -1);
        }
        $start = $_REQUEST['start'];
        if (!is_string($start)) {
            throw new Exception('"start" should be a string', -1);
        }
        return $start;
    }
    
    protected function getStops() {
        if (!isset($_REQUEST['stops']) || !$_REQUEST['stops']) {
            throw new Exception('Request should contains "stops"', -1);
        }
        $stops = $_REQUEST['stops'];
        if (!is_string($stops)) {
            throw new Exception('"stop" should be a JSON string', -1);
        }
        return $this->parser($stops);
    }
}
