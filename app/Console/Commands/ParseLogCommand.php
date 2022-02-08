<?php

namespace App\Console\Commands;

use App\Modules\GetFile;
use App\Modules\LogFileParser;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class ParseLogCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:parse {filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parses log';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    protected function prepareResult($array)
    {
        $resultArray = [];

        foreach ($array as $key=>$value) {
            $resultArray[] = [
                $key, $value
            ];
        }

        return $resultArray;
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        $filename = $this->argument('filename');

        try {
            $parser = new LogFileParser($filename);

            $totalVisitorsResultArray = $this->prepareResult($parser->getTotalVisits());
            $uniqueVisitorsResultArray = $this->prepareResult($parser->getUniqueVisits());


            $this->line('Total visits :');
            $this->table(
                ['Address', 'Visitors'],
                $totalVisitorsResultArray
            );

            $this->line('Unique visitors :');
            $this->table(
                ['Address', 'Visitors'],
                $uniqueVisitorsResultArray
            );

        } catch (FileNotFoundException $e) {
            $this->error($e);
        }

    }
}
