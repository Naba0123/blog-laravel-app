<?php

if (!function_exists('carbon_now')) {
    /**
     * 必ず固定時間を返す
     *
     * @return \Carbon\CarbonImmutable
     */
    function carbon_now(): \Carbon\CarbonImmutable
    {
        return app('carbon_now');
    }
}

if (!function_exists('markdown_to_html')) {
    /**
     * マークダウン文章をHTMLに変換する
     *
     * @param string $body
     * @return string
     */
    function markdown_to_html(string $body): string
    {
        return \Illuminate\Mail\Markdown::parse($body)->toHtml();
    }
}

