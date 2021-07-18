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
    public function getImageNames(): array
    {
        $path = storage_path('app/public/article_image');
        $files = \File::files($path);

        $ret = [];
        foreach ($files as $file) {
            $ret[] = $file->getFilename();
        }

        return $ret;
    }

    public function saveImage(UploadedFile $file)
    {
        $path = 'public/article_image';
        $file->store($path);
    }
}
