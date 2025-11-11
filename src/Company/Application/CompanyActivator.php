<?php

namespace OptimaCultura\Company\Application;

use OptimaCultura\Company\Domain\Company;
use OptimaCultura\Company\Domain\ValueObject\CompanyId;
use OptimaCultura\Company\Domain\ValueObject\CompanyName;
use OptimaCultura\Company\Domain\ValueObject\CompanyStatus;
use OptimaCultura\Company\Domain\CompanyRepositoryInterface;
use OptimaCultura\Shared\Domain\Interfaces\ServiceInterface;

class CompanyActivator implements ServiceInterface
{
    /**
     * @var CompanyRepositoryInterface $repository
     */
    private CompanyRepositoryInterface $repository;

    /**
     * Create new instance
     */
    public function __construct(CompanyRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Activar una compañia por ID
     * Activa una compañia cambiando su estado a ENABLED
     * gracias al repositorio.
     * @return Company / Compañia activada
     * @param string $id / ID de la compañia a activar
     */
    public function handle($id)
    {
        $company = $this->repository->findById($id);
        if (null === $company) {
            throw new \InvalidArgumentException("Company with ID $id not found.");
        }
        $companyRecord = $this->repository->updateActiveStatus($id);
        return $companyRecord;
    }
}