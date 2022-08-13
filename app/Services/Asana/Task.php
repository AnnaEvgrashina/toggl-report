<?php

namespace App\Services\Asana;

use App\Services\Helper;

class Task
{
    /**
     * @var string $gid
     */
    private string $gid;

    /**
     * @var string $name
     */
    private string  $name;
    private string $link;

    /**
     * @param string $gid
     * @param string $name
     */
    public function __construct(string $gid, string $name, string $link)
    {
        $this->gid = $gid;
        $this->name = Helper::cleanString($name);
        $this->link = $link;
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

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }
}
