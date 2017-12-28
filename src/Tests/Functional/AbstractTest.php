<?php

namespace CatalogBundle\Tests\Functional;


use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

abstract class AbstractTest extends WebTestCase
{

    protected static $container;
    protected $mockName = 'productsMocks';
    /**
     * @var ArrayCollection
     */
    protected $mocks = [];

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        require(__DIR__ . '/Mocks.php');
        $this->mocks = $mock;

    }

    public static function setUpBeforeClass()
    {
        //start the symfony kernel
        $kernel = static::createKernel();
        $kernel->boot();

        //get the DI container
        static::$container = $kernel->getContainer();
        static::truncateTablesInDb();
    }

    protected static function truncateTablesInDb(){
        $em = static::$container->get('doctrine.orm.default_entity_manager');
        $connection = $em->getConnection();
        $schemaManager = $connection->getSchemaManager();
        $tables = $schemaManager->listTables();
        $query = '';
        $connection->query('SET FOREIGN_KEY_CHECKS=0');
        foreach($tables as $table) {
            $name = $table->getName();
            $query .= 'TRUNCATE ' . $name . ';';
        }
        $connection->executeQuery($query, array(), array());
        $connection->query('SET FOREIGN_KEY_CHECKS=1');
    }

    public static function createDBForTest($kernel)
    {
        $application = new Application($kernel);
        $application->setAutoExit(false);

        $application->run(new ArrayInput(array(
            'doctrine:schema:drop',
            '--force' => true
        )));

        $input = new ArrayInput(array(
            'command' => 'doctrine:schema:update',
            // (optional) define the value of command arguments
            '--force' => true,
            // (optional) pass options to the command
            '--env' => 'test',
        ));
        echo $input;
        // You can use NullOutput() if you don't need the output
        $output = new BufferedOutput();
        $application->run($input, $output);
        // return the output, don't use if you used NullOutput()
        $content = $output->fetch();
        echo $content;
    }

    /**
     * @return ArrayCollection;
     */
    protected function getMock(string $mockName = ''): ArrayCollection
    {
        if ($mockName) {
            $result = $this->mocks->get($mockName);
        } else {
            $result = $this->mocks->get($this->mockName);
        }
        if (empty($result)) {
            throw new \Exception("No mocks for this test detected");
        }

        return $result;
    }
}