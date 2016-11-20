<?php
namespace Let\Svn;

class Svn
{

    public $user;

    public $pass;

    public function __construct($user, $pass)
    {
        $this->user = $user;
        $this->pass = $pass;
    }

    public function info($path)
    {
        $cmd = "svn info $path --xml";
        return new \SimpleXMLElement(implode('', $this->run($cmd)));
    }

    public function log($path)
    {
        $cmd = "svn log $path --xml";
        return new \SimpleXMLElement(implode('', $this->run($cmd)));
    }

    public function diffPath($pathA, $pathB)
    {
        $cmd = "svn diff $pathA $pathB";
        return implode(PHP_EOL, $this->run($cmd));
    }

    public function diffFile($path, $fromVersion, $toRevision = 'HEAD')
    {
        $cmd = "svn diff -r {$fromVersion}:{$toRevision} $path";
        return implode(PHP_EOL, $this->run($cmd));
    }

    public function file_get_contents($path, $version = 'HEAD')
    {
        $cmd = "svn cat -r {$version} $path";
        return implode(PHP_EOL, $this->run($cmd));
    }

    public function ls($path)
    {
        $cmd = "svn list $path";
        return $this->run($cmd);
    }

    public function export($path, $dir, $version = 'HEAD')
    {
        $cmd = "svn export -r {$version} $path $dir";
        return $this->run($cmd);
    }

    public function add($path)
    {
        $cmd = "svn add $path";
        return $this->run($cmd);
    }

    public function copy($src, $dst, $comment)
    {
        $cmd = "svn copy $src $dst -m '$comment'";
        return $this->run($cmd);
    }

    public function delete($path, $comment)
    {
        $cmd = "svn delete $path -m '$comment'";
        return $this->run($cmd);
    }

    public function move($src, $dst, $comment)
    {
        $cmd = "svn move $src $dst -m '$comment'";
        return $this->run($cmd);
    }

    public function mkdir($path, $comment)
    {
        $cmd = "svn mkdir $path -m '$comment'";
        return $this->run($cmd);
    }

    public function checkout($path, $dir, $version = 'HEAD')
    {
        $cmd = "svn checkout -r {$version} $path $dir";
        return $this->run($cmd);
    }

    public function merge($revision, $path, $dir)
    {
        $cmd = "svn merge -r1:$revision $path $dir";
        return $this->run($cmd);
    }

    public function commit($dir, $comment)
    {
        $cmd = "svn commit $dir -m '$comment'";
        return $this->run($cmd);
    }

    public function update($dir, $version = 'HEAD')
    {
        $cmd = "svn update -r {$version} $dir";
        return $this->run($cmd);
    }

    public function status($dir)
    {
        $cmd = "svn status $dir";
        return $this->run($cmd);
    }

    private function run($cmd, $pipe = "")
    {
        $result = [];
        exec($cmd . ' --username ' . $this->user . ' --password ' . $this->pass . ' --no-auth-cache --non-interactive 2>&1' . $pipe, $result);
        return $result;
    }
}
