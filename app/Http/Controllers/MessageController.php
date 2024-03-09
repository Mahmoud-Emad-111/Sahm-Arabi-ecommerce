<?php

namespace App\Http\Controllers;

use App\Services\UserServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function chatForm($user_id, UserServices $userServices)
    {
        $receiver = $userServices->getUser($user_id);

        return response()->json(['receiver' => $receiver], 200);
    }

    public function sendMessage($user_id, Request $request, UserServices $userServices)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $userServices->sendMessage($user_id, $request->message);

        return response()->json(['message' => 'Message sent successfully'], 201);
    }

    public function getMessages($user_id, UserServices $userServices)
{
    $messages = $userServices->getMessages($user_id);

    return response()->json(['messages' => $messages], 200);
}
}
