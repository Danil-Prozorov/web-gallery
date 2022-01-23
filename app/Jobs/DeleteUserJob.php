<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $profile;
    protected $image;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $profile, $image)
    {
        $this->user    = $user;
        $this->profile = $profile;
        $this->image   = $image;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->user->delete();
        $this->profile->delite();
        $this->image->delite();
    }
}
