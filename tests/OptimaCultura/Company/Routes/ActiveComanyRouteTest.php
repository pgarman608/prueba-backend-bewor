<?php

namespace Tests\OptimaCultura\Company\Routes;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class ActiveComanyRouteTest extends TestCase
{
    /**
     * Compruebo que se puede activar una compañia a través de la ruta correspondiente.
     * @group route
     * @group access-interface
     * @test
     */
    #[Test]
    public function activeCompanyRoute()
    {
        /**
         * Preparing
         */
        $faker = \Faker\Factory::create();
        $response = $this->json('GET', '/api/companies');
        $companies = $response->json();
        $testCompany = null;
        foreach ($companies as $company) {
            if ($company['status'] === 'inactive') {
                $testCompany = $company;
                break;
            }
        }
        if (null === $testCompany) {
            $testCompany = [
                'name'   => $faker->name,
                'email'  => $faker->email,
                'address'=> $faker->address,
                'status' => "inactive",
            ];
            $response = $this->json('POST', '/api/company', [
                'name' => $testCompany['name'],
                'email' => $testCompany['email'],
                'address' => $testCompany['address'],
                'status' => $testCompany['status'],
            ]);
            $responseData = $response->json();
            $testCompany['id'] = $responseData['id'];
        }
        /**
         * Actions
         */
        $response = $this->json('POST', '/api/company/active', ['id' => $testCompany['id']]);
        /**
         * Asserts
         */
        $response->assertStatus(201)
            ->assertJsonFragment(['id' => $testCompany['id']])
            ->assertJsonFragment(['status' => 'active']);
        
    }
}

