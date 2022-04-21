<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return response(Ticket::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        validator(request()->all(), [
            'subject' => "required",
            'content' => "required",
            'status_id' => "required",
        ])->validate();

        $ticket = Ticket::create([
            "subject" => request("subject"),
            "content" => request("content"),
            "status_id" => request("status_id"),
            "user_id" => $request->user()->id,
        ]);

        return response($ticket, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Ticket $ticket
     * @return Response
     */
    public function show(Ticket $ticket): Response
    {
        return response($ticket);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Ticket $ticket
     * @return Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        validator(request()->all(), [
            'subject' => "required",
            'content' => "required",
        ])->validate();

        $ticket->update([
            "subject" => request("subject"),
            "content" => request("content"),
        ]);
        return \response($ticket);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Ticket $ticket
     * @return Response
     */
    public function destroy(Ticket $ticket): Response
    {
        $ticket->delete();
        return response([
            "message" => "Ticked deleted successfully"
        ]);
    }
}
