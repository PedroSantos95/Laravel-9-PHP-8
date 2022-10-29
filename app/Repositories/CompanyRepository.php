<?php
namespace App\Repositories;

class CompanyRepository
{
    public function pluck()
    {
        return[
            1 => 'Company 1',
            2 => 'Company 2',
        ];
    }
}