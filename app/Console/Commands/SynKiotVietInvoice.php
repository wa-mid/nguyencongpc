<?php

namespace App\Console\Commands;

use App\Helpers\Helper;
use Illuminate\Console\Command;
use DB;
use App\Libraries\KiotVietApi;
use App\Models\KiotViet;
use App\Models\KiotVietInvoice;
use Cache;
use Illuminate\Support\Facades\Log;

class SynKiotVietInvoice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:syn_kiotviet_invoice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
		$number = KiotVietInvoice::syncInvoices();
		Log::info("{$number} Invoices created or updated");
    }
}
