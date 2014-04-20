<?php
namespace nick4fake\Command;

use nick4fake\Primes\Num;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * TestCommand.
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
class TestCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('primes:test')
            ->setDescription('Greet someone')
            ->addArgument('num1')
            ->addArgument('num2');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ) {
        $output->writeln('Primes test started.');
        $output->writeln('');

        $num1 = new Num((float)$input->getArgument('num1'));
        $num2 = new Num((float)$input->getArgument('num2'));
        // TODO: float
        $maxNum = (int)max($num1->getNumber(), $num2->getNumber());

        // Primes table
        $pTable = $this->formatPrimesTable($maxNum);

        // Show basic number info
        $this->outputNumberInfo($output, $num1, $pTable, $maxNum);
        $this->outputNumberInfo($output, $num2, $pTable, $maxNum);

        $output->writeln('End.');
    }

    protected function outputNumberInfo(
        OutputInterface $output,
        Num $num,
        $pTable,
        $maxNum
    ) {
        $output->write('Primes of number');
        $output->write('<<fg=yellow;options=bold>' . $num->getNumber() . '</fg=yellow;options=bold>>');
        $output->writeln(' :');

        // Show primes table
        $output->writeln('<fg=cyan>' . $pTable . '</fg=cyan>');

        // Show number table
        $format = $this->formatNumberPrimes($num->getPrimes(), $maxNum);
        $output->writeln('<fg=white>' . $format . '</fg=white>');

        $output->writeln('');
    }

    protected function formatNumberPrimes(array $primes, $maxNum)
    {
        $prime = 1;
        $padlen = strlen((int)$maxNum);

        $ret = [];
        do {
            $int = isset($primes[$prime]) ? $primes[$prime] : 0;
            $intNotZero = $int > 0;
            $int = str_pad($int, $padlen, ' ');
            if($intNotZero) {
                $int = '<fg=green>' . $int . '</fg=green>';
            }
            $ret[] = $int;
        } while (($prime = gmp_intval(gmp_nextprime($prime))) <= $maxNum);

        return join(',', $ret);
    }

    protected function formatPrimesTable($maxNum)
    {
        $prime = 1;
        $padlen = strlen((int)$maxNum);

        $ret = [];
        do {
            $ret[] = str_pad($prime, $padlen, ' ');
        } while (($prime = gmp_intval(gmp_nextprime($prime))) <= $maxNum);

        return join(',', $ret);
    }
}