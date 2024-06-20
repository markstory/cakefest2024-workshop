<?php
declare(strict_types=1);

namespace Features;

use Closure;
use InvalidArgumentException;
use RuntimeException;

class FeatureManager
{
    protected array $features = [];

    /**
     * Constructor
     *
     * Create a feature manager and define a collection of features.
     * Use `config` to pass in an array of feature configuration.
     * The keys should be feature names, and values a collection of segments, and conditions.
     *
     * @param \Closure $contextBuilder A closure that transforms a basic array into a `FeatureContext`.
     * @param array<string, mixed> $config Feature configuration to add on load.
     */
    public function __construct(
        protected Closure $contextBuilder,
        protected array $config = [],
    ) {
    }

    /**
    * Add a feature to the manager. Will overwrite existing config.
    */
    public function add(string $name, array $config)
    {
        $this->config[$name] = $config;
        unset($this->features[$name]);

        return $this;
    }

    public function has(string $name, array $context = []): bool
    {
        $feature = $this->get($name);
        $builder = $this->contextBuilder;
        $featureContext = $builder($context);
        if (!($featureContext instanceof FeatureContext)) {
            throw new RuntimeException("Generated context for {$name} is invalid.");
        }

        return $feature->match($featureContext);
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

    public function reset(): void
    {
        $this->features = [];
        $this->config = [];
    }
}
