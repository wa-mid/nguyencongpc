<?php

namespace App\Console\Commands;

use App\Helpers\Helper;
use Illuminate\Console\Command;
use DB;
use App\Models\Product;
use App\Models\KiotViet;
use Cache;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UpdateProductStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:update_product_status';

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
        self::updateNormalStatus();
        self::updatePendingStatus();
    }
	public static function updateNormalStatus() {
		$timeCheck = Carbon::now()->subDays(30);
		$products = Product::join('kiot_viet', 'product.kiot_viet_id', '=', 'kiot_viet.id')->where(function ($query) use ($timeCheck) {
               $query->where('kiot_viet.updated_at', '>=', $timeCheck);
           })->select('product.*', 'kiot_viet.onHand')->get();
		foreach($products as $product) {
			$product->amount = $product->onHand;
			if($product->status == 1) {
				if($product->onHand == 0) {
					$product->status = 2; // Còn hàng ==> Hết hàng
				}
			} else if($product->status == 2) {
				if($product->onHand > 0) {
					$product->status = 1; //  Hết hàng ==> Còn hàng
				}
			} else {
				if($product->onHand > 0) {
					$product->status = 1; //  Hết hàng ==> Còn hàng
				}
			}
			$product->save();
		}
	}
	public static function updatePendingStatus() {
		$timeCheck = Carbon::now()->subMonths(3);
		$timeUpdate = Carbon::now();
		$products = Product::where('status', 2)->where('updated_at', '<', $timeCheck)->update(['status' => 0, 'updated_at' => $timeUpdate]);
	}
}
