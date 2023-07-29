<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


// ajout
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;


#[AsCommand(
    name: 'Outdated',
    description: 'Add a short description for your command',
)]
class OutdatedCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->addOption('test', null, InputOption::VALUE_REQUIRED, 'Delete outdated user')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $temp = $input->getOption('test');
        $output->write($temp);

        return Command::SUCCESS;
    }
}
