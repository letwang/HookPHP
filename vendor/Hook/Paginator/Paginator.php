<?php
declare(strict_types=1);

namespace Hook\Paginator;

class Paginator
{

    public static function pagination($currentPageNum, $totalCount, $pageUrl = '', $pageSize = 24, $skipCount = 5, $currentStyleName = 'current', $currentUseLink = false, $preText = 'Prev', $nextText = 'Next', $firstText = 'First', $lastText = 'Last')
    {
        $returnValue = '';
        $begin = 1;
        $end = 1;
        $totalpage = floor($totalCount / $pageSize);
        if ($totalCount % $pageSize > 0) {
            $totalpage ++;
        }
        
        $begin = $currentPageNum - $skipCount;
        $end = $currentPageNum + $skipCount;
        
        if ($begin <= 0) {
            $end = $end - $begin + 1;
            $begin = 1;
        }
        
        if ($end > $totalpage) {
            $end = $totalpage;
        }
        
        for ($count = $begin; $count <= $end; $count ++) {
            if ($count == $currentPageNum) {
                if ($currentUseLink) {
                    $returnValue .= '<li class="' . $currentStyleName . '"><a href="' . $pageUrl . $count . '">';
                    $returnValue .= '<span>' . $count . '</span></a></li>';
                } else {
                    $returnValue .= '<li class="' . $currentStyleName . '"><span>' . $count . '</span></li>';
                }
            } else {
                $returnValue .= '<li><a href="' . $pageUrl . $count . '"><span>' . $count . '</span></a></li>';
            }
        }
        
        if ($currentPageNum - $skipCount > 1) {
            $returnValue = '<li class="ellipsis">...</li>' . $returnValue;
        }
        if ($currentPageNum + $skipCount < $totalpage) {
            $returnValue = $returnValue . '<li class="ellipsis">...</li>';
        }
        
        if ($currentPageNum > 1) {
            $returnValue = '<li><a href="' . $pageUrl . ($currentPageNum - 1) . '">';
            $returnValue .= '<span>' . $preText . '</span></a></li>' . $returnValue;
        }
        if ($currentPageNum < $totalpage) {
            $returnValue = $returnValue . '<li><a href="' . $pageUrl . ($currentPageNum + 1) . '">';
            $returnValue .= '<span>' . $nextText . '</span></a></li>';
        }
        if (! empty($firstText) && $currentPageNum > 1) {
            $returnValue = '<li><a href="' . $pageUrl . '1"><span>' . $firstText . '</span></a></li>' . $returnValue;
        }
        if (! empty($lastText) && $currentPageNum < $totalpage) {
            $returnValue = $returnValue . '<li><a href="' . $pageUrl . $totalpage . '">';
            $returnValue .= '<span>' . $lastText . '</span></a></li>';
        }
        return $returnValue;
    }
}