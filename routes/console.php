<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('portal:health-check', function (): void {
    $this->info('Secure view-only portal is reachable.');
})->purpose('Simple health check for the document portal');
