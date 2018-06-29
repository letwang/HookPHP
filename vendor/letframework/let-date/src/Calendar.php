<?php
namespace Let\Date;

class Calendar
{
    public static $MIN_YEAR = 1891;
    public static $MAX_YEAR = 2100;

    public static $YEAR = ['零','一','二','三','四','五','六','七','八','九'];
    public static $MONTH = ['','正月','二月','三月','四月','五月','六月','七月','八月','九月','十月','冬月','腊月'];
    public static $DATE = [
        '','初一','初二','初三','初四','初五','初六','初七','初八','初九','初十','十一','十二','十三','十四','十五',
        '十六','十七','十八','十九','二十','廿一','廿二','廿三','廿四','廿五','廿六','廿七','廿八','廿九','三十','卅一'
    ];
    public static $ZODIAC = ['猴','鸡','狗','猪','鼠','牛','虎','兔','龙','蛇','马','羊'];
    public static $SKY = ['庚','辛','壬','癸','甲','乙','丙','丁','戊','己'];
    public static $EARTH = ['申','酉','戌','亥','子','丑','寅','卯','辰','巳','午','未'];

    //[闰月的月数,农历正月对应的公历月份,农历初一对应的公历天数]
    public static $LUNARINFO = [
        [0,2,9,21936],[6,1,30,9656],[0,2,17,9584],[0,2,6,21168],[5,1,26,43344],[0,2,13,59728],
        [0,2,2,27296],[3,1,22,44368],[0,2,10,43856],[8,1,30,19304],[0,2,19,19168],[0,2,8,42352],
        [5,1,29,21096],[0,2,16,53856],[0,2,4,55632],[4,1,25,27304],[0,2,13,22176],[0,2,2,39632],
        [2,1,22,19176],[0,2,10,19168],[6,1,30,42200],[0,2,18,42192],[0,2,6,53840],[5,1,26,54568],
        [0,2,14,46400],[0,2,3,54944],[2,1,23,38608],[0,2,11,38320],[7,2,1,18872],[0,2,20,18800],
        [0,2,8,42160],[5,1,28,45656],[0,2,16,27216],[0,2,5,27968],[4,1,24,44456],[0,2,13,11104],
        [0,2,2,38256],[2,1,23,18808],[0,2,10,18800],[6,1,30,25776],[0,2,17,54432],[0,2,6,59984],
        [5,1,26,27976],[0,2,14,23248],[0,2,4,11104],[3,1,24,37744],[0,2,11,37600],[7,1,31,51560],
        [0,2,19,51536],[0,2,8,54432],[6,1,27,55888],[0,2,15,46416],[0,2,5,22176],[4,1,25,43736],
        [0,2,13,9680],[0,2,2,37584],[2,1,22,51544],[0,2,10,43344],[7,1,29,46248],[0,2,17,27808],
        [0,2,6,46416],[5,1,27,21928],[0,2,14,19872],[0,2,3,42416],[3,1,24,21176],[0,2,12,21168],
        [8,1,31,43344],[0,2,18,59728],[0,2,8,27296],[6,1,28,44368],[0,2,15,43856],[0,2,5,19296],
        [4,1,25,42352],[0,2,13,42352],[0,2,2,21088],[3,1,21,59696],[0,2,9,55632],[7,1,30,23208],
        [0,2,17,22176],[0,2,6,38608],[5,1,27,19176],[0,2,15,19152],[0,2,3,42192],[4,1,23,53864],
        [0,2,11,53840],[8,1,31,54568],[0,2,18,46400],[0,2,7,46752],[6,1,28,38608],[0,2,16,38320],
        [0,2,5,18864],[4,1,25,42168],[0,2,13,42160],[10,2,2,45656],[0,2,20,27216],[0,2,9,27968],
        [6,1,29,44448],[0,2,17,43872],[0,2,6,38256],[5,1,27,18808],[0,2,15,18800],[0,2,4,25776],
        [3,1,23,27216],[0,2,10,59984],[8,1,31,27432],[0,2,19,23232],[0,2,7,43872],[5,1,28,37736],
        [0,2,16,37600],[0,2,5,51552],[4,1,24,54440],[0,2,12,54432],[0,2,1,55888],[2,1,22,23208],
        [0,2,9,22176],[7,1,29,43736],[0,2,18,9680],[0,2,7,37584],[5,1,26,51544],[0,2,14,43344],
        [0,2,3,46240],[4,1,23,46416],[0,2,10,44368],[9,1,31,21928],[0,2,19,19360],[0,2,8,42416],
        [6,1,28,21176],[0,2,16,21168],[0,2,5,43312],[4,1,25,29864],[0,2,12,27296],[0,2,1,44368],
        [2,1,22,19880],[0,2,10,19296],[6,1,29,42352],[0,2,17,42208],[0,2,6,53856],[5,1,26,59696],
        [0,2,13,54576],[0,2,3,23200],[3,1,23,27472],[0,2,11,38608],[11,1,31,19176],[0,2,19,19152],
        [0,2,8,42192],[6,1,28,53848],[0,2,15,53840],[0,2,4,54560],[5,1,24,55968],[0,2,12,46496],
        [0,2,1,22224],[2,1,22,19160],[0,2,10,18864],[7,1,30,42168],[0,2,17,42160],[0,2,6,43600],
        [5,1,26,46376],[0,2,14,27936],[0,2,2,44448],[3,1,23,21936],[0,2,11,37744],[8,2,1,18808],
        [0,2,19,18800],[0,2,8,25776],[6,1,28,27216],[0,2,15,59984],[0,2,4,27424],[4,1,24,43872],
        [0,2,12,43744],[0,2,2,37600],[3,1,21,51568],[0,2,9,51552],[7,1,29,54440],[0,2,17,54432],
        [0,2,5,55888],[5,1,26,23208],[0,2,14,22176],[0,2,3,42704],[4,1,23,21224],[0,2,11,21200],
        [8,1,31,43352],[0,2,19,43344],[0,2,7,46240],[6,1,27,46416],[0,2,15,44368],[0,2,5,21920],
        [4,1,24,42448],[0,2,12,42416],[0,2,2,21168],[3,1,22,43320],[0,2,9,26928],[7,1,29,29336],
        [0,2,17,27296],[0,2,6,44368],[5,1,26,19880],[0,2,14,19296],[0,2,3,42352],[4,1,24,21104],
        [0,2,10,53856],[8,1,30,59696],[0,2,18,54560],[0,2,7,55968],[6,1,27,27472],[0,2,15,22224],
        [0,2,5,19168],[4,1,25,42216],[0,2,12,42192],[0,2,1,53584],[2,1,21,55592],[0,2,9,54560]
    ];

    /**
     * 将公历转换为农历
     * @param string $year  公历-年
     * @param string $month 公历-月
     * @param string $date  公历-日
     * @return array
     */
    public static function convertSolarToLunar($year, $month, $date)
    {
        $yearData = self::$LUNARINFO[$year - self::$MIN_YEAR];
        return self::getLunarByBetween(
            $year,
            self::getDaysBetweenSolar($year, $month, $date, $yearData[1], $yearData[2])
        );
    }

    /**
     * 将农历转换为公历
     * @param string $year  农历-年
     * @param string $month 农历-月
     * @param string $date  农历-日
     * @return array
     */
    public static function convertLunarToSolar($year, $month, $date)
    {
        $yearData = self::$LUNARINFO[$year - self::$MIN_YEAR];
        if (strpos($month, '闰') !== false) {
            $month = str_replace('闰', '', $month) + 1;
        } else {
            $leapMonth = self::getLeapMonth($year);
            if ($leapMonth > 0 && $month > $leapMonth) {
                $month += 1;
            }
        }
        $between = self::getDaysBetweenLunar($year, $month, $date);
        $res = mktime(0, 0, 0, $yearData[1], $yearData[2], $year);
        $res = date('Y-m-d', $res + $between * 24 * 60 * 60);
        $day = explode('-', $res);
        return [$day[0], $day[1], $day[2]];
    }

    /**
     * 根据公历月份返回对应农历月份的信息
     * @param string $year
     * @param string $month
     * @return array
     */
    public static function convertSolarMonthToLunar($year, $month)
    {
        $yearData = self::$LUNARINFO[$year - self::$MIN_YEAR];
        $day = self::getSolarMonthDays($year, $month);

        $data = [];
        for ($i = 1; $i <= $day; $i ++) {
            $array = self::getLunarByBetween(
                $year,
                self::getDaysBetweenSolar($year, $month, $i, $yearData[1], $yearData[2])
            );
            $array[] = $year . '-' . $month . '-' . $i;

            $data[$i] = $array;
        }

        return $data;
    }

    /**
     * 根据年份判断次年是否为闰年
     * @param string $year
     * @return boolean
     */
    public static function isLeapYear($year)
    {
        return '1' === date('L', strtotime($year . '-1-1'));
    }

    /**
     * 根据年份获取该年的天干地支
     * @param string $year
     * @return string
     */
    public static function getLunarYearName($year)
    {
        $year = (string) $year;
        return self::$SKY[$year[3]] . self::$EARTH[$year % 12];
    }

    /**
     * 根据年份获取该年的属相
     * @param string $year
     * @return string
     */
    public static function getYearZodiac($year)
    {
        return self::$ZODIAC[$year % 12];
    }

    /**
     * 根据公历年份+月份返回该月份含有的天数
     * @param string $year
     * @param string $month
     * @return int
     */
    public static function getSolarMonthDays($year, $month)
    {
        return cal_days_in_month(CAL_GREGORIAN, $month, $year);
    }

    /**
     * 根据农历年份+月份返回该月份含有的天数
     * @param string $year
     * @param string $month
     * @return int
     */
    public static function getLunarMonthDays($year, $month)
    {
        $monthData = self::getLunarMonths($year);
        return $monthData[$month - 1];
    }

    /**
     * 根据农历年份返回该年里每月含有的天数
     * @param string $year
     * @return array
     */
    public static function getLunarMonths($year)
    {
        $yearData = self::$LUNARINFO[$year - self::$MIN_YEAR];
        $leapMonth = $yearData[0];
        $bit = decbin($yearData[3]);
        $bitArray = [];
        for ($i = 0; $i < strlen($bit); $i ++) {
            $bitArray[$i] = substr($bit, $i, 1);
        }
        for ($k = 0, $klen = 16 - count($bitArray); $k < $klen; $k ++) {
            array_unshift($bitArray, '0');
        }
        $bitArray = array_slice($bitArray, 0, ($leapMonth == 0 ? 12 : 13));
        for ($i = 0; $i < count($bitArray); $i ++) {
            $bitArray[$i] = $bitArray[$i] + 29;
        }
        return $bitArray;
    }

    /**
     * 根据农历年份获得该年的天数
     * @param string $year
     * @return int
     */
    public static function getLunarYearDays($year)
    {
        $monthArray = self::getLunarYearMonths($year);
        $len = count($monthArray);
        return ($monthArray[$len - 1] == 0 ? $monthArray[$len - 2] : $monthArray[$len - 1]);
    }

    /**
     * 根据农历年份返回该年里每月天数递增的数目
     * @param string $year
     * @return array
     */
    public static function getLunarYearMonths($year)
    {
        $monthData = self::getLunarMonths($year);
        $res = [];
        $temp = 0;
        $yearData = self::$LUNARINFO[$year - self::$MIN_YEAR];
        $len = ($yearData[0] == 0 ? 12 : 13);
        for ($i = 0; $i < $len; $i ++) {
            $temp = 0;
            for ($j = 0; $j <= $i; $j ++) {
                $temp += $monthData[$j];
            }
            array_push($res, $temp);
        }
        return $res;
    }

    /**
     * 根据年份获取该年闰几月
     * @param string $year
     * @return int
     */
    public static function getLeapMonth($year)
    {
        return current(self::$LUNARINFO[$year - self::$MIN_YEAR]);
    }

    /**
     * 计算农历日期与正月初一相隔的天数
     * @param string $year
     * @param string $month
     * @param string $date
     * @return int
     */
    public static function getDaysBetweenLunar($year, $month, $date)
    {
        $yearMonth = self::getLunarMonths($year);
        $res = 0;
        for ($i = 1; $i < $month; $i ++) {
            $res += $yearMonth[$i - 1];
        }
        $res += $date - 1;
        return $res;
    }

    /**
     * 计算2个公历日期之间的天数
     * @param string $year
     * @param string $cmonth
     * @param string $cdate
     * @param string $dmonth 农历正月对应的公历月份
     * @param string $ddate  农历初一对应的公历天数
     * @return int
     */
    public static function getDaysBetweenSolar($year, $cmonth, $cdate, $dmonth, $ddate)
    {
        return (int) ceil(
            (mktime(0, 0, 0, $cmonth, $cdate, $year) - mktime(0, 0, 0, $dmonth, $ddate, $year)) / 24 / 3600
        );
    }

    /**
     * 根据距离正月初一的天数计算农历日期
     * @param string $year
     * @param string $between 天数
     * @return array
     */
    public static function getLunarByBetween($year, $between)
    {
        $lunarArray = [];
        $yearMonth = [];
        $t = 0;
        $e = 0;
        $leapMonth = 0;
        $m = '';
        if ($between == 0) {
            array_push($lunarArray, $year, '正月', '初一');
            $t = 1;
            $e = 1;
        } else {
            $year = $between > 0 ? $year : ($year - 1);
            $yearMonth = self::getLunarYearMonths($year);
            $leapMonth = self::getLeapMonth($year);
            $between = $between > 0 ? $between : (self::getLunarYearDays($year) + $between);
            for ($i = 0; $i < 13; $i ++) {
                if ($between == $yearMonth[$i]) {
                    $t = $i + 2;
                    $e = 1;
                    break;
                } else {
                    if ($between < $yearMonth[$i]) {
                        $t = $i + 1;
                        $e = $between - (empty($yearMonth[$i - 1]) ? 0 : $yearMonth[$i - 1]) + 1;
                        break;
                    }
                }
            }
            $m = ($leapMonth != 0 && $t == $leapMonth + 1) ? (
                '闰' . self::getCapitalNum($t - 1, true)
            ) : self::getCapitalNum(
                ($leapMonth != 0 && $leapMonth + 1 < $t ? ($t - 1) : $t), true
            );
            array_push($lunarArray, $year, $m, self::getCapitalNum($e, false));
        }
        array_push($lunarArray, self::getLunarYearName($year));
        array_push($lunarArray, $t, $e);
        array_push($lunarArray, self::getYearZodiac($year));
        array_push($lunarArray, $leapMonth);
        return $lunarArray;
    }

    /**
     * 将数字年份转换为汉字年份
     * @param string $year
     * @return string
     */
    public static function getCapitalYear($year)
    {
        $year = (string) $year;
        return self::$YEAR[$year[0]] . self::$YEAR[$year[1]] . self::$YEAR[$year[2]] . self::$YEAR[$year[3]];
    }

    /**
     * 获取数字月份、数字日期的农历写法
     * @param int $num
     * @param bool $isMonth
     * @return string
     */
    public static function getCapitalNum($num, $isMonth = false)
    {
        if ($isMonth) {
            return self::$MONTH[$num];
        } else {
            return self::$DATE[$num];
        }
    }
}