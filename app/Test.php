<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Test extends Model
{
    public $tries = 5;
    /**
     * Create a new job instance.
     *
     * @return user
     */
    public function __construct(User $user)
    {
        //dd($user);
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        return $this->user->email;
    }
}
