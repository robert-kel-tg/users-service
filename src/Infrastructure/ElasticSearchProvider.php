<?php

namespace Robertke\User\Infrastructure;

namespace EasyBib\Service\Elastica;
use Elasticsearch\Client;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Application;
/**
 * Exposes an Elastica client through Pimple to Silex
 */
class ElasticSearchServiceProvider implements ServiceProviderInterface
{
    /** @var string */
    protected $prefix;
    /**
     * Creates the service provider with a prefix name
     *
     * @param string $prefix All pimple keys will be prefixed with this
     */
    public function __construct($prefix = 'elastic')
    {
        if (empty($prefix)) {
            throw new \InvalidArgumentException("The specified prefix is not valid");
        }
        $this->prefix = $prefix;
    }
    /**
     * {@inheritDoc}
     */
    public function register(Container $app)
    {
        $prefix = $this->prefix;
        if (!isset($app["$prefix.client_options"])) {
            $app["$prefix.client_options"] = array();
        }
        $app["$prefix"] = $app->share(function () use ($app, $prefix) {
            return new Client($app["$prefix.client_options"]);
        });
    }
    /**
     * {@inheritDoc}
     */
    public function boot(Application $app)
    {
    }
}