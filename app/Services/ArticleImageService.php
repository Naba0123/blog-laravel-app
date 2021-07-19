<?php


namespace App\Services;


use Illuminate\Http\UploadedFile;

class ArticleImageService extends AbstractService
{
    /**
     * 画像一覧を取得
     *
     * @return array
     */
    public function getAllImages(): array
    {
        $path = storage_path('app/public/article_image');
        if (!\File::exists($path)) {
            \File::makeDirectory($path);
        }
        return \File::files($path);
    }

    /**
     * 画像保存
     *
     * @param UploadedFile $file
     */
    public function saveImage(?string $filename, UploadedFile $file)
    {
        if ($filename) {
            \Storage::disk('article_image')->putFileAs('', $file, $filename);
        } else {
            \Storage::disk('article_image')->putFile('', $file);
        }
    }

    /**
     * 画像削除
     *
     * @param string $filename
     */
    public function deleteImage(string $filename)
    {
        \Storage::disk('article_image')->delete($filename);
    }
}
