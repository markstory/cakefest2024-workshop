<?php
declare(strict_types=1);

namespace App\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\Routing\Router;

/**
 * Routetest command.
 */
class RoutetestCommand extends Command
{
    /**
     * Hook method for defining this command's option parser.
     *
     * @see https://book.cakephp.org/4/en/console-commands/commands.html#defining-arguments-and-options
     * @param \Cake\Console\ConsoleOptionParser $parser The parser to be defined
     * @return \Cake\Console\ConsoleOptionParser The built parser.
     */
    public function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        $parser = parent::buildOptionParser($parser);

        return $parser;
    }

    /**
     * Implement this method with your command's logic.
     *
     * @param \Cake\Console\Arguments $args The command arguments.
     * @param \Cake\Console\ConsoleIo $io The console io
     * @return int|null|void The exit code or null for success
     */
    public function execute(Arguments $args, ConsoleIo $io)
    {
        $start = microtime(true);
        for ($i = 0; $i < 10000; $i++) {
            Router::url(['controller' => 'Organizations', 'action' => 'edit', 'orgslug' => 'acme']);
        }
        $end = microtime(true);
        $elapsed = $end - $start;
        $io->out("10000x Router::url() w/ array params - {$elapsed}");

        $start = microtime(true);
        for ($i = 0; $i < 10000; $i++) {
            Router::url(['_name' => 'orgs:edit', 'orgslug' => 'acme']);
        }
        $end = microtime(true);
        $elapsed = $end - $start;
        $io->out("10000x Router::url() w/ _name - {$elapsed}");

        return self::CODE_SUCCESS;
    }
}
