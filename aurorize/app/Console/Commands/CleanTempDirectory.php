<?php

namespace App\Console\Commands;

use Throwable;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CleanTempDirectory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean:temp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove all images whose created before 1 day ago';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $files = glob(public_path(config('constant.temp_file_url')) . "*");
            $now   = time();
            foreach ($files as $file) {
                if (is_file($file)) {
                    if ($now - filemtime($file) >= 60 * 60 * 24) { // 1 day
                        unlink($file);
                    }
                }
            }
        } catch (Throwable $e) {
            Log::error($e->getMessage());
        }
    }
}
