<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
use Cache;
use Helper;

class Video extends Model
{

    protected $table = 'video';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'link', 'status', 'priority'
    ];

    public static function getQuery($order = true) {
        return Video::where('status', 1);
    }

    public static function getHomeVideos($limit = 10) {
        $cacheKey = 'ncpc_video_home';
        $items = Cache::get($cacheKey);
        if($items == null) {
            $items = Video::getQuery()->orderByDesc('priority')->limit($limit)->get();
            Cache::put($cacheKey, $items, 60);
        }
        return $items;
    }
	public static function getNewsVideos($limit = 10) {
        $cacheKey = 'ncpc_video_news';
        $items = Cache::get($cacheKey);
        if($items == null) {
            $items = Video::getQuery()->orderByDesc('priority')->limit($limit)->get();
            Cache::put($cacheKey, $items, 60);
        }
        return $items;
    }

    public function getImage($width = null, $height = null) {
        return Helper::getThumbnail($this->file, $width, $height);
    }
    public function getStatusText() {
        return $this->status == 1 ? 'Enable' : 'Disable';
    }

    public function get_youtube_video_ID($youtube_video_url) {
        /**
         * Pattern matches
         * http://youtu.be/ID
         * http://www.youtube.com/embed/ID
         * http://www.youtube.com/watch?v=ID
         * http://www.youtube.com/?v=ID
         * http://www.youtube.com/v/ID
         * http://www.youtube.com/e/ID
         * http://www.youtube.com/user/username#p/u/11/ID
         * http://www.youtube.com/leogopal#p/c/playlistID/0/ID
         * http://www.youtube.com/watch?feature=player_embedded&v=ID
         * http://www.youtube.com/?feature=player_embedded&v=ID
         */
        $pattern =
            '%                 
    (?:youtube                    # Match any youtube url www or no www , https or no https
    (?:-nocookie)?\.com/          # allows for the nocookie version too.
    (?:[^/]+/.+/                  # Once we have that, find the slashes
    |(?:v|e(?:mbed)?)/|.*[?&]v=)  # Check if its a video or if embed 
    |youtu\.be/)                  # Allow short URLs
    ([^"&?/ ]{11})                # Once its found check that its 11 chars.
    %i';
        // Checks if it matches a pattern and returns the value
        //dd(preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $youtube_video_url, $matches));
        if (preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $youtube_video_url, $matches)) {
            return $matches[0];
        }
        // if no match return false.
        return false;
    }

    public function getThumbnailYT($link){

        $id = $this->get_youtube_video_ID($link);
        if($id){
            return 'https://img.youtube.com/vi/'.$id.'/0.jpg';
        }else{
            return false;
        }

    }
}
