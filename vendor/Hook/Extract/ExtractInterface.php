<?php
declare(strict_types=1);

namespace Hook\Extract;

interface ExtractInterface
{

    public function getList();

    public function getFileContent($index);

    public function getFileName($index);

    public function getFileStat($index);

    public function getFileExtension($index);

    public function extractTo($dir, $index);
}