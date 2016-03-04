<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile()
    {
        $user = $this->user;
        return view('user.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $imageData = $request->file('image_user');
        $path = public_path(config('path.user_profile'));
        $imageName = time() . "." . $imageData->getClientOriginalExtension();
        $upload = $imageData->move($path, $imageName);

        $user->update([
            'image' => $imageName,
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return redirect('/user/' . $user->id);
    }
}
