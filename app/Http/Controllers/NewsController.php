<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Product;
use App\Models\Video;
use Illuminate\Http\Request;
use Solarium\Client;
use Illuminate\Pagination\LengthAwarePaginator;

class NewsController  extends Controller
{
    protected $client;

    public function __construct()
    {
        $config = [
            'endpoint' => [
                'localhost' => [
                    'host' => env('SOLR_HOST', '127.0.0.1'),
                    'port' => env('SOLR_PORT', '8983'),
                    'core' => 'post'
                ]
            ]
        ];
        $client = new Client($config);
        $this->client = $client;
    }

    public function index() {
        $uri = 'tin-tuc';
        $postCategory = PostCategory::findByUri($uri);
        $cate_tin_tuc_moi = PostCategory::findByUri('tin-tuc');
        $cate_tin_tuc_noi_bat = PostCategory::findByUri('tin-tuc-noi-bat');
        $cate_khuyen_mai = PostCategory::findByUri('tin-tuc-khuyen-mai');
        $cate_huong_dan = PostCategory::findByUri('tin-tuc-huong-dan');
        $cate_reivew = PostCategory::findByUri('tin-tuc-review');
        $videos = Video::getNewsVideos(8);
        //dd($videos);

        if($postCategory) {
            $data['page_title']       = "Danh mục {$postCategory->name} - MÁY TÍNH NGUYỄN CÔNG";
            $data['page_description']       = "";
            $data['postCategory']       = $postCategory;
            $list_tin_moi_nhat = Post::getQuery()->where('is_home', 1)->orderBy('created_at', 'desc')->limit(9)->get();
            $list_tin_tuc_noi_bat = Post::getQuery()->where('is_home', 1)->orderBy('id', 'desc')->paginate(5);
             if($cate_reivew != null){
                 $list_tin_review = Post::getQuery()->where('category_id', $cate_reivew->id)->orderBy('id', 'desc')->paginate(4);
             }else{
                 $list_tin_review =[];
             }
             if($cate_huong_dan != null){
                 $list_tin_huong_dan = Post::getQuery()->where('category_id', $cate_huong_dan->id)->orderBy('id', 'desc')->paginate(6);
             }else{
                 $list_tin_huong_dan = [];
             }
             $list_tin_khuyen_mai = Post::getQuery()->where('category_id', $cate_khuyen_mai->id)->orderBy('id', 'desc')->paginate(6);
            $data['list_tin_moi_nhat'] = $list_tin_moi_nhat;
            $data['list_tin_tuc_noi_bat'] = $list_tin_tuc_noi_bat;
            $data['list_tin_review'] = $list_tin_review;
            $data['list_tin_huong_dan'] = $list_tin_huong_dan;
            $data['list_tin_khuyen_mai'] = $list_tin_khuyen_mai;
            $data['videos'] = $videos;
            return view('news.index', $data);
        }
        return "";

    }


    /*--Xem ở getPostCategory bên SiteController--*/
    /*
    public function filter(Request $request, $post) {
        $data['page_title']       = $post->title . ' • NguyenCongPC';
        $data['page_description']       = $post->description;
        $data['post'] = $post;
        $data['postCategory'] = $post->getCategory();
        $data['homePosts'] = Post::getHomePosts(12);
        return view('news.detail', $data);
    }
    */


    public function detail(Request $request) {
        $id = $request->get('id');
        return view('news.detail');
    }

    public function search(Request $request, $term = null) {
        $cate_tin_tuc_noi_bat = PostCategory::findByUri('tin-tuc-noi-bat');
        $list_tin_tuc_noi_bat = Post::getQuery()->where('is_home', 1)->orderBy('id', 'desc')->paginate(5);
        $data['list_tin_tuc_noi_bat'] = $list_tin_tuc_noi_bat;
        if($term == null) {
            $term = $request->get('q');
        } else {
            $term = str_replace('-', ' ', $term);
        }
        if($term) {
            $query = $this->client->createSelect();
            $query->setQuery('title:"'.$term.'~3"');
            $query->setRows(20);
            $page = intval($request->get('page', 1));
            $page = $page > 0 ? $page : 1;
            $query->setStart(($page - 1) * 20);
            $resultset = $this->client->select($query);
            $list_id = array();
            // show documents using the resultset iterator
            foreach ($resultset as $doc) {
                $list_id[] = $doc->id;
            }
            $items = Post::getByIds($list_id);
            $totalResult = $resultset->getNumFound();
            $data['result'] = new LengthAwarePaginator($items, $totalResult, 20, $page);
            $data['term'] = $term;
            $data['page_title']       = "Kết quả tìm kiếm thông tin công nghệ, thủ thuật, tư vấn theo từ khóa {$term} - NguyenCongPC";
            $data['page_description']       = "Thông tin công nghệ, thủ thuật, tư vấn về máy tính đồ họa, pc gaming, review các sản phẩm công nghệ mới nhất năm ".date('Y');
            return view('news.search', $data);
        }

    }

    public function suggestByKeyword(Request $request, $term = null){
        if($term == null) {
            $term = $request->get('q');
        } else {
            $term = str_replace('-', ' ', $term);
        }
        if($term){
            $query = $this->client->createSelect();
            $query->setQuery('title:"'.$term.'~3"');
            $query->setRows(5);
            $query->setStart(0);
            $resultSet = $this->client->select($query);
            $list_id = array();
            // show documents using the resultset iterator
            foreach ($resultSet as $doc) {
                $list_id[] = $doc->id;
            }
            $data['result'] = Post::getByIds($list_id);
            return view('news.search_suggest', $data);
        }
        return '';
    }


}
