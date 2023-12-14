<?php

namespace Mahmodi\ComputerSimulator\Commands;

use Mahmodi\ComputerSimulator\Hardware\Storage\HardDisk;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class Test extends Command
{
    protected static $defaultName = 'test';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        HardDisk::directory()->create('test');
        dd(HardDisk::directory()->delete('test'));

        $io = new SymfonyStyle($input, $output);

        $io->success('Test done !');

        if($io->confirm('Do you want repeat ?'))
            $this->execute($input, $output);

        return Command::SUCCESS;
    }
}