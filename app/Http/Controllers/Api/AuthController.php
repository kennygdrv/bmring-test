<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Notifications\UserRegistered as UserRegisteredNotification;
use App\Events\UserRegistered as UserRegisteredEvent;
use App\Jobs\SendNotifications;

class AuthController extends Controller
{
    /**
     * Register
     */
    public function register(RegisterRequest $request)
    {
        // Validate user
        $validatedData = $request->validated();

        // Create User
        $user = User::create($validatedData);

        // Send notification email after 5 seconds
        $user->notify((new UserRegisteredNotification($user->name))->delay(now()->addSeconds(5)));

        // Broadcast event right away
        broadcast(new UserRegisteredEvent($user))->toOthers();

        return response()->json([
            'message' => __('registration.success'),
        ]);
    }
}
