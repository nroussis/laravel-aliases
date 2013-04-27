<?php namespace DaveJamesMiller\Aliases;

use Illuminate\Console\Command;
use Illuminate\Foundation\AliasLoader;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class AliasesCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'aliases';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'List registered aliases and the classes they map to, including resolving facades';

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
		$filter = $this->argument('filter');
		$verbose = $this->option('verbose');

		$aliasLoader = AliasLoader::getInstance();
		$first = true;

		foreach ($aliasLoader->getAliases() as $alias => $class) {

			// If a filter is given, only display aliases that start with that substring
			if ($filter && stripos($alias, $filter) !== 0)
				continue;

			// Put a blank line between each one
			if ($first)
				$first = false;
			else
				$this->line('');

			// Display the alias name
			$this->comment($alias);

			// Display the class that this alias maps to and all of its parents
			$type = 'alias ';
			while ($class) {

				if ($verbose)
					$this->line("<info>$type ></info> $class");
				else
					$this->line("<info>-></info> $class");

				// If it's a Facade (but only the top-level class, not a custom subclass),
				// find the class it resolves to which does all the real work
				if (get_parent_class($class) == 'Illuminate\Support\Facades\Facade') {
					$class = get_class($class::getFacadeRoot());
					$type = 'facade';
				}

				// Otherwise look for a parent class
				else {
					$class = get_parent_class($class);
					$type = 'parent';
				}
			}
		}
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('filter', InputArgument::OPTIONAL, 'An alias name or prefix to filter by, case-insensitive. e.g. "re" for Redirect, Request, etc.'),
		);
	}

}
