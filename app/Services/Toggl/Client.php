<?php

namespace App\Services\Toggl;

use DateTime;
use Illuminate\Support\Facades\Http;

class Client
{
    private string $email;
    private string $password;
    private string $base_url = 'https://api.track.toggl.com/api/v9/me';

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function getTasks(DateTime $start_date, Datetime $end_date): array
    {
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode($this->email . ':' . $this->password)
        ])->get($this->base_url . '/time_entries', [
            'end_date' => $end_date->format('Y-m-d'),
            'start_date' => $start_date->format('Y-m-d')
        ]);
        $data = $response->json();
        $tasks = [];
        foreach ($data as $task) {
            $tasks[] = new Task(new DateTime($task['start']), new DateTime($task['stop']), $task['duration'], $task['description']);
        }
        return $tasks;
    }
}
