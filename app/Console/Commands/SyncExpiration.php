<?php

namespace App\Console\Commands;

use App\Services\ConcertService;
use Illuminate\Console\Command;

class SyncExpiration extends Command
{
    protected $signature = 'sync:concerts-expirations';
    protected $description = 'Checking if stored concerts are expired or not';
    private ConcertService $concertService;

    public function __construct(ConcertService $concertService)
    {
        parent::__construct();
        $this->concertService = $concertService;
    }
    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->concertService->checkOutdatedConcerts();

        $this->info('The sync was successful!');
    }
}
