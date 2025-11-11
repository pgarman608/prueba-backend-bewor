<?php

namespace Tests\OptimaCultura\Company\Application;

use Tests\TestCase;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;
use OptimaCultura\Company\Domain\Company;
use OptimaCultura\Company\Domain\ValueObject\CompanyStatus;
use OptimaCultura\Company\Application\CompanyCreator;
use OptimaCultura\Company\Application\CompanyActivator;
use Tests\OptimaCultura\Company\Infrastructure\CompanyRepositoryFake;
use OptimaCultura\Company\Application\CompanyLister;

final class ActiveCompanyTest extends TestCase
{
    /**
     * Compruebo que se puede activa la compañia correctamente recogiendo
     * una compañia inactiva de las compañias de prueba.
     * @group application
     * @group company
     * @test
     */
    #[Test]
    public function activeComapany()
    {
        /**
         * Preparing
         */
        $repo = new CompanyRepositoryFake();
        $activator = new CompanyActivator($repo);
        $lister = new CompanyLister($repo);
        $testCompany = null;

        /**
         * Actions
         */
        $companies = $lister->handle();
        $testCompany = $this->getInactiveCompany($companies);
        if (null === $testCompany) {
            $this->fail("No inactive company found to test activation.");
        }
        $companyActivator = $activator->handle($testCompany->id());
        /**
         * Assert
         */
        $this->assertInstanceOf(Company::class, $companyActivator);
        $this->assertNotEquals($testCompany->status()->code(), $companyActivator->status()->code());
    }
    /**
     * Obtener una compañia inactiva de un array de compañias
     * @return ?Company / Compañia inactiva o null si no hay ninguna
     * @param Company[] / Array de compañias
     */
    private function getInactiveCompany(array $companies): ?Company
    {
        $companyRecord = null;
        foreach ($companies as $company) {
            if ($company->status()->code() == CompanyStatus::DISABLED) {
                $companyRecord = $company;
                break;
            }
        }
        return $companyRecord;
    }
}
