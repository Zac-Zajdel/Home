<?php

namespace Tests\Feature;

use App\User;
use App\Contact;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BirthdaysTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function birthdays_in_current_month_are_fetched()
    {
        $this->withoutExceptionHandling();
      
        $user = factory(User::class)->create();

        $birthdayContact = factory(Contact::class)->create([
          'user_id' => $user->id,
          'birthday' => now()->subYear()
        ]);

        $noBirthday = factory(Contact::class)->create([
          'user_id' => $user->id,
          'birthday' => now()->subMonth()
        ]);

        $this->get('/api/birthdays?api_token=' . $user->api_token)
        ->assertJsonCount(1);
    }
}