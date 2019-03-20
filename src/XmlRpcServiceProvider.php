<?php
/**
 * Created by PhpStorm.
 * User: kay
 * Date: 2019/3/20
 * Time: 3:46 PM
 */
namespace Polaris\XmlRpc;

use Illuminate\Support\ServiceProvider;
use Polaris\XmlRpc\Eloquent\SupervisorClientEloquent;

class XmlRpcServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/config/supervisor.php' => config_path('supervisor.php'),
            ], 'xmlrpc-config');

            $this->commands([
                Console\SupervisorClientCommand::class,
            ]);
        }
    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            SupervisorClientInterface::class,
            SupervisorClientEloquent::class
        );
    }

    /**
     * 获取由提供者提供的服务.
     *
     * @return array
     */
    public function provides()
    {
        return [
            SupervisorClientInterface::class
        ];
    }
}
