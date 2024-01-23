<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Controllers\ContactController;
use Illuminate\Http\Request;

class ContactFormTest extends TestCase
{
    use WithFaker;

    public function test_contact_form_submits_correctly()
    {
        $controller = new ContactController();
        $request = new Request([
            'name' => 'Test',
            'email' => 'test@example.com',
            'description' => 'This is a test message.',
        ]);

        $response = $this->post(route('contact.store'), $request->all());

        $response->assertRedirect(route('contact.create'));
        $this->assertDatabaseHas('contacts', $request->all());
    }
}
