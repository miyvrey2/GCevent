<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<rss version="2.0">
    <channel>
        <title>Gamescomevent.com articles</title>
        <link>https://www.gamescomevent.com</link>
        <description>All articles about gaming and more.</description>
        <language>en_EN</language>
        @foreach ($articles as $article)
<item>
            <title>{{ utf8_encode(html_entity_decode(strip_tags($article->title))) }}</title>
            <link>{{ url("article/" . $article->slug) }}</link>
            <description>{{ utf8_encode(html_entity_decode(strip_tags($article->excerpt))) }}</description>
            <pubDate>{{ $article->published_at }}</pubDate>
        </item>
        @endforeach

    </channel>
</rss>