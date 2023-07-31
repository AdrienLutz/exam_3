<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Entity\User;

// ----- code d'Amazir -----
#[AsCommand(
    name: 'Outdated',
    description: 'Supprime les comptes avec une date de sortie dépassée',
)]
class OutdatedCommand extends Command
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $repository = $this->entityManager->getRepository(User::class);
        $currentDate = new \DateTime();

        $terminatedAccounts = $repository->createQueryBuilder('user')
            ->where('user.date_sortie <= :currentDate')
            ->setParameter('currentDate', $currentDate)
            ->getQuery()
            ->getResult();

        foreach ($terminatedAccounts as $account) {
            $this->entityManager->remove($account);
        }

        $this->entityManager->flush();

        $output->writeln('Grâce à Amazir, les comptes dont le contrat est terminé ont été supprimés.');

        return Command::SUCCESS;
    }
}

// ----- tentative perso de commande -----

//#[AsCommand(
//    name: 'Outdated',
//    description: 'Add a short description for your command',
//)]
//class OutdatedCommand extends Command
//{
//    protected function configure(): void
//    {
//        $this
//            ->addOption('Karim', null, InputOption::VALUE_REQUIRED, 'Delete outdated user')
//        ;
//    }
//
//    protected function execute(InputInterface $input, OutputInterface $output): int
//    {
//
//        $temp = $input->getOption('Karim');
//        $output->write($temp);
//
//        return Command::SUCCESS;
//    }
//}