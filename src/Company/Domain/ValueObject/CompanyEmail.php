<?php

namespace OptimaCultura\Company\Domain\ValueObject;

final class CompanyEmail
{
    private string $value;

    public function __construct(string $name)
    {
        $this->value = $name;
    }

    public function get(): string
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->value;
    }
}
