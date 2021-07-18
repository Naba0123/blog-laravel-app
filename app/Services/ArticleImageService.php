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
        return \File::files($path);
    }

    public function saveImage(UploadedFile $file)
    {
        $path = 'public/article_image';
        $file->store($path);
    }
}
