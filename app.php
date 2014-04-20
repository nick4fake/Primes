#!/usr/bin/env php
<?php
namespace {
    set_time_limit(0);
    require_once __DIR__ . '/vendor/autoload.php';

    use nick4fake\Command\TestCommand;
    use Symfony\Component\Console\Input\ArgvInput;
    use Symfony\Component\Console\Application;

    $app = new Application();
    $app->add(new TestCommand());
    $app->run();
}
