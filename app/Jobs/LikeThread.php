<?php

namespace App\Jobs;

use App\Exceptions\CannotLikeThreadMultipleTimes;
use App\Models\Thread;
use App\User;

class LikeThread
{
    /**
     * @var \App\Models\Thread
     */
    private $thread;

    /**
     * @var \App\User
     */
    private $user;

    /**
     * Create a new job instance.
     *
     * @param \App\Models\Thread $thread
     * @param \App\User $user
     */
    public function __construct(Thread $thread, User $user)
    {
        $this->thread = $thread;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws \App\Exceptions\CannotLikeThreadMultipleTimes
     */
    public function handle()
    {
        if ($this->thread->isLikedBy($this->user)) {
            throw new CannotLikeThreadMultipleTimes();
        }

        $this->thread->likedBy($this->user);
    }
}
