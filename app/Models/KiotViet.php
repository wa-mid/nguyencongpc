<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
use Cache;
use Helper;

class KiotViet extends Model
{

    protected $table = 'kiot_viet';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','code', 'name','categoryId','categoryName','basePrice','isActive'
    ];

    public static function updateOrInsertProduct($product) {
		$onHand = 0;
		if(!empty($product['inventories'])) {
			foreach ($product['inventories'] as $inventory) {
				$onHand += isset($inventory['onHand']) ? intval($inventory['onHand']) : 0;
			}
		}
        $item = KiotViet::where('id', $product['id'])->first();
        if($item) {
            $modifiedDate = isset($product['modifiedDate']) ? new Carbon($product['modifiedDate']) : null;
            if($item->onHand != $onHand) {
				$item->onHand = $onHand;
                if(!empty($product['inventories'])) {
					$productLocal = Product::where('kiot_viet_id', $item->id)->first();
					if($productLocal) {
						$productLocal->inventories = json_encode($product['inventories']);
						$productLocal->save();
					}
                }
                $item->save();
            }
        } else {
            $item = new KiotViet($product);
            $item->modifiedDate = isset($product['modifiedDate']) ? new Carbon($product['modifiedDate']) : null;
			$item->createdDate = isset($product['createdDate']) ? new Carbon($product['createdDate']) : null;
            $item->onHand = $onHand;
            $item->save();
        }
        return $item;
    }
}
