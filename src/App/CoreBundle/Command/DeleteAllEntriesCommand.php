<?php

namespace App\CoreBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

class DeleteAllEntriesCommand extends ContainerAwareCommand
{
	protected function configure()
	{
		$this
			->setName('app:delete:all')
			->setDescription('Delete table entries.')
			->setHelp('This command allow to delete all table entries in database')
			->addArgument('entity', InputArgument::REQUIRED, 'Entity Name')
			->addArgument('mdp', InputArgument::REQUIRED, 'Mot de passe')
			;
	}
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$entity = $input->getArgument('entity');
		$mdp = 'Tiks';
		
		$em = $this->getContainer()->get('doctrine')->getManager();
		$em->getRepository('AppCoreBundle:'.$entity)
       				->createQueryBuilder('e')
                    ->delete()
                    ->getQuery()
       				->execute();

		$output->writeln([
		'Attention: Supprimer toute la table '.$entity.'...',
		'============',
		'============',
		]);

		$output->writeln(sprintf("Supprimé avec succès!"));

		$output->writeln([
		'============',
		'============',
		'End Deleting',
		]);

	}
}