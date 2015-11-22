<?php

namespace App\Mapper;

use App\Model\EntityInterface;

interface EntityMapperInterface
{
    /**
     * @param int $id
     * @return EntityInterface
     */
    public function find($id);

    /**
     * @return EntityInterface[]
     */
    public function findAll();

    /**
     * @param array $criteria
     * @return EntityInterface[]
     */
    public function findBy(array $criteria);

    /**
     * @param EntityInterface $entity
     * @return EntityInterface
     */
    public function save(EntityInterface $entity);

    /**
     * @param EntityInterface $entity
     * @return bool
     */
    public function delete(EntityInterface $entity);

    /**
     * @param array $row
     * @return EntityInterface
     */
    public function createEntity(array $row);
}

