<?php

namespace App\Services\Asana;

class User
{
    private string $gid;

    private string $email;

    private array $workspaces;

    /**
     * @param string $gid
     * @param string $email
     * @param array $workspaces
     */
    public function __construct(string $gid, string $email, array $workspaces)
    {
        $this->gid = $gid;
        $this->email = $email;
        $this->workspaces = $workspaces;
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
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return array
     */
    public function getWorkspaces(): array
    {
        return $this->workspaces;
    }

}
