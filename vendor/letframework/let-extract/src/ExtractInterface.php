<?php
namespace Let\Extract;

interface ExtractInterface
{

    public function getList();

    public function getFileContent($index);

    public function getFileName($index);

    public function getFileStat($index);

    public function getFileExtension($index);

    public function extractTo($dir, $index);
}