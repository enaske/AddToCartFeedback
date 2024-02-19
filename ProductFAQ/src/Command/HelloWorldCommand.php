<?php declare(strict_types=1);

namespace ProductFAQ\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HelloWorldCommand extends Command{


    protected static $defaultName = 'mage-spark:work';

    protected function configure()
    {
        $this->setDescription("Simply Prints It Works in CLI");
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("It works!");

        return self::SUCCESS;
    }
}