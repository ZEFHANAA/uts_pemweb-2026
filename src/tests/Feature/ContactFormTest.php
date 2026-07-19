<?php

use App\Models\ContactMessage;

it('stores a valid contact message', function () {
    $response = $this->from('/contact')->post('/contact', [
        'name' => 'Visitor Name',
        'email' => 'visitor@example.com',
        'subject' => 'Project discussion',
        'message' => 'Saya ingin berdiskusi mengenai sebuah proyek website.',
    ]);

    $response
        ->assertRedirect('/contact')
        ->assertSessionHas('success');

    $this->assertDatabaseHas('contact_messages', [
        'email' => 'visitor@example.com',
        'subject' => 'Project discussion',
        'status' => 'new',
    ]);
});

it('validates required contact fields', function () {
    $this->from('/contact')
        ->post('/contact', [])
        ->assertRedirect('/contact')
        ->assertSessionHasErrors(['name', 'email', 'subject', 'message']);

    expect(ContactMessage::count())->toBe(0);
});

it('rejects an invalid email and a short message', function () {
    $this->from('/contact')->post('/contact', [
        'name' => 'Visitor Name',
        'email' => 'not-an-email',
        'subject' => 'Hello',
        'message' => 'short',
    ])->assertSessionHasErrors(['email', 'message']);

    expect(ContactMessage::count())->toBe(0);
});

it('rejects a contact message longer than the allowed limit', function () {
    $this->from('/contact')->post('/contact', [
        'name' => 'Visitor Name',
        'email' => 'visitor@example.com',
        'subject' => 'Hello',
        'message' => str_repeat('a', 5001),
    ])->assertSessionHasErrors('message');

    expect(ContactMessage::count())->toBe(0);
});
