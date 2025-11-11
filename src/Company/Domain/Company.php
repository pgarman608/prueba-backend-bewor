<?php

namespace OptimaCultura\Company\Domain;

use OptimaCultura\Company\Domain\ValueObject\CompanyId;
use OptimaCultura\Company\Domain\ValueObject\CompanyName;
use OptimaCultura\Company\Domain\ValueObject\CompanyStatus;
use OptimaCultura\Company\Domain\ValueObject\CompanyEmail;
use OptimaCultura\Company\Domain\ValueObject\CompanyAddress;
use OptimaCultura\Shared\Infrastructure\Interfaces\Arrayable;

final class Company implements Arrayable
{
    /**
     * @var \OptimaCultura\Company\Domain\ValueObject\CompanyId
     */
    private CompanyId $id;

    /**
     * @var \OptimaCultura\Company\Domain\ValueObject\CompanyName
     */
    private CompanyName $name;

    /**
     * @var \OptimaCultura\Company\Domain\ValueObject\CompanyStatus
     */
    private CompanyStatus $status;

    /**
     * @var \OptimaCultura\Company\Domain\ValueObject\CompanyEmail
     */
    private CompanyEmail $email;

    /**
     * He añadido los nuevos atributos address, email y status
     * al constructor.
     * @var \OptimaCultura\Company\Domain\ValueObject\CompanyAddress
     */
    private CompanyAddress $address;
    
    public function __construct(
        CompanyId $id,
        CompanyName $name,
        CompanyStatus $status,
        companyEmail $email,
        companyAddress $address
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->status = $status;
        $this->email = $email;
        $this->address = $address;
    }

    /**
     * Get the company id
     */
    public function id(): CompanyId
    {
        return $this->id;
    }

    /**
     * Get the company name
     */
    public function name(): CompanyName
    {
        return $this->name;
    }

    /**
     * Get the company status
     */
    public function status(): CompanyStatus
    {
        return $this->status;
    }
    /**
     * Get the company Email
     */
    public function email(): CompanyEmail
    {
        return $this->email;
    }
    /**
     * Get the company Address
     */
    public function address(): CompanyAddress
    {   
        return $this->address;
    }
    /**
     * Array representation of the company
     */
    public function toArray()
    {
        return [
            'id'       => $this->id()->get(),
            'name'     => $this->name()->get(),
            'status'   => $this->status()->name(),
            'email'   => $this->email()->get(),
            'address'   => $this->address()->get(),
        ];
    }
}
