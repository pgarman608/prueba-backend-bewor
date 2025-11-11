<?php

namespace Tests\OptimaCultura\Company\Application;

use Tests\TestCase;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;
use OptimaCultura\Company\Domain\Company;
use OptimaCultura\Company\Domain\ValueObject\CompanyStatus;
use OptimaCultura\Company\Application\CompanyCreator;
use OptimaCultura\Company\Application\CompanyLister;
use Tests\OptimaCultura\Company\Infrastructure\CompanyRepositoryFake;
use Illuminate\Foundation\Testing\RefreshDatabase;
final class AllCompaniesTest extends TestCase
{
    /**
     * Compruebo que se pueden listar todas las compañias correctamente.
     * @group application
     * @group company
     * @test
     */

    #[Test]
    public function allCompanies()
    {
        /**
         * Preparing
         */
        $faker = \Faker\Factory::create();
        $repo = new CompanyRepositoryFake();
        $creator = new CompanyCreator($repo);
        $lister = new CompanyLister($repo);
        $testCompany = [
            'id'      => (string) Str::uuid(),
            'name'    => $faker->name,
            'email'   => $faker->email,
            'address' => $faker->address,
            'status'  => 'inactive',
        ];
        /**
         * Actions
         */
        
        $companytested = $creator->handle($testCompany['id'], $testCompany['name'], $testCompany['email'], $testCompany['address'], $testCompany['status']);
        $companies = $lister->handle();
        
        /**
         * Assert
         */
        $this->assertIsArray($companies);
        foreach ($companies as $company) {
            $this->assertInstanceOf(Company::class, $company);
        }
    }
}
