<?php

namespace Portfolio\CoreBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

class DeleteAllPortfolioCommand extends ContainerAwareCommand
{
	protected function configure()
	{
		$this
			->setName('portfolio:delete:all')
			->setDescription('Delete table entries.')
			->setHelp('This command allow to delete all table entries in database')
			->addArgument('entity', InputArgument::REQUIRED, 'Entity Name')
			->addArgument('mdp', InputArgument::REQUIRED, 'Mot de passe')
			;
	}
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$entity = $input->getArgument('entity');
		$mdp = '901030';
		
		$em = $this->getContainer()->get('doctrine')->getManager();
		$em->getRepository('PortfolioCoreBundle:'.$entity)
       				->createQueryBuilder('e')
                    ->delete()
                    ->getQuery()
       				->execute();

		$output->writeln([
		'Attention: Supprimer toute la table '.$entity.'...',
		'============',
		'============',
		]);

		$output->writeln(sprintf("Successfully deleted!"));

		$output->writeln([
		'============',
		'============',
		'End Deleting',
		]);

	}
}