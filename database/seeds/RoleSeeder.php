<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $freelancer = new Role();
        $freelancer->name = "Freelancer";
        $freelancer->description = "Freelancers looking for projects";
        // save it to the database
        $freelancer->save();

        $client = new Role();
        $client->name = "Client";
        $client->description = "Clients posting jobs for freelancers";
        $client->save();
    }
}
