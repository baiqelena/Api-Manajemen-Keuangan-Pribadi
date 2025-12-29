<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // GET /notification
    public function index()
    {
        return response()->json(
            Notification::where('user_id', auth()->id())->get()
        );
    }

    // POST /notification
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        $notification = Notification::create([
            'user_id' => auth()->id(),
            'title'   => $request->title,
            'message' => $request->message
        ]);

        return response()->json($notification, 201);
    }

    // GET /notification/{id}
    public function show($id)
    {
        $notification = Notification::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return response()->json($notification);
    }

    // PUT /notification/{id}
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        $notification = Notification::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $notification->update($request->all());

        return response()->json($notification);
    }

    // DELETE /notification/{id}
    public function destroy($id)
    {
        $notification = Notification::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $notification->delete();

        return response()->json([
            'message' => 'Notification deleted successfully'
        ]);
    }
}
