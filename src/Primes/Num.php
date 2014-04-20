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
     * @param float $number
     */
    public function __construct(
        $number
    ) {
        // TODO: float
        $this->number = (int)$number;

        $this->initPrimes();
    }

    protected $primes = [];

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
        return $this->primes;
    }
} 