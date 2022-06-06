<?php

namespace Vnext\BasicTraining\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Module\Setup\Migration;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class AddDataStudent implements DataPatchInterface
{
    private $student;

    public function __construct(
        \Vnext\BasicTraining\Model\StudentFactory $student
    ) {
        $this->student = $student;
    }

    public function apply()
    {
        $sampleData = [
            [
                'name' => 'Vu Hai Duong',
                'gender' => '0',
                'dob' => '1998-6-23',
                'address' => 'Mai Dich - HN',
                'slug' => 'Duong',
                'email' => 'duong@gmail.com'
            ],
            [
                'name' => 'Nguyen Viet Dan',
                'gender' => '0',
                'dob' => '1999-6-23',
                'address' => 'My Dinh - HN',
                'slug' => 'Dan',
                'email' => 'dan@gmail.com'
            ],
            [
                'name' => 'Luong Thanh Toan',
                'gender' => '0',
                'dob' => '1998-6-23',
                'address' => 'Nhon - HN',
                'slug' => 'Toan',
                'email' => 'toan@gmail.com'
            ],
            [
                'name' => 'Nguyen Dieu Hoa',
                'gender' => '1',
                'dob' => '1998-6-23',
                'address' => 'Nhon - HN',
                'slug' => 'Hoa',
                'email' => 'hoa@gmail.com'
            ],
            [
                'name' => 'Ngo Sy Lien',
                'gender' => '1',
                'dob' => '1998-6-23',
                'address' => 'Nhon - HN',
                'slug' => 'Lien',
                'email' => 'lien@gmail.com'
            ],
            [
                'name' => 'Nguyen Thu Ha',
                'gender' => '1',
                'dob' => '1998-6-23',
                'address' => 'Nhon - HN',
                'slug' => 'Ha',
                'email' => 'ha@gmail.com'
            ]
        ];
        foreach ($sampleData as $data) {
            $this->student->create()->setData($data)->save();
        }
    }

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }

}
