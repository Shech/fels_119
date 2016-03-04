<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function destroy(Request $request)
    {
        $this->user->followings()->detach($request->following_id);
        return redirect('/profile/' . $this->user->id);
    }
}
