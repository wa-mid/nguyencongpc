<?xml version="1.0" encoding="UTF-8"?>

<?xml-stylesheet type="text/xsl" href="/sitemap.xsl"?>
<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    <url>
        <loc>{{url('/')}}</loc>
        <lastmod>{{date('Y-m-d')}}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1</priority>
    </url>

    <url>
        <loc>{{url('/xay-dung-cau-hinh')}}</loc>
        <lastmod>{{date('Y-m-d')}}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>{{url('/cua-hang')}}</loc>
        <lastmod>{{date('Y-m-d')}}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>{{url('/san-pham-khuyen-mai')}}</loc>
        <lastmod>{{date('Y-m-d')}}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1</priority>
    </url>
    @foreach($categories as $category)
        <url>
            <loc>{{$category->getDetailLink()}}</loc>
            <lastmod>{{date('Y-m-d')}}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
    @foreach($products as $product)
        <url>
            <loc>{{$product->getDetailLink()}}</loc>
            <lastmod>{{date('Y-m-d')}}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.5</priority>
        </url>
    @endforeach
    <url>
        <loc>{{url('/tin-tuc')}}</loc>
        <lastmod>{{date('Y-m-d')}}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.5</priority>
    </url>
    @foreach($postCategories as $postCategory)
        <url>
            <loc>{{$postCategory->getDetailLink()}}</loc>
            <lastmod>{{date('Y-m-d')}}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.5</priority>
        </url>
    @endforeach
    @foreach($posts as $post)
        <url>
            <loc>{{$post->getDetailLink()}}</loc>
            <lastmod>{{date('Y-m-d')}}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.3</priority>
        </url>
    @endforeach
	@foreach($tags as $tag)
        <url>
            <loc>{{$tag->getDetailLink()}}</loc>
            <lastmod>{{date('Y-m-d')}}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.3</priority>
        </url>
    @endforeach
</urlset>