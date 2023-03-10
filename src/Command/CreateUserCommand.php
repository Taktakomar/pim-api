<?php
// src/Command/CreateUserCommand.php



namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Process\Process;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Service\SftpInSftpOutService;

class CreateUserCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'zebi:fik';
    private $sftpinSftpoutService;
    public function __construct(SftpInSftpOutService $sftpinSftpoutService)
    {
        $this->sftpinSftpoutService = $sftpinSftpoutService;
        parent::__construct();
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // ... put here the code to create the user

        // this method must return an integer number with the "exit status code"
        // of the command. You can also use these constants to make code more readable

        // return this if there was no problem running the command
        // (it's equivalent to returning int(0))
        //$input = $env;
        //$process->start();
        //ECHO $this->projectDir;
       $this->sftpinSftpoutService->createFileByFlowId(1);
        
      
      // $output->writeln(getcwd());
        // or return this if some error happened during the execution
        // (it's equivalent to returning int(1))
         return Command::SUCCESS;

        // or return this to indicate incorrect command usage; e.g. invalid options
        // or missing arguments (it's equivalent to returning int(2))
        // return Command::INVALID
    }
}