<?php
namespace nick4fake\Primes;

/**
 * Splitter.
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
class Util
{
    /**
     * Возвращает канонический вид числа
     *
     * @param integer $number
     * @return array
     * @throws \Exception
     */
    public static function getPrimes($number)
    {
        if (in_array($number, [0, 1])) {
            // TODO: не знаю, что тут должно быть
            return [];
        }
        if (!(is_int($number) && $number > 1)) {
            throw new \Exception('Wrong number: ' . $number);
        }

        $ret = [];

        $lastNum = 2;
        while ($number > 1) {
            if (!isset($ret[$lastNum])) {
                $ret[$lastNum] = 0;
            }
            if ($number % $lastNum === 0) {
                $ret[$lastNum]++;
                $number /= $lastNum;
                continue;
            }

            $lastNum = gmp_intval(gmp_nextprime($lastNum));
            if ($lastNum > $number) {
                throw new \Exception('Infinite cycle! ' . $lastNum . ' > ' . $number);
            }
        }

        return $ret;
    }

    /**
     * Возвращает число после запятой в виде целого
     *
     * @param float $number
     * @return integer
     * @throws \Exception
     */
    public static function getNumberAfterDot($number)
    {
        if ($number == 0) {
            return 0;
        }
        $num = abs($number);
        if ($num >= 1) {
            throw new \Exception('Wrong number: ' . $num);
        }

        while ($num != round($num)) {
            $num *= 10;
        }

        return (int)($num * $number / abs($number));
    }
} 