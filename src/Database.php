<?php


namespace ThreadsAndTrolls;


class Database {

    private static $entityManager;

    /**
     * @param mixed $entityManager
     */
    public static function setEntityManager($entityManager)
    {
        self::$entityManager = $entityManager;
    }

    /**
     * @return EntityManager
     */
    public static function getEntityManager()
    {
        return self::$entityManager;
    }

    public static function getRepository($entity) {
        return self::$entityManager->getRepository($entity);
    }

    public static function save($object) {
        self::$entityManager->persist($object);
        self::$entityManager->flush();
    }

} 