<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Assign Auto Generatd Tasks to the users Randomly an could be no assigned
        $users = User::all(); //Collection(object)

        //generate 25 Tasks
        for ($i = 0; $i < 25; $i++) {
            $user = $users->random();
            Task::factory()->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
