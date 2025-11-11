<?php

namespace OptimaCultura\Company\Application;

use OptimaCultura\Company\Domain\Company;
use OptimaCultura\Company\Domain\CompanyRepositoryInterface;
use OptimaCultura\Shared\Domain\Interfaces\ServiceInterface;

class CompanyLister implements ServiceInterface
{
    private CompanyRepositoryInterface $repository;

    public function __construct(CompanyRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return Company[]
     */
    public function handle(): array
    {
        return $this->repository->findAll();
    }
}