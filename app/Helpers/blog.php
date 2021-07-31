<?php

use Illuminate\Support\ViewErrorBag;

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
        return \App\Support\Markdown::parse($body)->toHtml();
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
    function omit_markdown_str(string $str, int $width = 300, string $marker = '……'): string
    {
        return mb_strimwidth(strip_tags(markdown_to_html($str)), 0, $width, $marker, 'UTF-8');
    }
}

if (!function_exists('invalid_validation')) {
    /**
     * セッション情報に対象フォーム名のバリデーション失敗が入っていれば is-invalid を返す
     *
     * @param string $name
     * @param string $bagName
     * @return string
     */
    function invalid_validation(string $name, string $bagName = 'default'): string
    {
        /** @var ViewErrorBag|null $errors */
        $errors = session('errors');
        if (is_null($errors) || !$errors->getBag($bagName)->has($name)) {
            return '';
        }
        return 'is-invalid';
    }
}

if (!function_exists('image_url')) {
    /**
     * 画像のURL取得
     *
     * @param \Symfony\Component\Finder\SplFileInfo $image
     * @return string
     */
    function image_url(\Symfony\Component\Finder\SplFileInfo $image): string
    {
        return \Storage::disk('article_image')->url($image->getFilename() . '?' . $image->getMTime());
    }
}

if (!function_exists('header_image_url')) {
    /**
     * ヘッダー画像のURL取得
     * 画像がなければ空文字が返る
     *
     * @return string
     */
    function header_image_url(): string
    {
        $filename = config('blog.design.header_image_filename');
        if (\Storage::disk('public')->exists($filename)) {
            return \Storage::disk('public')->url($filename);
        }
        return '';
    }
}

