<?php

namespace Vnext\BasicTraining\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;
//use Magento\Tests\NamingConvention\true\string;

/**
 * Interface CustomInterface
 * @package ViMagento\CustomApi\Api\Data
 */
interface StudentInterface extends ExtensibleDataInterface
{
    /**
     * @return int
     */
    public function getEntityId();

    /**
     * @param int $entityId
     * @return $this
     */
    public function setEntityId($entityId);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name);

    /**
     * @return int
     */
    public function getGender();

    /**
     * @param int $gender
     * @return $this
     */
    public function setGender(int $gender);

    /**
     * @return string
     */
    public function getDob();

    /**
     * @param string $dob
     * @return $this
     */
    public function setDob($dob);

    /**
     * @return string
     */
    public function getAddress();

    /**
     * @param string $address
     * @return $this
     */
    public function setAddress(string $address);

    /**
     * @return string
     */
    public function getSlug();

    /**
     * @param string $slug
     * @return $this
     */
    public function setSlug(string $slug);

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email);

    /**
     * @return string
     */
    public function getCreatedAt();

    /**
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt);
}
