<?php

namespace App\Http\Controllers;

use App\Services\Asana\Client as AsanaClient;
use App\Services\Asana\Task as AsanaTask;
use App\Services\Toggl\Client as TogglClient;
use App\Services\Toggl\Task as TogglTask;
use DateTime;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function getReport(Request $request) {
        $dates = explode('-', $request->get('dates'));
        $toggl_client = new TogglClient($request->get('email'), $request->get('password'));
        $asana_client = new AsanaClient($request->get('access_token'));
//        $toggl_client = new TogglClient('anna.ev@profilancegroup.com', 'hym-5hd-6Aw-R6m');
//        $asana_client = new AsanaClient('1/1202623815239502:33bca4b51fc79b052ca2bb953a892d51');
        $toggl_tasks = $toggl_client->getTasks(new DateTime($dates[0]), (new DateTime($dates[1]))->add(\DateInterval::createFromDateString('1 day')));
        $asana_user = $asana_client->getYourself();
        $workspace_index = $this->getIndexWorkspaceByName('ProfilanceGroup', $asana_user->getWorkspaces());
        $asana_tasks = $asana_client->getTasks($asana_user->getWorkspaces()[0]->getGid(), $asana_user->getGid(), $workspace_index);

        /** @var TogglTask $toggl_task */
        foreach ($toggl_tasks as $toggl_task) {
            /** @var AsanaTask $asana_task */
            foreach ($asana_tasks as $asana_task) {
                if (trim($toggl_task->getDescription()) == trim($asana_task->getName())) {
                    $toggl_task->setLink($asana_task->getLink());
                    break;
                }
            }
        }

        $data = [];
        /** @var TogglTask $toggl_task */
        foreach ($toggl_tasks as $toggl_task) {
            $hasTask = false;
            if (isset($data['total']))
                $data['total'] += $toggl_task->getDuration();
            else
                $data['total'] = $toggl_task->getDuration();

            /** @var TogglTask $task */
            if (isset($data['tasks'])) {
                foreach ($data['tasks'] as $task) {
                    if ($task->getDescription() == $toggl_task->getDescription()) {
                        $task->setDuration($task->getDuration() + $toggl_task->getDuration());
                        $hasTask = true;
                        break;
                    }
                }
            }
            if (!$hasTask) {
                $data['tasks'][] = $toggl_task;
            }
        }

        return view('blocks.report', [
            'tasks' => $data['tasks'],
            'total' => $data['total'],
            'dates' => $request->get('dates')
        ]);
    }

    /**
     * @throws \Exception
     */
    private function getIndexWorkspaceByName(string $name, array $workspaces): int {
        foreach ($workspaces as $index => $workspace) {
            if ($name == $workspace->getName()) return $index;
        }
        throw new \Exception('Workspace not found');
    }
}
