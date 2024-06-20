<?php
declare(strict_types=1);

namespace Features;

class FeatureContext
{
    /**
     * Constructor
     *
     * @param array<string, mixed> $data the context data.
     */
    public function __construct(
        protected array $data,
    ): void {
    }

    public function get(string $key): mixed
    {
        if (!$this->has($key)) {
            return null;
        }

        return $this->data[$key];
    }

    public function has(string $key): mixed
    {
        return array_key_exists($key, $this->data);
    }

    public function getId(): string
    {
        $string = json_encode($this->data);

        return sha1($string);
    }
}
