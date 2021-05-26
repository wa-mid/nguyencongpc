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

class SynKiotViet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:syn_kiotviet';

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
		echo date('h:i:s')."\n";
		$kiotVietApi = new KiotVietApi();
		//dd($kiotVietApi->getProduct('SP003861'));
        for($page = 1; $page < 50; $page++) {
			$products = $kiotVietApi->getProductsByCreate($page);
			$number = 0;
			if($products && !empty($products['data'])) {
				foreach($products['data'] as $product) {
					KiotViet::updateOrInsertProduct($product);
					$number++;
				}
			}
			echo "Page {$page}: {$number} product created or updated \n";
		}
		echo date('h:i:s')."\n";
    }
}
