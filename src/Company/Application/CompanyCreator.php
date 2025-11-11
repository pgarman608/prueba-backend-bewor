<?php

namespace OptimaCultura\Company\Application;

use OptimaCultura\Company\Domain\Company;
use OptimaCultura\Company\Domain\ValueObject\CompanyId;
use OptimaCultura\Company\Domain\ValueObject\CompanyName;
use OptimaCultura\Company\Domain\ValueObject\CompanyStatus;
use OptimaCultura\Company\Domain\ValueObject\CompanyEmail;
use OptimaCultura\Company\Domain\ValueObject\CompanyAddress;
use OptimaCultura\Company\Domain\CompanyRepositoryInterface;
use OptimaCultura\Shared\Domain\Interfaces\ServiceInterface;

class CompanyCreator implements ServiceInterface
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
     * Crear una compañia
     * Recogermos los datos necesarios para la creación de una compañia,
     * instanciamos el objeto Company y lo guardamos en la base de datos
     * mediante el repositorio.
     * @return Company / Compañia creada
     * @param string $id / ID de la compañia a crear
     * @param string $name / Nombre de la compañia
     * @param string $email / Email de la compañia
     * @param string $address / Dirección de la compañia
     * @param string $status / Estado de la compañia
     */
    public function handle($id, $name , $email, $address, $status): Company
    {
        $company = new Company(
            new CompanyId($id),
            new CompanyName($name),
            CompanyStatus::fromName($status),
            new CompanyEmail($email),
            new CompanyAddress($address),
            
        );

        $this->repository->create($company);

        return $company;
    }
}
