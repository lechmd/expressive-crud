<?php

namespace App\Mapper\DoctrineDbal;

use App\Mapper\EntityMapperInterface;
use App\Model\EntityInterface;
use Doctrine\DBAL\Connection;

abstract class AbstractMapper implements EntityMapperInterface
{
    /**
     * @var Connection
     */
    protected $db;

    /**
     * @var string
     */
    protected $tableName;

    /**
     * @param Connection $db
     */
    public function __construct(Connection $db)
    {
        if (!isset($this->tableName)) {
            throw new \LogicException(get_class($this) . ' must define a $tableName');
        }
        $this->db = $db;
    }

    /**
     * @param int $id
     * @return EntityInterface
     */
    public function find($id)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder->select('*')
            ->from($this->tableName)
            ->where('id = ?')
            ->setParameter(0, $id);
        $row = $queryBuilder->execute()->fetch();
        if (!$row) {
            return false;
        }
        $entity = $this->createEntity($row);

        return $entity;
    }

    /**
     * @return EntityInterface[]
     */
    public function findAll()
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder->select('*')
            ->from($this->tableName);
        $rows = $queryBuilder->execute()->fetchAll();
        $entities = [];
        foreach ($rows as $row) {
            $entities[] = $this->createEntity($row);
        }

        return $entities;
    }

    /**
     * @param array $criteria
     * @return EntityInterface[]
     */
    public function findBy(array $criteria = [])
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder->select('*')
            ->from($this->tableName);
        $i = 0;
        foreach ($criteria as $key => $value) {
            if ($i === 0) {
                $queryBuilder->where($key . ' = ?');
            } else {
                $queryBuilder->orWhere($key . ' = ?');
            }
            $queryBuilder->setParameter($i, $value);
            ++$i;
        }

        $rows = $queryBuilder->execute()->fetchAll();
        $entities = [];
        foreach ($rows as $row) {
            $entities[] = $this->createEntity($row);
        }

        return $entities;
    }

    /**
     * @param EntityInterface $entity
     * @return EntityInterface
     */
    public function save(EntityInterface $entity)
    {
        if ($entity->getId()) {
            $this->db->update($this->tableName, $entity->toArray(), ['id' => $entity->getId()]);
        } else {
            $this->db->insert($this->tableName, $entity->toArray());
            $entity->setId($this->db->lastInsertId());
        }

        return $entity;
    }

    /**
     * @param EntityInterface $entity
     * @return bool
     */
    public function delete(EntityInterface $entity)
    {
        return (bool)$this->db->delete($this->tableName, ['id' => $entity->getId()]);
    }

    /**
     * @param array $row
     * @return EntityInterface
     */
    public abstract function createEntity(array $row);
}

