<?php

namespace App\Support;

use App\Support\MarkdownImgPreUrl\ImgPreUrlExtension;
use Illuminate\Support\HtmlString;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment;
use League\CommonMark\Extension\Autolink\AutolinkExtension;
use League\CommonMark\Extension\Table\TableExtension;
use Zoon\CommonMark\Ext\YouTubeIframe\YouTubeIframeExtension;

class Markdown
{
    /**
     * Parse the given Markdown text into HTML.
     *
     * @param  string  $text
     *
     * @return HtmlString
     */
    public static function parse(string $text): HtmlString
    {
        $environment = Environment::createCommonMarkEnvironment();

        $environment->addExtension(new TableExtension());
        $environment->addExtension(new AutolinkExtension());
        $environment->addExtension(new YouTubeIframeExtension());
        $environment->addExtension(new ImgPreUrlExtension());


        $converter = new CommonMarkConverter([
            'html_input'         => 'escape',
            'allow_unsafe_links' => false,
            // commonmark-ext-youtube-iframe
            'youtube_iframe_width' => 600,
            'youtube_iframe_height' => 300,
            'youtube_iframe_allowfullscreen' => true,
            // img-pre-url
            'img_pre_url-pre_url' => '/storage/article_image/',
        ], $environment);

        return new HtmlString($converter->convertToHtml($text ?? ''));
    }
}
