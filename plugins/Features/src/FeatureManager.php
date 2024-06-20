<?php
declare(strict_types=1);

namespace Features;

use InvalidArgumentException;

class FeatureManager
{
    protected array $features = [];

    /**
     * Constructor
     *
     * Create a feature manager and define a collection of features.
     *
     * @param array<\Features\Feature> $config Feature configuration
     */
    public function __construct(
        protected array $config = []
    ): void {
    }

    /**
    * Add a feature to the manager. Will overwrite existing config.
    */
    public function add(string $name, array $config)
    {
        $this->config[$name] = $config;
        unset($this->features[$name]);
    }

    public function has(string $name, array $context): bool
    {
        $feature = $this->get($name);
    }

    public function get(string $name): Feature
    {
        if (isset($this->features[$name])) {
            return $this->features[$name];
        }
        if (!isset($this->config[$name])) {
            throw new InvalidArgumentException("Unknown feature {$name}");
        }
        $config = $this->config[$name];
        $this->features[$name] = Feature::fromArray($name, $config);

        return $this->features[$name];
    }
}
