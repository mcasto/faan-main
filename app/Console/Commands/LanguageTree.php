<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class LanguageTree extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:language-tree';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        exec("/opt/homebrew/bin/tree " . dirname(__DIR__, 3) . '/resources/lang/en > /users/mikecasto/desktop/faan-language-tree.txt');
    }
}
