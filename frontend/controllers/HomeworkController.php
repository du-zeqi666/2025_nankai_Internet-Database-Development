<?php
/**
 * Team: DBIS Lab
 * Authors: Member1, Member2, Member3, Member4
 * Date: 2025-12-09
 * Description: Controller for handling homework downloads and display.
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\FileHelper;

class HomeworkController extends Controller
{
    /**
     * Displays the homework download page.
     *
     * @return mixed
     */
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

    /**
     * Download a file.
     *
     * @param string $type 'team' or 'personal'
     * @param string $file filename
     * @return mixed
     */
    public function actionDownload($type, $file)
    {
        $basePath = $type === 'team' ? '@app/../data/team' : '@app/../data/personal';
        $path = Yii::getAlias($basePath) . DIRECTORY_SEPARATOR . $file;

        if (file_exists($path)) {
            return Yii::$app->response->sendFile($path);
        }
        
        throw new \yii\web\NotFoundHttpException("File not found.");
    }

    private function getFiles($path)
    {
        if (!is_dir($path)) {
            FileHelper::createDirectory($path);
        }
        $files = FileHelper::findFiles($path, ['recursive' => false]);
        return array_map('basename', $files);
    }
}
