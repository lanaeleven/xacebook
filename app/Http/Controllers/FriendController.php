<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\FriendList;
use Illuminate\Http\Request;
use App\Models\FriendRequest;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function index(int $id) {
        $friendList = FriendList::where('user1_id', $id)->get();

        $idFriendList = [];
        foreach ($friendList as $fl) {
            array_push($idFriendList, $fl->user2_id);
        }
        
        
        $requestList = FriendRequest::where('receiver_id', $id)
                                    ->where('status', 0)
                                    ->get();

        $idFriendRequest = [];
        foreach ($requestList as $fr) {
            array_push($idFriendRequest, $fr->sender_id);
        }

        $pendingList = FriendRequest::where('sender_id', $id)
                                    ->where('status', 0)
                                    ->get();

        $idPendingList = [];
        foreach ($pendingList as $fr) {
            array_push($idPendingList, $fr->receiver_id);
        }

        // dd($idPendingList);

        $friendSugg = User::whereNotIn('id', $idFriendList)->
                            whereNotIn('id', $idFriendRequest)->
                            whereNotIn('id', $idPendingList)->
                            where('id', '<>', $id)->get();

        // $friendRequest = User::whereIn('id', $idFriendRequest)->get();

        // dd($friendRequest);

        return view('friends', [
            'title' => 'Friends',
            'friendList' => $friendList, 
            'friendSugg' => $friendSugg,
            'friendRequest' => $requestList,
            'pendingList' => $pendingList
        ]);
    }

    public function addFriend(int $receiverId, int $senderId) {
        FriendRequest::create([
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'status' => 0
        ]);

        $id = Auth::user()->id;

        return redirect('/friends/' . $id);
    }

    public function confirm(int $id) {
        $friendRequest = FriendRequest::find($id);
        $sender_id = $friendRequest->sender_id;
        $receiver_id = $friendRequest->receiver_id;

        FriendList::create([
            'user1_id' => $sender_id,
            'user2_id' => $receiver_id
        ]);

        FriendList::create([
            'user1_id' => $receiver_id,
            'user2_id' => $sender_id
        ]);

        $friendRequest->status = 1;
        $friendRequest->save();

        return back();
    }

    public function reject(int $id) {
        $friendRequest = FriendRequest::find($id);
        $friendRequest->status = -1;
        $friendRequest->save();

        return back();
    }

    public function cancelRequest(int $id) {
        $friendRequest = FriendRequest::find($id);
        $friendRequest->status = -2;
        $friendRequest->save();

        return back();
    }

    public function unfriend(int $user1_id, int $user2_id) {
        // dd($user1_id, $user2_id);
        FriendList::where('user1_id', $user1_id)->where('user2_id', $user2_id)->delete();
        FriendList::where('user1_id', $user2_id)->where('user2_id', $user1_id)->delete();
        return back();
    }
}