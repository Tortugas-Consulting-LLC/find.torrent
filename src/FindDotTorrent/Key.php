<?php

namespace FindDotTorrent;

/**
 * Class Key
 * @package FindDotTorrent
 */
class Key
{
    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $public_key;
    /**
     * @var string
     */
    protected $private_key;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPublicKey()
    {
        return $this->public_key;
    }

    /**
     * @param string $public_key
     * @return $this
     */
    public function setPublicKey($public_key)
    {
        $this->public_key = $public_key;

        return $this;
    }

    /**
     * @return string
     */
    public function getPrivateKey()
    {
        return $this->private_key;
    }

    /**
     * @param string $private_key
     * @return $this
     */
    public function setPrivateKey($private_key)
    {
        $this->private_key = $private_key;

        return $this;
    }
}
