<?php

namespace App\Services;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserServices
{
    public function getUser($user_id): User
    {
        return User::findOrFail($user_id);
    }

    public function createUser(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }

    public function sendMessage($user_id, $message)
    {
        $sender = auth('sanctum')->user();
        $receiver = $this->getUser($user_id);

        Message::create([
            'sender' => $sender->id,
            'receiver' => $user_id,
            'message' => $message,
        ]);

        broadcast(new MessageSent($receiver, $message));
    }

    
public function getMessages($user_id)
{
    $user = $this->getUser($user_id);
    $messages = Message::where('receiver', $user->id)->get();

    return $messages;
}
}
