<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request): Response
    {
        Gate::authorize("admin", $request->user());

        return response(Ticket::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     * @throws ValidationException
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
        Gate::authorize("owner", $ticket);

        return response($ticket);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Ticket $ticket
     * @return Response
     * @throws ValidationException
     */
    public function update(Request $request, Ticket $ticket): Response
    {
        Gate::authorize("owner", $ticket);

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
        Gate::authorize("owner", $ticket);

        $ticket->delete();
        return response([
            "message" => "Ticked deleted successfully"
        ]);
    }
}
