<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Console\Command;
use DB;

class CreateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:create_sitemap';

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
        $categories = Category::all();
        $products = Product::getQuery()->select('id','slug')->get();
        $postCategories = PostCategory::getCategoriesList(100);
        $posts = Post::getQuery()->select('id','slug')->get();
        $tags = Tag::where('suggest', 1)->select('id','slug')->get();
        $sitemap= view('sitemap.index', [
            'categories' => $categories,
            'products' => $products,
            'postCategories' => $postCategories,
            'posts' => $posts,
            'tags' => $tags,
        ])->render();
        file_put_contents(base_path().'/public/sitemap.xml', $sitemap);
        echo "Done";
    }
}
