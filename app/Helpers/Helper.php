<?php

namespace App\Helpers;
/**
 * Created by PhpStorm.
 * User: baonv
 * Date: 22/5/2017
 * Time: 2:30 PM
 */

use App\Models\Redirect;
use Mail;
use App\Models\Category;
use App\Models\Option;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Product;
use App\Models\Order;
use App\Libraries\Mobile_Detect;
use DB;
use DateTime;
use http\Env\Request;
use Session;
use Cache;
use Intervention\Image\Facades\Image;
use Intervention\Image\Exception\NotSupportedException;
use \Intervention\Image\Exception\NotReadableException;
use \Intervention\Image\Exception\ImageException;

class Helper
{
    public static function formatDateTime($time, $format = "d/m/Y H:i") {
            return date($format, $time);
    }
    public static function formatDateFromString($string, $format = "d/m/Y H:i") {
        $time = strtotime($string);
        return date($format, $time);
    }
    public static function getRandom($array, $number) {
        if(count($array) <= $number) {
            return $array;
        } else {
            $results = [];
            $index = max(rand(0, count($array)) - $number, 0);
            foreach ($array as $i => $item) {
                if($i >= $index && $i < $index+$number) {
                    $results[] = $item;
                }
            }
            return $results;
        }
    }
    public static function formatMoney($money, $suffix = ' đ') {
        return is_numeric($money) ? number_format($money, 0, '', '.').$suffix : $money;
    }
	public static function date($format, $time = null) {
		$date = new DateTime();
		if($time) {
			$date->setTimestamp($time);
		}

		return $date->format($format);
	}
    static public function cutString($str, $length, $char="...") {
        $strlen	= mb_strlen($str, "UTF-8");
        if($strlen <= $length) return $str;
        $substr	= mb_substr($str, 0, $length, "UTF-8");
        if(mb_substr($str, $length, 1, "UTF-8") == " ") return $substr . $char;
        $strPoint= mb_strrpos($substr, " ", "UTF-8");
        if($strPoint < $length - 20) return $substr . $char;
        else return mb_substr($substr, 0, $strPoint, "UTF-8") . $char;
    }

    public static function getUrlParameters($exception = NULL) {
        @$get = $_GET;
        $string_parameters = '';
        if($get) {
            if(is_array($exception)) {
                foreach($exception as $e) {
                    unset($get[$e]);
                }
            }
            $string_parameters = http_build_query($get);
        }

        return $string_parameters ? url()->current().'?'.$string_parameters : url()->current();
    }

    public static function getThumbnail($file_path, $width = null, $height = null) {
        return asset(Helper::getThumbnailPath($file_path, $width, $height));
    }
    public static function getThumbnailPath($file_path, $width = null, $height = null) {

        if (substr($file_path, 0, 4) == 'http' || substr($file_path, -4, 4) == '.gif' || ($width == null && $height == null)) {
            return $file_path;
        }
        $default = '/img/default.jpg';
        if (empty($file_path) || !file_exists(public_path($file_path))) {
            return $default;
        }
        $path_parts = pathinfo($file_path);
        if(isset($path_parts['extension'])) {
            $folder = $path_parts['dirname'];
            $file_name = $path_parts['filename'];
            $extension = $path_parts['extension'];
            $widthSub = $width ? "{$width}" : '';
            $heightSub = $height ? "{$height}" : '';
            $thumbPath = "{$folder}/{$file_name}-{$widthSub}x{$heightSub}.{$extension}";
            $fullThumbPath = public_path($thumbPath);
            if (file_exists($fullThumbPath)) {
                return $thumbPath;
            } else {
                try {
                    $img = Image::make(public_path($file_path));
                    if($width && $height) {
                        $img->resize($width, $height);
                    } else if($width) {
                        $img->resize($width, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    } else if($height) {
                        $img->resize(null, $height, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    }

                    $path_to_save = dirname($fullThumbPath);
                    if (!is_dir($path_to_save)) {
                        mkdir($path_to_save, 0777, true);
                        chmod($path_to_save, 0777);
                    }
                    $img->save($fullThumbPath);
                    if (file_exists($fullThumbPath)) {
                        return $thumbPath;
                    } else {
                        return $default;
                    }
                } catch(NotSupportedException $e) {
                    return $default;
                } catch(NotReadableException $e) {
                    return $default;
                } catch(ImageException $e) {
                    return $default;
                }
            }
        }
        return $default;
    }
    public static function getNewName($file) {
        $new_filename = trim(self::pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $new_filename = preg_replace('/[^A-Za-z0-9\-\']/', '_', $new_filename);
        return $new_filename . self::replaceInsecureSuffix('.' . $file->getClientOriginalExtension());
    }
    public static function pathinfo($path, $options = null) {
        $path = urlencode($path);
        $parts = is_null($options) ? pathinfo($path) : pathinfo($path, $options);
        if (is_array($parts)) {
            foreach ($parts as $field => $value) {
                $parts[$field] = urldecode($value);
            }
        } else {
            $parts = urldecode($parts);
        }

        return $parts;
    }
    public static function replaceInsecureSuffix($name) {
        return preg_replace("/\.php$/i", '', $name);
    }

    public static function getPostCategories($limit = 18) {
        return PostCategory::getCategoriesList($limit = 18);
    }
    public static function getPageLink($rootUrl, $page = 1) {
        return $page > 1 ? "$rootUrl/page/$page" : $rootUrl;
    }
    public static function getProductCategories() {
        return Category::getCategoriesList();
    }
    public static function storeWatchedProducts($productId) {
        $watchedProducts = Session::get('watched_products');
        if (!$watchedProducts) {
            $watchedProducts = [];
        }
        array_unshift($watchedProducts, $productId);
        Session::put('watched_products', array_slice( array_unique($watchedProducts),0,20));
    }
    public static function getWatchedProducts() {
        $watchedProducts = Session::get('watched_products');
        if (!$watchedProducts) {
            $watchedProducts = [];
        }
        return $watchedProducts;
    }
    public static function getOption($key, $default = null) {
        return Option::getOption($key, $default);
    }
    public static function getSearchTeams() {
        $teams =  Option::getOption('search_tearms');
        return $teams ? explode('|', $teams) : [];
    }
	public static function getNewsSearchTeams() {
        $teams =  Option::getOption('footer_news_search_terms');
        return $teams ? explode('|', $teams) : [];
    }

    public static function getMenuProductsByCategory($category_id, $limit = 10) {
        return Product::getMenuProductsByCategory($category_id, $limit);
    }
    public static function sendTokenMail($user) {
        if($user && isset($user->email)) {
            $to_name = empty($user->name) ? $user->email : $user->name;
            $to_email = $user->email;
            $key = rand(1000, 9999);
            session(['login_key' => $key]);
            $data = array('name' => $to_name, "key" => $key);

            Mail::send('emails.login', $data, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)
                    ->subject('Mã xác minh hệ thống quản trị NguyenCongPc');
                $message->from(env('MAIL_USERNAME', 'nguyencongpc190@gmail.com'),'NguyenCongPc');
            });
            return true;
        }
        return false;
    }
    public static function sendNotifyShoppingnMail($phone) {
        $to_name = 'ADMIN';
        $to_email = 'nguyenluc@nguyencongpc.vn';

        Mail::send('emails.shopping', ['phone' =>  $phone], function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->cc('trung94nd@gmail.com')
                ->subject('Đơn hàng mới trên website');
            $message->from(env('MAIL_USERNAME', 'nguyencongpc190@gmail.com'),'NguyenCongPc');
        });
        return true;
    }
    public static function redirectOr404() {
        $url = str_replace('http://', 'https://', url()->full());
        $redirect = Redirect::findBySource($url);
        if($redirect && $redirect->redirect) {
            return redirect($redirect->redirect);
        }
        return redirect('/');
    }
	public static function isMobile() {
        $detect = new Mobile_Detect;
		return $detect->isMobile() ;
    }
	public static function getNewOrderCount() {
		return Order::where('status', 0)->count();
	}

	public static function getUserFilePath() {
        return "photos/".auth()->user()->id;
    }
}
