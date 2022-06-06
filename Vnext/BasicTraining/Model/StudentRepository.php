<?php

namespace Vnext\BasicTraining\Model;

use Vnext\BasicTraining\Api\Data\StudentInterface;
use Vnext\BasicTraining\Model\ResourceModel\Student\Collection;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;

/**
 * Class CustomManagement
 * @package ViMagento\CustomApi\Model
 */
class StudentRepository implements \Vnext\BasicTraining\Api\StudentRepositoryInterface
{
    /**
     * @var \Vnext\BasicTraining\Model\StudentFactory
     */
    protected $studentFactory;

    /**
     * @var ResourceModel\Student
     */
    protected $studentResource;

    /**
     * @var ResourceModel\Student\CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var \Vnext\BasicTraining\Api\Data\StudentSearchResultInterfaceFactory
     */
    protected $searchResultInterfaceFactory;

    /**
     * CustomRepository constructor.
     * @param \Vnext\BasicTraining\Model\StudentFactory $studentFactory
     * @param ResourceModel\Student $studentResource
     * @param ResourceModel\Student\CollectionFactory $collectionFactory
     * @param \Vnext\BasicTraining\Api\Data\StudentSearchResultInterfaceFactory $searchResultInterfaceFactory
     */
    public function __construct(
        \Vnext\BasicTraining\Model\StudentFactory $studentFactory,
        \Vnext\BasicTraining\Model\ResourceModel\Student $studentResource,
        \Vnext\BasicTraining\Model\ResourceModel\Student\CollectionFactory $collectionFactory,
        \Vnext\BasicTraining\Api\Data\StudentSearchResultInterfaceFactory $searchResultInterfaceFactory
    ) {
        $this->studentFactory = $studentFactory;
        $this->studentResource = $studentResource;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultInterfaceFactory = $searchResultInterfaceFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($id)
    {
        $studentModel = $this->studentFactory->create();
        $this->studentResource->load($studentModel, $id);
        if (!$studentModel->getEntityId()) {
            throw new NoSuchEntityException(__('Unable to find custom data with ID "%1"', $id));
        }
        return $studentModel;
    }

    /**
     * {@inheritdoc}
     */
    public function save(StudentInterface $vimagento)
    {
        $this->studentResource->save($vimagento);
        return $vimagento;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($id)
    {
        try {
            $studentModel = $this->studentFactory->create();
            $this->studentResource->load($studentModel, $id);
            $this->studentResource->delete($studentModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(
                __('Could not delete the entry: %1', $exception->getMessage())
            );
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();

        $this->addFiltersToCollection($searchCriteria, $collection);
        $this->addSortOrdersToCollection($searchCriteria, $collection);
        $this->addPagingToCollection($searchCriteria, $collection);

        $collection->load();

        return $this->buildSearchResult($searchCriteria, $collection);
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param Collection $collection
     */
    private function addFiltersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            $fields = $conditions = [];
            foreach ($filterGroup->getFilters() as $filter) {
                $fields[] = $filter->getField();
                $conditions[] = [$filter->getConditionType() => $filter->getValue()];
            }
            $collection->addFieldToFilter($fields, $conditions);
        }
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param Collection $collection
     */
    private function addSortOrdersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        foreach ((array)$searchCriteria->getSortOrders() as $sortOrder) {
            $direction = $sortOrder->getDirection() == SortOrder::SORT_ASC ? 'asc' : 'desc';
            $collection->addOrder($sortOrder->getField(), $direction);
        }
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param Collection $collection
     */
    private function addPagingToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        $collection->setPageSize($searchCriteria->getPageSize());
        $collection->setCurPage($searchCriteria->getCurrentPage());
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param Collection $collection
     * @return mixed
     */
    private function buildSearchResult(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        $searchResults = $this->searchResultInterfaceFactory->create();

        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}
