<?php

if (!function_exists('setting')) {
    /**
     * ブログ設定値を取得
     *
     * @param string $key
     * @return string
     */
    function setting(string $key, string $default = ''): string
    {
        $setting = app(\App\Services\SettingService::class)->getSetting($key);
        return is_null($setting) ? $default : $setting->value;
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

if (!function_exists('omit_markdown_str')) {
    /**
     * 本文を省略したものを返す
     *
     * @param string $str
     * @param int $width
     * @param string $marker
     * @return string
     */
    function omit_markdown_str(string $str, int $width = 100, string $marker = '……'): string
    {
        return mb_strimwidth(strip_tags(markdown_to_html($str)), 0, $width, $marker, 'UTF-8');
    }
}

