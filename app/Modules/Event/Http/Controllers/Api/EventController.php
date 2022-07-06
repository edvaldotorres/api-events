<?php

namespace Modules\Event\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Event\Entities\Event;
use Modules\Event\Http\Requests\StoreEventRequest;
use Modules\Event\Http\Requests\UpdateEventRequest;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        try {
            $events = Event::FilterEventsDay($request->day)->get();
            return response()->json([
                'status' => 'success',
                'data' => $events,
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An internal error has occurred, if it continues please contact administrator.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(StoreEventRequest $request)
    {
        try {
            Event::create($request->validated());
            return response()->json([
                'status' => 'success',
                'message' => 'Event created successfully.',
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An internal error has occurred, if it continues please contact administrator.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(UpdateEventRequest $request, $id)
    {
        $event = Event::find($id);
        if (empty($event)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Event not found.',
            ], Response::HTTP_NOT_FOUND);
        }

        try {
            $event->update($request->validated());
            return response()->json([
                'status' => 'success',
                'message' => 'Event updated successfully.',
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An internal error has occurred, if it continues please contact administrator.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        if (empty($event)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Event not found.',
            ], Response::HTTP_NOT_FOUND);
        }

        try {
            $event->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Event deleted successfully.',
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An internal error has occurred, if it continues please contact administrator.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
