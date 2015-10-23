<rss version="2.0"

     xmlns:content="http://purl.org/rss/1.0/modules/content/"
     xmlns:wfw="http://wellformedweb.org/CommentAPI/"
     xmlns:dc="http://purl.org/dc/elements/1.1/"
     xmlns:atom="http://www.w3.org/2005/Atom"
     xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
     xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
    >
    <channel>
        <title><?= $feed_name ?></title>
        <link>
        <?= $feed_url ?></link>
        <atom:link href="<?= $feed_url ?>" rel="self" type="application/rss+xml"/>
        <description><?= $page_description ?></description>
        <language><?= $page_language ?></language>
        <!--        <sy:updatePeriod>hourly</sy:updatePeriod>-->
        <!--        <sy:updateFrequency>1</sy:updateFrequency>-->
        <lastBuildDate></lastBuildDate>
        <webMaster><?= $webmaster ?></webMaster>



        <?php foreach ($list_news as $news) {
            ?>
            <item>
                <title><?= $news->title ?></title>
                <description><?= $news->summary ?></description>
                <dc:creator><?= $author ?></dc:creator>
                <pubDate><?= date(DATE_RSS) ?></pubDate>
                <link>
                <?= base_url() . 'news/administration/read/' . $news->id ?></link>

                <category><![CDATA[<?= $news->fk_source ?>]]></category>
            </item>
        <?php
        }
        ?>
    </channel>
</rss>
