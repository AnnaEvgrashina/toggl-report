<?php

namespace App\Services\Asana;

class Workspace
{
    /**
     * @var string $gid
     */
    private string $gid;

    /**
     * @var string $name
     */
    private string  $name;

    /**
     * @param string $gid
     * @param string $name
     */
    public function __construct(string $gid, string $name)
    {
        $this->gid = $gid;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getGid(): string
    {
        return $this->gid;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
