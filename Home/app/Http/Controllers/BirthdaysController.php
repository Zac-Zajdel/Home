<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Contact;
use Illuminate\Support\Facades\DB;

class BirthdaysController extends Controller
{
    public function index()
    {
        $contacts = request()->user()->contacts()->birthdays()->get();

        return Contact::collection($contacts);
    }
}