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
                'name' => 'Duong',
                'gender' => '0',
                'dob' => '1998-6-23',
                'address' => 'Mai Dich - HN'
            ],
            [
                'name' => 'Dan',
                'gender' => '0',
                'dob' => '1999-6-23',
                'address' => 'My Dinh - HN'
            ],
            [
                'name' => 'Toan',
                'gender' => '0',
                'dob' => '1998-6-23',
                'address' => 'Nhon - HN'
            ],
            [
                'name' => 'Hoa',
                'gender' => '1',
                'dob' => '1998-6-23',
                'address' => 'Nhon - HN'
            ],
            [
                'name' => 'Lien',
                'gender' => '1',
                'dob' => '1998-6-23',
                'address' => 'Nhon - HN'
            ],
            [
                'name' => 'Ha',
                'gender' => '1',
                'dob' => '1998-6-23',
                'address' => 'Nhon - HN'
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
