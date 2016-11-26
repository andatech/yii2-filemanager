<?php

namespace anda\filemanager;

use Yii;

/**
 * KCFinder
 */
class KCFinder
{

    public static function registered()
    {
        $asset = KCFinderAsset::register(Yii::$app->view);

        self::copyHtaccess($asset);

        $r = [
            'filebrowserBrowseUrl' => $asset->baseUrl.'/browse.php?opener=ckeditor&type=files',
            'filebrowserImageBrowseUrl' => $asset->baseUrl.'/browse.php?opener=ckeditor&type=images',
            'filebrowserFlashBrowseUrl' => $asset->baseUrl.'/browse.php?opener=ckeditor&type=flash',
            'filebrowserUploadUrl' => $asset->baseUrl.'/upload.php?opener=ckeditor&type=files',
            'filebrowserImageUploadUrl' => $asset->baseUrl.'/upload.php?opener=ckeditor&type=images',
            'filebrowserFlashUploadUrl' => $asset->baseUrl.'/upload.php?opener=ckeditor&type=flash',
        ];

        return $r;
    }

    protected function copyHtaccess($asset)
    {
//        $uplSource = __DIR__.'/upload.htaccess';
//        $uplDest = $asset->basePath.'/conf/upload.htaccess';
//        copy($uplSource, $uplDest);

        $sesDest = $asset->basePath.'/.htaccess';
        $htfile = fopen($sesDest, "w") or die("Unable to open file!");
        $txt = "<IfModule mod_php5.c>\n";
        $txt .= "   php_value session.name ".Yii::$app->session->name."\n";
        $txt .= "</IfModule>\n";
        fwrite($htfile, $txt);
        fclose($htfile);
    }

}
