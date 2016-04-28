<?php
// +----------------------------------------------------------------------
// |	@desc       Class SdkServiceProvider.php
// +----------------------------------------------------------------------
// |	@author     jinyifeng
// +----------------------------------------------------------------------
// |	@package    ktkt
// +----------------------------------------------------------------------
// |	@version    $Id:SdkServiceProvider.php v1.0 16/4/27 下午2:58 $
// +----------------------------------------------------------------------

namespace Kekek\Sdk;

use Illuminate\Support\ServiceProvider;

class SdkServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot() {
        $this->package('kekek/sdk');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $this->app->bind('sdk', function()
        {
            return Sdk::instance();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return array('sdk');
    }

}