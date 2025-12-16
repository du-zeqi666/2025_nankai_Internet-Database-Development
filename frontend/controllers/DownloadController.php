<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\FileHelper;

/**
 * Team Member: Member D
 * Student ID: [Student ID]
 * Task: 实现作业下载页面
 * Date: 2023-XX-XX
 */
class DownloadController extends Controller
{
    public function actionIndex()
    {
        $teamPath = Yii::getAlias('@app/../data/team');
        $personalPath = Yii::getAlias('@app/../data/personal');

        $teamFiles = $this->getFiles($teamPath);
        $personalFiles = $this->getFiles($personalPath);

        return $this->render('index', [
            'teamFiles' => $teamFiles,
            'personalFiles' => $personalFiles,
        ]);
    }

    public function actionDownload($type, $file)
    {
        $basePath = $type === 'team' ? Yii::getAlias('@app/../data/team') : Yii::getAlias('@app/../data/personal');
        $filePath = $basePath . DIRECTORY_SEPARATOR . $file;

        if (file_exists($filePath) && !is_dir($filePath)) {
            return Yii::$app->response->sendFile($filePath);
        }

        throw new \yii\web\NotFoundHttpException('The requested file does not exist.');
    }

    private function getFiles($path)
    {
        if (!is_dir($path)) {
            return [];
        }
        
        $files = scandir($path);
        $result = [];
        
        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {
                $result[] = $file;
            }
        }
        
        return $result;
    }
}
