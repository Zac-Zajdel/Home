<?php

namespace Tests\Feature;

use App\User;
use App\Contact;
use Carbon\Carbon;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactsTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    /**
     * Runs at the beginning of the test ensuring a new user is created upon which we can test from.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    /**
     * @test
     *
     * Validates that an individual without a valid api_token cannot enter the application and will be redirected.
     */
    public function unauthenticated_user_redirection()
    {
        $response = $this->post('/api/contacts', array_merge($this->contact_data(), ['api_token' => '']));

        $response->assertRedirect('/login');

        $this->assertCount(0, Contact::all());
    }

    /**
     * @test
     *
     * Validates that an authorized user retrives contact data.
     */
    public function authenticated_user_gathering_contacts()
    {
        $user = factory(User::class)->create();

        $contact = factory(Contact::class)->create(['user_id' => $user->id]);

        $response = $this->get('/api/contacts?api_token=' . $user->api_token);

        $response->assertJsonCount(1)->assertJson([
          'data' => [
            [
              'contact_id' => $contact->id
            ]
          ]
        ]);
    }

    /**
     * @test
     *
     * Validates that only an authenticated user can add contacts to the application
     */
    public function authenticated_user_adds_contact()
    {
        $response = $this->post('/api/contacts', $this->contact_data());

        $contact = Contact::first();

        $this->assertEquals('Testing', $contact->name);
        $this->assertEquals('testing213@gmail.com', $contact->email);
        $this->assertEquals('02/13/1998', $contact->birthday->format('m/d/Y'));
        $this->assertEquals('RIMSYS', $contact->company);
        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJson([
          'data' => [
            'contact_id' => $contact->id,
            'links' => [
              'self' => url('/contacts/' . $contact->id)
            ]
          ]
        ]);
    }

    /**
     * @test
     *
     * Validates that a user is required to supply every field in order to add a contact to their list.
     */
    public function contact_fields_required()
    {
        collect(['name', 'email', 'birthday', 'company'])
      ->each(function ($field) {
          $response = $this->post('/api/contacts', array_merge($this->contact_data(), [$field => '']));
          $response->assertSessionHasErrors($field);
          $this->assertCount(0, Contact::all());
      });
    }

    /**
     * @test
     *
     * Validates that when entering an email for a contact, the email must be valid. Will also be checked on frontend.
     */
    public function contact_email_validation()
    {
        $response = $this->post('/api/contacts', array_merge($this->contact_data(), ['email' => 'INVALID']));

        $response->assertSessionHasErrors('email');
        $this->assertCount(0, Contact::all());
    }

    /**
     * @test
     *
     * Validates that the brithday entered has been Carbonized and is valid.
     */
    public function contact_birthday_validation()
    {
        $this->withoutExceptionHandling();

        $this->post('/api/contacts', array_merge($this->contact_data()));

        $this->assertCount(1, Contact::all());
        $this->assertInstanceOf(Carbon::class, Contact::first()->birthday);
        $this->assertEquals('02-13-1998', Contact::first()->birthday->format('m-d-Y'));
    }

    /**
     * @test
     *
     * Validates the retrieveval of a contact.
     */
    public function contact_retrieval()
    {
        $contact = factory(Contact::class)->create(['user_id' => $this->user->id]);

        $response = $this->get('/api/contacts/' . $contact->id . '?api_token=' . $this->user->api_token);

        $response->assertJson([
          'data' => [
            'contact_id' => $contact->id,
            'name' => $contact->name,
            'email' => $contact->email,
            'birthday' => $contact->birthday->format('m/d/Y'),
            'company' => $contact->company,
            'last_updated' => $contact->updated_at->diffForHumans()
        ]]);
    }

    /**
     * @test
     *
     * Validates that a user can only get their own contacts and not other users contacts.
     */
    public function specific_user_contact_retrieval()
    {
        $contact = factory(Contact::class)->create(['user_id' => $this->user->id]);

        $user2 = factory(User::class)->create();

        $response = $this->get('/api/contacts/' . $contact->id . '?api_token=' . $user2->api_token);
        $response->assertStatus(403);
    }

    /**
     * @test
     *
     * Validates that a contact can be updated
     */
    public function contact_put_method()
    {
        $contact = factory(Contact::class)->create(['user_id' => $this->user->id]);

        $response = $this->put('/api/contacts/' . $contact->id, $this->contact_data());

        $contact = $contact->fresh();
        
        $this->assertEquals('Testing', $contact->name);
        $this->assertEquals('testing213@gmail.com', $contact->email);
        $this->assertEquals('02/13/1998', $contact->birthday->format('m/d/Y'));
        $this->assertEquals('RIMSYS', $contact->company);

        $response->assertStatus(Response::HTTP_OK);
        
        $response->assertJson([
          'data' => [
            'contact_id' => $contact->id,
            'links' => [
              'self' => $contact->path()
            ]
          ]
        ]);
    }

    /**
     * @test
     *
     * Validates that an authorized user can delete a contact
     */
    public function contact_deletion()
    {
        $contact = factory(Contact::class)->create(['user_id' => $this->user->id]);

        $response = $this->delete('/api/contacts/' . $contact->id, ['api_token' => $this->user->api_token]);
        $this->assertCount(0, Contact::all());

        $response->assertStatus(Response::HTTP_NO_CONTENT);
    }

    /**
     * @test
     *
     * Validates that only an authorized user can delete their specific contacts
     */
    public function specific_user_contact_deletion()
    {
        $contact = factory(Contact::class)->create(['user_id' => $this->user->id]);

        $user2 = factory(User::class)->create();

        $response = $this->delete('/api/contacts/' . $contact->id . '?api_token=' . $user2->api_token);
        $response->assertStatus(403);
    }

    // Data to be used with all testing for a users contact list.
    private function contact_data()
    {
        return [
      'name' => 'Testing',
      'email' => 'testing213@gmail.com',
      'birthday' => '02/13/1998',
      'company' => 'RIMSYS',
      'api_token' => $this->user->api_token
    ];
    }
}
