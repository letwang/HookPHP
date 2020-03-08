<?php
namespace Hook\Batch;

class Insert
{

    public string $sql = 'INSERT INTO `test` VALUES';

    public int $sqlCount = 1;

    public int $sqlCountMax = 100;

    public array $sqlArray = [];

    public int $childCount = 1;

    public int $childCountMax = 10000;

    public array $childArray = [];

    public array $data = [];

    public array $status = [];

    public string $functionFormatSql = 'formatSql';

    public string $functionRunSql = 'runSql';

    public function __construct(array $array)
    {
        $this->data = $array;
    }

    public function __destruct()
    {
        $this->data = null;
    }

    public function run()
    {
        foreach ($this->data as $row) {
            $this->childArray[] = call_user_func($this->functionFormatSql, $row);
            if ($this->childCount ++ >= $this->childCountMax) {
                $this->sqlArray[] = $this->sql . join(',', $this->childArray);
                if ($this->sqlCount ++ >= $this->sqlCountMax) {
                    $this->status[] = ($this->childCount - 1) * ($this->sqlCount - 1);
                    
                    call_user_func($this->functionRunSql, $this->sqlArray);
                    
                    $this->sqlCount = 1;
                    $this->sqlArray = [];
                }
                $this->childCount = 1;
                $this->childArray = [];
            }
        }
        
        if ($this->childArray) {
            $this->sqlArray[] = $this->sql . join(',', $this->childArray);
            $this->childArray = null;
        }
        
        if ($this->sqlArray) {
            $this->status[] = $this->childCountMax * ($this->sqlCount - 1) + ($this->childCount - 1);
            
            call_user_func($this->functionRunSql, $this->sqlArray);
            
            $this->sqlArray = null;
        }
        
        return $this->status;
    }
}
