<?php

namespace App\Services\Toggl;

use App\Services\Helper;
use DateTime;

class Task
{
    private Datetime $start;
    private Datetime $stop;
    private int $duration;
    private string $description;
    private string $link;

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    /**
     * @return DateTime
     */
    public function getStart(): DateTime
    {
        return $this->start;
    }

    /**
     * @return DateTime
     */
    public function getStop(): DateTime
    {
        return $this->stop;
    }

    /**
     * @return int
     */
    public function getDuration(): int
    {
        return $this->duration;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param DateTime $start
     * @param DateTime $stop
     * @param int $duration
     * @param string $description
     */
    public function __construct(DateTime $start, DateTime $stop, int $duration, string $description)
    {
        $this->start = $start;
        $this->stop = $stop;
        $this->duration = $duration;
        $this->description = Helper::cleanString($description);
        $this->link = '';
    }

    /**
     * @param int $duration
     */
    public function setDuration(int $duration): void
    {
        $this->duration = $duration;
    }
}
