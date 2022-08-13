<?php

namespace App\Services\Asana;

use Illuminate\Support\Facades\Http;

class Client
{
    private string $access_token;
    private string $base_url = 'https://app.asana.com/api/1.0';

    public function __construct(string $access_token)
    {
        $this->access_token = $access_token;
    }

    public function getYourself(): User
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token
        ])->get($this->base_url . '/users/me');
        $data = $response->json()['data'];
        $workspaces = [];
        foreach ($data['workspaces'] as $workspace) {
            $workspaces[] = new Workspace($workspace['gid'], $workspace['name']);
        }
        return new User($data['gid'], $data['email'], $workspaces);
    }

    public function getTasks(string $workspace_gid, string $user_gid, int $workspace_index): array
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token
        ])->get($this->base_url . '/tasks', [
            'workspace' => $workspace_gid,
            'assignee' => $user_gid
        ]);
        $data = $response->json()['data'];
        $tasks = [];
        foreach ($data as $task) {
            $tasks[] = new Task($task['gid'], $task['name'], "https://app.asana.com/$workspace_index/$user_gid/" . $task['gid']);
        }
        return $tasks;
    }
}
