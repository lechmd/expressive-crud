<?php

namespace App\Model;

interface EntityInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     * @return self
     * @throws \App\Exception\EntityIdAlreadySetException if id property is already set
     */
    public function setId($id);

    /**
     * @return array
     */
    public function toArray();
}

