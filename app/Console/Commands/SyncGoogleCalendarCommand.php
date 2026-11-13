<?php

namespace App\Console\Commands;

use App\Services\GoogleCalendarSyncService;
use Illuminate\Console\Command;

class SyncGoogleCalendarCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'google-calendar:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Segerakkan temujanji dari Google Calendar secara automatik';

    /**
     * Execute the console command.
     */
    public function handle(GoogleCalendarSyncService $service): int
    {
        $this->info('Memulakan penyegerakan Google Calendar...');

        $result = $service->sync();

        if ($result['success']) {
            $this->info($result['message']);

            return self::SUCCESS;
        }

        $this->warn($result['message']);

        return self::FAILURE;
    }
}
