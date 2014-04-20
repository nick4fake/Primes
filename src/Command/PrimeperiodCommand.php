<?php
namespace nick4fake\Command;

use Keboola\Csv\CsvFile;
use nick4fake\Primes\Num;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * PrimeperiodCommand.
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
class PrimeperiodCommand extends Command
{
    protected $outdir;

    /**
     * @param string $outdir
     */
    public function __construct(
        $outdir
    ) {
        $this->outdir = $outdir;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('nick4fake:primes:period')
            ->addArgument('num');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ) {
        $output->writeln('Primes period.');
        $output->writeln('');

        $maxNum = (int)$input->getArgument('num');

        $ret = [];
        $csv = new CsvFile($this->outdir . '/primperiod.csv');
        for ($i = 1; $i <= $maxNum; $i++) {
            $num = new Num($i);
            $csv->writeRow([$i, $num->getPrimePeriod()]);
            $ret[] = $num->getPrimePeriod();
        }

        $output->write('RAW list: ');
        $output->writeln(join(',', $ret));
        $output->writeln('');

        $output->writeln('CSV saved: ' . $csv->getFilename());
        $output->writeln('');

        $output->writeln('End.');
    }
} 