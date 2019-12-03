<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
  public function index()
  {
    return request()->user()->contacts;
  }

  /**
   * Made possible because a contact belongs to a user and a user has many contacts
   */
  public function store()
  {
    request()->user()->contacts()->create($this->contactValidationData());
  }

  public function show(Contact $contact)
  {
    if (request()->user()->isNot($contact->user)) {
      return response([], 403);
    }

    return $contact;
  }

  public function update(Contact $contact)
  {
    if (request()->user()->isNot($contact->user)) {
      return response([], 403);
    }

    $contact->update($this->contactValidationData());
  }

  public function destroy(Contact $contact)
  {
    if (request()->user()->isNot($contact->user)) {
      return response([], 403);
    }

    $contact->delete();
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
