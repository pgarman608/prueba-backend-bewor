<?php

namespace OptimaCultura\Company\Domain;

interface CompanyRepositoryInterface
{
    /**
     * Persist a new company instance
     */
    public function create(Company $company): void;
    public function findAll(): array;
    public function findById(string $id): ?Company;
    public function updateActiveStatus(string $id): Company;
}
