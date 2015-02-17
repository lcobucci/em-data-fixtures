<?php
namespace Lcobucci\Fixture\Console;

use Doctrine\Fixture\Configuration;
use Doctrine\Fixture\Filter\ChainFilter;
use Doctrine\Fixture\Loader\Loader;
use Symfony\Component\Console\Helper\Helper;

/**
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
class DataFixtureHelper extends Helper
{
    /**
     * @var Loader
     */
    protected $loader;

    /**
     * @var ChainFilter
     */
    protected $filter;

    /**
     * @var Configuration
     */
    protected $configuration;

    /**
     * Class constructor
     *
     * @param Configuration $configuration
     * @param Loader $loader
     * @param ChainFilter $filter
     */
    public function __construct(
        Configuration $configuration,
        Loader $loader,
        ChainFilter $filter = null
    ) {
        $this->configuration = $configuration;
        $this->loader = $loader;
        $this->filter = $filter ?: new ChainFilter();
    }

    /**
     * Retrieve the fixture loader.
     *
     * @return Loader
     */
    public function getLoader()
    {
        return $this->loader;
    }

    /**
     * Retrieve the fixture filter.
     *
     * @return ChainFilter
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * Retrieve the configuration.
     *
     * @return Configuration
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'data-fixtures';
    }
}