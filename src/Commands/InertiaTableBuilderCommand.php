<?php

namespace InertiaKit\InertiaTableBuilder\Commands;

use Illuminate\Console\Command;

class InertiaTableBuilderCommand extends Command
{
    public $signature = 'inertia-table-builder';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
