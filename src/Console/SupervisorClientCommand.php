<?php
/**
 * Supervisor 连接客户端
 * User: kay
 * Date: 2019/3/20
 * Time: 3:46 PM
 */

namespace Polaris\XmlRpc\Console;

use Illuminate\Console\Command;
use Polaris\XmlRpc\SupervisorClientInterface;

class SupervisorClientCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'supervisor:run {method} {--options=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a client xmlrpc';
    /**
     * @var string
     */
    protected $method;
    /**
     * @var string
     */
    protected $options;
    /**
     * @var ClientInterface
     */
    protected $client;
    /**
     * @var string
     */
    private $defaultMethod = 'system.listMethods';

    /**
     * XmlRpcClientCommand constructor.
     * @param SupervisorClientInterface $client
     */
    public function __construct(SupervisorClientInterface $client)
    {
        parent::__construct();
        $this->client = $client;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->method = $this->argument('method');
        $this->options = $this->option('options');

        $this->method = $this->method ?: $this->defaultMethod;

        $this->exec();
    }

    /**
     * 执行
     */
    protected function exec()
    {
        $options = explode(",", $this->options)?:[];

        $result = $this->client->exec($this->method, $options);

        $this->info('Success');
    }
}