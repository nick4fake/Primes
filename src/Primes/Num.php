<?php
namespace nick4fake\Primes;

/**
 * Num.
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
class Num
{
    protected $number;

    /**
     * @param float    $number
     * @param bool|int $numberCap
     */
    public function __construct(
        $number,
        $numberCap = false
    ) {
        // TODO: стремно это, убрать
        if (!$number) {
            if ($numberCap) {
                $number = mt_rand(2, $numberCap);
            }
        }

        // TODO: float
        $this->number = (int)$number;
    }

    protected $primes = null;

    protected function initPrimes()
    {
        $num = floor($this->number);
        $pr1 = Util::getPrimes((int)$num);
        $num = Util::getNumberAfterDot($this->number - $num);
        $pr2 = Util::getPrimes((int)$num);

        foreach ($pr2 as $i => $val) {
            if (!isset($pr1[$i])) {
                $pr1[$i] = 0;
            }

            $pr1[$i] -= $val;
        }

        $this->primes = $pr1;
    }

    protected $primePeriod = null;

    protected function initPrimePeriod()
    {
        // TODO: float
        $num = (int)$this->number;
        $primes = Util::getPrimes($num);

        $ret = $i = 0;
        foreach ($primes as $occur) {
            $i++;
            $ret += $i * $occur;
        }
        $this->primePeriod = $ret;
    }

    // -- Accessors ---------------------------------------

    /**
     * @return float
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @return array
     */
    public function getPrimes()
    {
        if ($this->primes === null) {
            $this->initPrimes();
        }
        return $this->primes;
    }

    /**
     * @return int
     */
    public function getPrimePeriod()
    {
        if ($this->primePeriod === null) {
            $this->initPrimePeriod();
        }
        return $this->primePeriod;
    }
} 