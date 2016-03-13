<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cache;
// use Zendesk\API\HttpClient as Zendesk;
use Flash;
// use Huddle\Zendesk\Services\ZendeskService as Zendesk;
// use App\Facades\Zendesk as Zendesk;
use Facades;
use Huddle\Zendesk\Services\ZendeskService as Zendesk;

class HomeController extends Controller
{

    public function __construct(ZendeskService $zendesk_service) {
        $this->zendesk_service = $zendesk_service;
    }

    public function addTicket() {
        $this->zendesk_service->tickets()->create([
              'subject' => 'Subject',
              'comment' => [
                    'body' => 'Ticket content.'
              ],
              'priority' => 'normal'
        ]);
    }

    public function index() {

        $page_title = "Home";
        $page_description = "This is the home page";

        $ztickets = Zendesk::tickets()->findAll();
        $tickets = $ztickets->tickets;

        $ticket = '';

        return view('home', compact('page_title', 'page_description', 'tickets'));
    }


}
