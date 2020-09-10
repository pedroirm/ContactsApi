<?php

use App\Contact;
use Illuminate\Database\Seeder;

class ContactTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Contact::class, 5)->create(); 
        // Contact::create([
        //     'name' => 'Vitoria',
        //     'email' => 'vitoriahellen19@icloud.com'
        // ]);
    }
}
