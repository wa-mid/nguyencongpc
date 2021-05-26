<?php
/**
 * Created by PhpStorm.
 * User: baonv
 * Date: 31/5/2017
 * Time: 3:00 PM
 */

namespace App\Libraries;

use Helper;
use Cache;
use Log;

class KiotVietApi
{
    public $URL_REQUEST = "https://public.kiotapi.com/";
    private $client_id = "281f602f-58d7-46cc-8262-5f6851645c93";
    private $client_secret = "AF4A084B13A976ACBD67FC4B7F59E30B689CAA90";
    private $retailer = "nguyencongcomputer";
    //private $client_id = "d1b17894-9b8b-4bd0-9bbd-6b69a98335a9";
    //private $client_secret = "5E2735BEFB00DE096100C8F726A05FC8D2F4FB78";
    //private $retailer = "baonguyen2019";
    public $access_token;
    public function __construct()
    {
        $this->access_token = Cache::get('ncpc_kiotviet_access_token');
    }

    public function login()
    {
        $data = array(
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'grant_type' => 'client_credentials',
            'scopes' => 'PublicApi.Access'
        );
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://id.kiotviet.vn/connect/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_HTTPHEADER => array(
                "Accept: */*",
                "Accept-Encoding: gzip, deflate",
                "Cache-Control: no-cache",
                "Connection: keep-alive",
                "Content-Length: 155",
                "Content-Type: application/x-www-form-urlencoded",
                "Host: id.kiotviet.vn",
                "Postman-Token: 14b774cd-8eb4-4310-be59-7488c89a8395,3150e3c9-d089-479d-87c2-059625446081",
                "User-Agent: PostmanRuntime/7.18.0",
                "cache-control: no-cache"
            ),
        ));

        $response = json_decode(curl_exec($curl), true);
        $err = curl_error($curl);
        curl_close($curl);
        if (isset($response['access_token'])) {
            $this->access_token = $response['access_token'];
            Cache::put('ncpc_kiotviet_access_token', $this->access_token, 1200);
            return $this->access_token;

        } else {
            Log::error("Kiot Viet Login error " . $err);
            return null;
        }
    }

    public function callGetMethod($method)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->URL_REQUEST.$method,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer ".$this->getTokenKey(),
                "Retailer: ".$this->retailer
            ),
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false
        ));
        $response = json_decode(curl_exec($curl), true);
        Log::info("KiotViet {$method} response ".json_encode($response));
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            Log::error("KiotViet Post callMethod {$method} error {$err}");
            return null;
        } else {
            return $response;
        }
    }

    public function getTokenKey() {
        if($this->access_token == null) {
            $this->login();
            return $this->access_token;
        } else {
            return $this->access_token;
        }
    }


    public function getProducts($lastModifiedFrom, $page = 1)
    {
        $pageSize = 2;
        $currentItem = ($page - 1) * $pageSize;
        $results = $this->callGetMethod("Products?format=json&currentItem={$currentItem}&pageSize={$pageSize}&orderBy=modifiedDate&lastModifiedFrom={$lastModifiedFrom}&includeInventory=true");
        return $results;
    }
	public function getProductsByCreate($page = 1)
    {
        $pageSize = 100;
        $currentItem = ($page - 1) * $pageSize;
        $results = $this->callGetMethod("Products?format=json&currentItem={$currentItem}&pageSize={$pageSize}&orderBy=createdDate&includeInventory=true");
        return $results;
    }
	public function getOrders($lastCreate, $page = 1)
    {
        $pageSize = 100;
        $currentItem = ($page - 1) * $pageSize;
        $results = $this->callGetMethod("invoices?format=json&currentItem={$currentItem}&pageSize={$pageSize}&orderBy=modifiedDate&lastModifiedFrom={$lastCreate}");
        return $results;
    }
	public function getProduct($code)
    {
        $results = $this->callGetMethod("Products/code/{$code}");
        return $results;
    }
	public function getInvoices($lastCreate, $page = 1)
    {
        $pageSize = 100;
        $lastCreate = urlencode($lastCreate);
        $results = $this->callGetMethod("invoices?pageSize={$pageSize}&orderBy=modifiedDate&lastModifiedFrom={$lastCreate}");
        return $results;
    }
    public function getInvoicesByCreate($lastCreate, $page = 1)
    {
        $pageSize = 100;
        $results = $this->callGetMethod("invoices?pageSize={$pageSize}&orderBy=createdDate&createdDate={$lastCreate}");
        return $results;
    }

}