<?php

namespace App\Command;

use App\Service\Robot;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BotCommand extends Command
{
    static protected $defaultName = 'app:move-bot';

    protected function configure()
    {
        $this->addArgument('instructions', InputArgument::REQUIRED, 'Directions for the bot to traverse');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Initialising Bot',
            '===============',
            '',
        ]);

        $bot = new Robot();
        $bot->execute($input->getArgument('instructions'));
        $output->writeln($bot);

        $output->writeln([
            'Completed Bot',
            '===============',
            '',
        ]);
    }


}
