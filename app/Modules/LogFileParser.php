<?php


namespace App\Modules;

use Illuminate\Contracts\Filesystem\FileNotFoundException;

class LogFileParser
{
    /**
     * @var
     */
    protected $filename;

    /**
     * @var array total visits per address array
     */
    protected $addressesArray = [];

    /**
     * @var array unique visits number per address array
     */
    protected $uniqueVisitsArray = [];

    /**
     * @var array total visits number per address array
     */
    protected $totalVisitsArray = [];

    public function __construct($filename)
    {
        $this->filename = $filename;
        $this->getAllVisitsPerPage();
        $this->countPagesVisits();
        $this->arraysSort();
    }

    /**
     * @throws FileNotFoundException fills array with each view per address
     */
    protected function getAllVisitsPerPage() {
        if (file_exists($this->filename)) {
            foreach (file($this->filename) as $line) {
                $explodedLine = explode(' ', $line);
                $this->addressesArray[$explodedLine[0]][] = $explodedLine[1];
            }
        } else {
            throw new FileNotFoundException('File not found');
        }
    }

    /**
     * Counts unique & total page visits
     */
    protected function countPagesVisits() {
        foreach ($this->addressesArray as $key=>$value){
            $this->uniqueVisitsArray[$key] = count(array_unique($value));
            $this->totalVisitsArray[$key] = count($value);
        }
    }

    /**
     * Sorting arrays in descending order
     */
    protected function arraysSort()
    {
        arsort($this->uniqueVisitsArray);
        arsort($this->totalVisitsArray);
    }

    /**
     * @return array Returns an unique visits array
     */
    public function getUniqueVisits()
    {
        return $this->uniqueVisitsArray;
    }

    /**
     * @return array Returns a total visits array
     */
    public function getTotalVisits()
    {
        return $this->totalVisitsArray;
    }

}
