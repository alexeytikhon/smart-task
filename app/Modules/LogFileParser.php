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

    protected function countPagesVisits() {
        foreach ($this->addressesArray as $key=>$value){
            $this->uniqueVisitsArray[$key] = count(array_unique($value));
            $this->totalVisitsArray[$key] = count($value);
        }
    }

    protected function arraysSort()
    {
        arsort($this->uniqueVisitsArray);
        arsort($this->totalVisitsArray);
    }

    public function getUniqueVisits()
    {
        return $this->uniqueVisitsArray;
    }

    public function getTotalVisits()
    {
        return $this->totalVisitsArray;
    }

}
