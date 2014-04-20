#!/usr/bin/env php
<?php
namespace {
    set_time_limit(0);
    require_once __DIR__ . '/vendor/autoload.php';

    use nick4fake\Command\PrimeperiodCommand;
    use nick4fake\Command\SummationCommand;
    use Symfony\Component\Console\Application;

    $app = new Application();
    $app->add(new SummationCommand());
    $app->add(new PrimeperiodCommand(__DIR__ . '/out'));
    $app->run();
}
