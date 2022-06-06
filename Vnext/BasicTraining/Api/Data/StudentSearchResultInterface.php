<?php

namespace Vnext\BasicTraining\Api\Data;

/**
 * Interface CustomSearchResultInterface
 * @package Vnxet\BasicTraining\Api\Data
 */
interface StudentSearchResultInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \Vnext\BasicTraining\Api\Data\StudentInterface[]
     */
    public function getItems();

    /**
     * @param \Vnext\BasicTraining\Api\Data\StudentInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
