<?php

/**
 * Log类
 * @author 刘健 <code.liu@qq.com>
 */

namespace mix\base;

class Log extends Object
{

    // 轮转规则
    const ROTATE_HOUR = 0;
    const ROTATE_DAY = 1;
    const ROTATE_WEEKLY = 2;

    // 日志文件路径
    public $logRotate = self::ROTATE_DAY;

    // 最大文件尺寸
    public $maxFileSize = 2048;

    // 写入错误信息
    public function error($message)
    {
        $this->write('error', $message);
    }

    // 写入
    public function write($type, $message)
    {
        switch ($this->logRotate) {
            case self::ROTATE_HOUR:
                $timeFormat = date('YmdH');
                break;
            case self::ROTATE_DAY:
                $timeFormat = date('Ymd');
                break;
            case self::ROTATE_WEEKLY:
                $timeFormat = date('YW');
                break;
            default :
                $timeFormat = date('Ymd');
                break;
        }
        $filename = "{$type}_{$timeFormat}";
        $dir = \Mix::$app->getRuntimePath() . 'logs';
        $path = $dir . DS . $filename . '.log';
        if(filesize($path) >= $this->maxFileSize * 1024){
            $path = $dir . DS . $filename . '.log';
        }
        if (!is_dir($dir)) {
            mkdir($dir);
        }
        file_put_contents($path, $message, FILE_APPEND);
    }

}