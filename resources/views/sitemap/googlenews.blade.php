<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">
    @foreach ($articles as $article)
        <url>
            <loc>{{ url("article/" . $article->slug) }}</loc>
            <lastmod>{{ $article->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.6</priority>
            <news:news>
                <news:publication>
                    <news:name>{{$article->title}}</news:name>
                    <news:language>en</news:language>
                </news:publication>
                <news:genres>Blog</news:genres>
                <news:publication_date>{{ $article->updated_at->tz('UTC')->toAtomString() }}</news:publication_date>
                <news:title>{{$article->title}}</news:title>
            </news:news>
        </url>
    @endforeach
</urlset>