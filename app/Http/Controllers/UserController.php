<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Follow;
use App\Models\Lesson;
use App\Models\User;
use App\Models\UserWord;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user)
    {
        $user = User::find($user->id);
        $lessonId = Activity::where('user_id', $user->id)->lists('lesson_id');
        $lessons = Lesson::whereIn('id', $lessonId)->with('category')->get();
        $userWordCount = UserWord::where('user_id', $user->id)->count();
        $follow = Follow::where('following_id', $user->id)->where('follower_id', $this->user->id)->count();
        return view('follow.show', compact('lessons', 'user', 'userWordCount', 'follow'));
    }

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
        if (!empty($request->file('image_user'))) {
            $imageData = $request->file('image_user');
            $path = public_path(config('path.user_profile'));
            $imageName = time() . "." . $imageData->getClientOriginalExtension();
            $upload = $imageData->move($path, $imageName);
        } else {
            $imageName = null;
        }

        $user->update([
            'image' => $imageName,
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return redirect('/profile');
    }

    public function search(Request $request)
    {
        $role = User::TYPE_ADMIN;
        $users = User::where('name', 'like', '%' . $request->name . '%')
            ->where('role', User::TYPE_MEMBER)
            ->get();
        $keySearch = $request->name;
        $owner = User::find($this->user->id);
        return view('user.search', compact('users', 'keySearch', 'owner', 'role'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/home');
    }
}
