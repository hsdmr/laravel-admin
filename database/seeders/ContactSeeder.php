<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    public function run()
    {
        $contact = new Contact;
        $contact->address = '';
        $contact->phone = '';
        $contact->cell = '';
        $contact->email = '';
        $contact->map = 'Ayasofya';
        $contact->zoom = '13';
        $contact->save();
    }
}
