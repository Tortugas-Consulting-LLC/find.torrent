<?php

namespace FindDotTorrent;

/**
 * Class KeyHandler
 * @package FindDotTorrent
 */
class KeyHandler
{
    /**
     * @var \PDO
     */
    protected $db;

    /**
     * KeyHandler constructor.
     * @param $db
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * @return array
     */
    public function findAll()
    {
        $keys = array();
        $fetch_stmt = $this->db->prepare("SELECT * FROM `keys`");
        $fetch_stmt->execute();
        foreach ($fetch_stmt->fetchAll(\PDO::FETCH_ASSOC) as $row) {
            $key = new Key();
            $key->setId($row["id"]);
            $key->setPublicKey($row["public_key"]);
            $key->setPrivateKey($row["private_key"]);

            $keys[] = $key;
        }

        return $keys;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function find($id)
    {
        foreach ($this->findAll() as $key) {
            if ($id == $key->getId()) {
                return $key;
            }
        }

        return false;
    }

    /**
     * @param $public_key
     * @return bool|mixed
     */
    public function findByPublicKey($public_key)
    {
        foreach ($this->findAll() as $key) {
            if ($public_key == $key->getPublicKey()) {
                return $key;
            }
        }

        return false;
    }

    /**
     * @param Key $key
     * @throws \Exception
     */
    public function persist(Key $key)
    {
        $statement = $this->db->prepare("
            REPLACE INTO `keys` (id, public_key, private_key)
            VALUES (:id, :public_key, :private_key)
        ");
        $result = $statement->execute(array(
            ":id" => $key->getId(),
            ":public_key" => $key->getPublicKey(),
            ":private_key" => $key->getPrivateKey(),
        ));

        if (false === $result) {
            throw new \Exception(var_export($statement->errorInfo(), true));
        }
    }

    /**
     * @param Key $key
     * @throws \Exception
     */
    public function remove($key)
    {
        $statement = $this->db->prepare("
            DELETE FROM `keys` WHERE id = :id
        ");
        $result = $statement->execute(array(
            ":id" => $key->getId(),
        ));

        if (false === $result) {
            throw new \Exception(var_export($statement->errorInfo(), true));
        }
    }

    /**
     * @return Key
     */
    public function generate()
    {
        $key = new Key();

        $key->setPublicKey(hash('sha256', mt_rand()));
        $key->setPrivateKey(hash('sha256', mt_rand()));

        return $key;
    }
}
