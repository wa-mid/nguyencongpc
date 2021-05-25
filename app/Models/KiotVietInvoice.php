<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
use Cache;
use Helper;
use Auth;
use App\Libraries\KiotVietApi;

class KiotVietInvoice extends Model
{

    protected $table = 'kiotviet_invoices';
    protected $primaryKey = 'code';

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['code','branchName','customerCode','customerName','total','status','statusValue','updated_by_id','updated_by_name','sys_status'];

    public static function updateOrInsertInvoice($invoice) {
        if($invoice['status'] == 1 || $invoice['status'] == 3) {
            $item = KiotVietInvoice::where('code', $invoice['code'])->first();
            if($item) {
                $modifiedDate = isset($invoice['modifiedDate']) ? new Carbon($invoice['modifiedDate']) : null;
                if($modifiedDate && (!$item->modifiedDate || $item->modifiedDate < $modifiedDate)) {
                    $item->fill($invoice);
                    $item->modifiedDate = $modifiedDate;
                    $item->createdDate = isset($invoice['createdDate']) ? new Carbon($invoice['createdDate']) : null;
                    $invoiceDetails = [];
                    if(!empty($invoice['invoiceDetails'])) {
                        $invoiceDetails = $invoice['invoiceDetails'];
                    }
                    $item->invoiceDetails = json_encode($invoiceDetails);
                    $item->save();
                    return 1;
                }
            } else {
                $item = new KiotVietInvoice($invoice);
                $item->createdDate = isset($invoice['createdDate']) ? new Carbon($invoice['createdDate']) : null;
                $invoiceDetails = [];
                if(!empty($invoice['invoiceDetails'])) {
                    $invoiceDetails = $invoice['invoiceDetails'];
                }
                $item->invoiceDetails = json_encode($invoiceDetails);
                $item->save();
                return 1;
            }
        }
        return 0;
    }
    public static function syncInvoices() {
        $lastInvoice = KiotVietInvoice::orderByDesc('createdDate')->first();
        $lastCreated = $lastInvoice ? new Carbon($lastInvoice->createdDate) : new Carbon('2020-11-16');
        $kiotVietApi = new KiotVietApi();
        $page = 1;
        $invoices = $kiotVietApi->getInvoices($lastCreated->toISOString(), $page);

        $number = 0;
        if($invoices && !empty($invoices['data'])) {
            foreach($invoices['data'] as $invoice) {
                $number += KiotVietInvoice::updateOrInsertInvoice($invoice);
            }
        }

        $invoices = $kiotVietApi->getInvoicesByCreate($lastCreated->toDateString(), $page);
        if($invoices && !empty($invoices['data'])) {
            foreach($invoices['data'] as $invoice) {
                $number += KiotVietInvoice::updateOrInsertInvoice($invoice);
            }
        }
        return $number;
    }
    public function getInvoiceDetails() {
        $invoiceDetails = json_decode($this->invoiceDetails);
        return collect($invoiceDetails ? $invoiceDetails : []);
    }
    public function getSysStatus() {
        return $this->sys_status == 1 ? 'Hoàn thành' : 'Chưa';
    }
}
