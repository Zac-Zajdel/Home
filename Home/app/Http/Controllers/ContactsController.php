<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Contact as ContactResource;

// Returning a contact resource on each endpoint allows for a formatted data response.
// Remember to create a new instance of the resource when returning data to the frontend.
class ContactsController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Contact::class);

        return ContactResource::collection(request()->user()->contacts);
    }

    /**
     * Made possible because a contact belongs to a user and a user has many contacts
     */
    public function store()
    {
        $this->authorize('create', Contact::class);
        
        $contact = request()->user()->contacts()->create($this->contactValidationData());

        return (new ContactResource($contact))
          ->response()
          ->setStatusCode(Response::HTTP_CREATED);
    }

    // Must contact the resource controller to return the specified format
    public function show(Contact $contact)
    {
        $this->authorize('view', $contact);

        return new ContactResource($contact);
    }

    public function update(Contact $contact)
    {
        $this->authorize('update', $contact);

        $contact->update($this->contactValidationData());

        return (new ContactResource($contact))
          ->response()
          ->setStatusCode(Response::HTTP_OK);
    }

    public function destroy(Contact $contact)
    {
        $this->authorize('delete', $contact);

        $contact->delete();

        return response([], Response::HTTP_NO_CONTENT);
    }

    private function contactValidationData()
    {
        return request()->validate([
          'name' => 'required',
          'email' => 'required | email',
          'birthday' => 'required',
          'company' => 'required'
      ]);
    }
}