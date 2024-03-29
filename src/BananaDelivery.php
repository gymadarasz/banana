<?php

namespace banana;

use Exception;

/**
 * Banana Delivery Calculator
 *
 * @author gyula.madarasz@gmail.com
 */
class BananaDelivery
{
    
    /**
     *
     * @var int stop left from delivery
     */
    protected $left = 0;
    
    /**
     *
     * @var int stops found for delivery
     */
    protected $count = 0;
    
    /**
     *
     * @var string first stop
     */
    protected $first = '';
    
    /**
     *
     * @var array of full travels
     */
    protected $travles = [];
    
    /**
     *
     * @var int minimum distance for levenshtein calculations
     */
    protected $distanceMinimum = 0;
    
    /**
     *
     * @var sorted array of travels
     */
    protected $sorted = [];
    
    /**
     * can accept a set of journey steps in any order, and return the
     * journey in the correct order.
     *
     * @param array $travels full travels
     * @param int $distanceMinimum minimum distance for levenshtein calculations
     * @return string[] stops of travel
     */
    public function sorting(array $travels, int $distanceMinimum = 0): array
    {
        
        // sorting setup
        $this->travels = $travels;
        $this->distanceMinimum = $distanceMinimum;
        $this->first = $this->getFirst();
        
        // find the first one
        $this->findFirstStop();
        
        // sorting
        $this->sortingTravels();
        
        // correction
        $results = $this->correctionTravels();
        
        return $results;
    }
    
    /**
     * find the first stop of journey
     */
    protected function findFirstStop()
    {
        $distance = $this->distanceMinimum;
        $this->left = count($this->travels);
        $this->sorted = [];
        $this->count = 0;
        while (!$this->sorted) {
            for ($i = 0; $i < $this->left; $i++) {
                if ($this->checkDistance($this->first, $this->travels[$i]['from'], $distance)) {
                    $this->popStop($i);
                    break;
                }
            }
            $distance++;
        }
    }
    
    /**
     * sorting stops of journey
     */
    protected function sortingTravels()
    {
        $distance = $this->distanceMinimum;
        while ($this->left) {
            $replace = false;
            foreach ($this->travels as $key => $travel) {
                if ($this->checkDistance($this->sorted[$this->count-1]['to'], $travel['from'], $distance)) {
                    $this->popStop($key);
                    $replace = true;
                    break;
                }
            }
            if (!$replace) {
                $distance++;
            }
        }
    }
    
    /**
     * correction for results stops of journey
     *
     * @return string[]
     */
    protected function correctionTravels(): array
    {
        $results = [];
        foreach ($this->sorted as $stop) {
            $results[] = $stop['from'];
        }
        $results[] = $stop['to'];
        return $results;
    }
    
    /**
     * check the distance (or equality) between two string
     * using levenshtein calculation to being safe of misspelled words by monkeys
     *
     * @param string $to
     * @param string $from
     * @param int $distance
     * @return bool
     */
    protected function checkDistance(string $to, string $from, int $distance): bool
    {
        return levenshtein($to, $from) <= $distance;
    }
    
    /**
     * pop a travel of journey and push it into sorted results
     *
     * @param int $key
     */
    protected function popStop(int $key)
    {
        $this->sorted[] = $this->travels[$key];
        unset($this->travels[$key]);
        $this->left--;
        $this->count++;
    }
    
    /**
     *
     * @return first of journey steps
     * @throws Exception
     */
    protected function getFirst(): string
    {
        foreach ($this->travels as $from) {
            $found = true;
            foreach ($this->travels as $to) {
                if ($from['from'] === $to['to']) {
                    $found = false;
                    break;
                }
            }
            if ($found) {
                return $from['from'];
            }
        }
        throw new Exception('No start address', 1002);
    }
}
