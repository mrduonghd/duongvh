<?php
namespace Vnext\BasicTraining\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class SomeCommand
 */
class StudentListCommand extends Command
{
//    const NAME = 'name';
    protected $studentCollection;
    protected $scopeConfig;

    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->setName('my:first:command');
        $this->setDescription('This is my first console command.');
//        $this->addOption(
//            self::NAME,
//            null,
//            InputOption::VALUE_REQUIRED,
//            'Name'
//        );

        parent::configure();
    }

    public function __construct(
        \Vnext\BasicTraining\Model\ResourceModel\Student\CollectionFactory $studentCollection,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        string $name = null
    )
    {
        $this->studentCollection = $studentCollection;
        $this->scopeConfig = $scopeConfig;
        parent::__construct($name);
    }

    /**
     * Execute the command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return null|int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $collection = $this->studentCollection->create();
        foreach ($collection as $coll) {
            $name = $this->slug($coll->getName());
            $id = $coll->getEntityId();
            $coll->setSlug($name.'-'.$id);
            $coll->save();
        }
        $output->writeln('<info>Success Message.</info>');
    }

    function slug($text)
    {
        $divider = '-';
        // replace non letter or digits by divider
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, $divider);

        // remove duplicate divider
        $text = preg_replace('~-+~', $divider, $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }
        return $text;
    }
}
