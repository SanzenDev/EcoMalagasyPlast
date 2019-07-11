<?php

namespace App\CoreBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

class DeleteCommand extends ContainerAwareCommand
{
	protected function configure()
	{
		$this
			->setName('app:delete:one')
			->setDescription('Delete table entries.')
			->setHelp('This command allow to delete all table entries in database')
			->addArgument('repository', InputArgument::REQUIRED, 'Bundle Name')
			->addArgument('field', InputArgument::REQUIRED, 'Champ de la table')
			->addArgument('parameter', InputArgument::REQUIRED, 'Valeur du champ')
			->addArgument('mdp', InputArgument::REQUIRED, 'Mot de passe')
			;
	}
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$repository = $input->getArgument('repository');
		$field = $input->getArgument('field');
		$parameter = $input->getArgument('parameter');
		$mdp = 'Tiks';
		
		$em = $this->getContainer()->get('doctrine')->getManager();
		$em->getRepository($repository)
       				->createQueryBuilder('e')
                    ->where('e.'.$field.' = :parameter')
                    ->setParameter('parameter', $parameter)
                    ->delete()
                    ->getQuery()
       				->execute();

		$output->writeln([
		'Suppression ...',
		'============',
		'Repository Field Parameter',
		'============',
		'Exemple: BiblioBookBundle:Author Enabled true',
		]);

		$output->writeln(sprintf("Deleted Successfully!"));

		$output->writeln([
		'============',
		'============',
		'End Deleting',
		]);

	}
}