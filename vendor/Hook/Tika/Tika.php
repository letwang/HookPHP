<?php
namespace Hook\Tika;

class Tika {
    private static function run($option, $fileName){
        $process = new \Symfony\Component\Process\Process('java -jar tika-app-1.19.jar '.$option.' "'.$fileName.'"');
        $process->setWorkingDirectory(__DIR__);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new \RuntimeException($process->getErrorOutput());
        }

        return $process->getOutput();
    }

    public static function getWordCount($fileName){
        return str_word_count(self::getText($fileName));
    }

    public static function getXHTML($filename){
        return self::run('--xml', $filename);
    }

    public static function getHTML($filename){
        return self::run('--html', $filename);
    }

    public static function getText($filename) {
        return self::run('--text', $filename);
    }

    public static function getTextMain($filename){
        return self::run('--text-main', $filename);
    }

    public static function getMetadata($filename){
        return self::run('--metadata', $filename);
    }

    public static function getJson($filename){
        return self::run('--json', $filename);
    }

    public static function getXmp($filename){
        return self::run('--xmp', $filename);
    }

    public static function getLanguage($filename){
        return self::run('--language', $filename);
    }

    public static function getDocumentType($filename){
        return self::run('--detect', $filename);
    }
}
