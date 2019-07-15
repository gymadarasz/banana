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
     *
     * @var string ('json'|'html')
     */
    protected $format;
    
    /**
     *
     * @var UIView 
     */
    protected $ui;
    
    /**
     * Application
     */
    public function __construct()
    {
        $this->sorter = new BananaDelivery();
        $this->parser = new JSONParser();
        $this->format = $this->getFormat();
        switch ($this->format) {
            case 'json':
                $this->showJson();
                break;
            case 'html':
                $this->showHtml();
                break;
            default:
                throw new Exception('Incorrect format');
        }
    }
    
    /**
     * Show HTML output
     */
    protected function showHtml()
    {
        $this->ui = new UIView();
        $this->ui->setTemplate(__DIR__ . '/view/form.html.php');
        $this->ui->setData(['json' => '{}']);
        $stops = $this->getStops();
        if ($stops) {
            $json = $this->getResultsJson($stops);
            $this->ui->setData(['json' => $json]);
        }
        $this->ui->output();
    }
    
    /**
     * Show JSON output (as an API)
     */
    protected function showJson()
    {
        $stops = $this->getStops();
        $json = $this->getResultsJson($stops);
        echo $json;
    }
    
    /**
     * 
     * @param array $stops
     * @return string (JSON)
     */
    protected function getResultsJson(array $stops): string
    {
            $results = $this->sorter->sorting($stops);
            $json = $this->parser->encode($results);
            return $json;
    }
    
    /**
     * default is JSON otherwise HTML
     * 
     * @return string
     */
    protected function getFormat(): string
    {
        $format = $this->getRequestVariable('format', 'json');
        return $format === 'json' ? 'json' : 'html';
    }
    
    /**
     *
     * @return array of journey steps or empty if there is no requested stops 
     * @throws Exception
     */
    protected function getStops(): array
    {
        $stops = $this->getRequestVariable('stops', []);
        if (!$stops) {
            return $stops;
        }
        if ($stops && !is_string($stops)) {
            throw new Exception('"stop" should be a JSON string', -1);
        }
        $parsed = $this->parser->parse($stops, true);
        return $parsed;
    }
    
    protected function getRequestVariable(string $name, $default = null)
    {
        if (!isset($_REQUEST[$name]) || !$_REQUEST[$name]) {
            return $default;
        }
        return $_REQUEST[$name];
    }
}
