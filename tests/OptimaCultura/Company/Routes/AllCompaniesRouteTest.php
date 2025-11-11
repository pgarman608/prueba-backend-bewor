<?php

namespace Tests\OptimaCultura\Company\Routes;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class AllCompaniesRouteTest extends TestCase
{
    /**
     * @group route
     * @group access-interface
     * @test
     */
    #[Test]
    public function allCompaniesRoute()
    {
        /**
         * Preparing
         */
        
        $faker = \Faker\Factory::create();
        $testCompany = [
            'name'   => $faker->name,
            'email'  => $faker->email,
            'address'=> $faker->address,
            'status' => "inactive",
        ];

        /**
         * Actions
         */

        $this->json('post', '/api/company', $testCompany)->assertStatus(201);;
        $response = $this->json('GET', '/api/companies');

        /**
         * Asserts
         */

        $response->assertStatus(201)
            ->assertJsonFragment(['name' => $testCompany['name']])
            ->assertJsonStructure([['id', 'name', 'email', 'address', 'status']]);
    }
}

