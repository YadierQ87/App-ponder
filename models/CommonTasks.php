<?php
namespace app\models;

class CommonTasks
{
    static function getExtensionIcono($extension)
    {
        if (file_exists(\Yii::$app->basePath . "/web/assets/sitio/imagenes/file-tree/$extension.png"))
            return $extension;
        return "file";
    }
}
