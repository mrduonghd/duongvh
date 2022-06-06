<?php

namespace Vnext\BasicTraining\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Vnext\BasicTraining\Api\Data\StudentInterface;

/**
 * Interface CustomManagementInterface
 * @package ViMagento\CustomApi\Api
 */
interface StudentRepositoryInterface
{
    /**
     * @param int $id
     * @return \Vnext\BasicTraining\Api\Data\StudentInterface
     */
    public function getById($id);

    /**
     * @param \Vnext\BasicTraining\Api\Data\StudentInterface $vimagento
     * @return \Vnext\BasicTraining\Api\Data\StudentInterface
     */
    public function save(StudentInterface $vimagento);

    /**
     * @param int $id
     * @return bool
     */
    public function deleteById($id);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Vnext\BasicTraining\Api\Data\StudentSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}
