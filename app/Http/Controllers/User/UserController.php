<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function get()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        if(!$user->profilePic){
            $user->profilePic = asset('Default/profile.png');
        }

        return response()->json([
            'message' => 'User information fetched successfuly',
            'user' => $user,
        ], 200);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Validate request
        $validator = $this->userService->validateUserUpdate($request->all(), $user->id);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Update user fields
        $updatedUser = $this->userService->updateUser($user, $request->all());

        return response()->json([
            'message' => 'User information updated successfully',
            'user' => $updatedUser,
        ], 200);
    }
}
