<?php

namespace FindDotTorrent;

class Key
{
    protected $id;
    protected $public_key;
    protected $private_key;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getPublicKey()
    {
        return $this->public_key;
    }

    public function setPublicKey($public_key)
    {
        $this->public_key = $public_key;

        return $this;
    }

    public function getPrivateKey()
    {
        return $this->private_key;
    }

    public function setPrivateKey($private_key)
    {
        $this->private_key = $private_key;

        return $this;
    }
}
