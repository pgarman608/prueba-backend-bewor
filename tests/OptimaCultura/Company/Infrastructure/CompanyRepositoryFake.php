<?php

namespace Tests\OptimaCultura\Company\Infrastructure;

use OptimaCultura\Company\Domain\Company;
use OptimaCultura\Company\Domain\ValueObject\CompanyId;
use OptimaCultura\Company\Domain\ValueObject\CompanyStatus;
use OptimaCultura\Company\Domain\ValueObject\CompanyName;
use OptimaCultura\Company\Domain\ValueObject\CompanyEmail;
use OptimaCultura\Company\Domain\ValueObject\CompanyAddress;
use OptimaCultura\Company\Domain\CompanyRepositoryInterface;
use App\Models\Company as ModelsCompany;

class CompanyRepositoryFake implements CompanyRepositoryInterface
{
    public bool $callMethodCreate = false;
    public bool $callMethodfindAll = false;

    /**
     * @inheritdoc
     */
    public function create(Company $company): void
    {
        $this->callMethodCreate = true;
    }
    /**
     * Recoge el id de la compañia y devuelve la compañia correspondiente o null si no existe.
     * @inheritDoc
     */
    public function findById(string $id): ?Company
    {
        $companyRecord = ModelsCompany::find($id);
        if (null === $companyRecord) {
            return null;
        }
        return $this->mapToDomain($companyRecord);
    }

    /**
     * Recoge todas las compañias de la base de datos y las devuelve en un array.
     * @inheritDoc
     */

    public function findAll(): array
    {
        $companyRecords = ModelsCompany::all();
        $companies = [];
        foreach ($companyRecords as $companyRecord) {
            $companies[] = $this->mapToDomain($companyRecord);
        }
        return $companies;
    }

    /**
     * Actualiza el estado de una compañia a ENABLED y devuelve la compañia actualizada.
     * @inheritDoc
     */
    
    public function updateActiveStatus(string $id): Company
    {
        $companyRecord = ModelsCompany::find($id);
        $companyRecord->status = CompanyStatus::create(CompanyStatus::ENABLED)->code();
        $companyRecord->save();
        return $this->mapToDomain($companyRecord);
    }

    /**
     * Mapea un registro de la base de datos a un objeto de dominio Company.
     * @param mixed $companyRecord / Registro de la base de datos
     * @return Company / Objeto de dominio Company
     */
    
    private function mapToDomain($companyRecord): Company
    {
        return new Company(
            new CompanyId($companyRecord->id),
            new CompanyName($companyRecord->name),
            CompanyStatus::create($companyRecord->status),
            new CompanyEmail($companyRecord->email),
            new CompanyAddress($companyRecord->address),
        );
    }
}
