<?php
namespace KodiCMS\Pages\Console\Commands;

use Illuminate\Console\Command;
use KodiCMS\Pages\Model\LayoutCollection;
use Symfony\Component\Console\Helper\TableSeparator;

class RebuldLayoutBlocksCommand extends Command
{

    /**
     * The console command name.
     */
    protected $name = 'cms:layout:rebuild-blocks';

    /**
     * The table headers for the command.
     *
     * @var array
     */
    protected $headers = [
        'Layout',
        'Found blocks',
    ];


    /**
     * Execute the console command.
     */
    public function fire()
    {
        $this->output->writeln('<info>Rebuilding layout blocks...</info>');

        $layouts = [];

        foreach (new LayoutCollection as $layout) {
            $blocks = $layout->findBlocks();

            $blocks = ! empty( $blocks ) ? '{' . implode('} {', $blocks) . '}' : 'null';

            $layouts[] = [$layout->getName(), $blocks];
            $layouts[] = new TableSeparator;
        }

        $this->table($this->headers, $layouts);
    }
}
