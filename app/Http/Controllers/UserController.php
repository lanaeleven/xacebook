<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\FriendList;
use Illuminate\Http\Request;
use App\Models\FriendRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request){
        // dd(date("Y-m-d", strtotime("-17 year", time())));
        // dd($request->input('birth_date'));
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'birth_date' => 'required|before:' . date("Y-m-d", strtotime("-17 year", time())),
            'gender' => 'required'
        ]);
        

        $user = User::create($validated);

        return redirect('/login')->with('success', 'Registration successfully, now you can Login and have a lot of xace');

    }

    public function index(int $id) {
        $user = User::find($id);

        $status = "";
        $idFr = 0;

        if ($id !== Auth::user()->id) {
            if (FriendRequest::where('status', 0)
                            ->where('sender_id', $id)
                            ->where('receiver_id', Auth::user()->id)
                            ->exists()) {
                $idFr = FriendRequest::where('status', 0)
                ->where('sender_id', $id)
                ->where('receiver_id', Auth::user()->id)->first()->id;
                $status = 'request';
            } elseif (FriendRequest::where('status', 0)
                                    ->where('sender_id', Auth::user()->id)
                                    ->where('receiver_id', $id)
                                    ->exists()) {
                $idFr = FriendRequest::where('status', 0)
                ->where('sender_id', Auth::user()->id)
                ->where('receiver_id', $id)->first()->id;

                $status = 'waiting confirmation';
            } elseif (FriendList::where('user1_id', Auth::user()->id)
                            ->where('user2_id', $id)
                            ->exists()) {
                $status = 'friend';
            } else {
                $status = 'not friend';
            }
        }
        

        return view('profile', ['user' => $user, 'status' => $status, 'idFr' => $idFr, 'title' => 'Profile']);
    }

    public function photoProfile(Request $request) {
        $validated = $request->validate([
            'id' => 'required',
            'photo_profile' => 'image|file|max:10240'
        ]);

        // dd($request->file('photo_profile'));

        if ($request->file('photo_profile')) {
            $validated['photo_profile'] = $request->file('photo_profile')->store('photo-profiles');

            $user = User::find($validated['id']);
            $user->photo_profile = $validated['photo_profile'];
            $user->save();

            return back();
        }

        return back();
    }
}
