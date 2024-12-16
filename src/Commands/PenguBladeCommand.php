<?php

namespace realzone22\PenguBlade\Commands;

use Illuminate\Console\Command;

class PenguBladeCommand extends Command
{
    public $signature = 'pengublade';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
