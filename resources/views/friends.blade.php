@extends('layouts.main')

{{-- @dd($pendingList) --}}
@section('container')
<div style="background-color: #f0f2f5;">
    @include('components.nav-custome')
    

    <div class="d-flex flex-column align-items-center pt-5">

        <div class="d-flex flex-column flex-lg-row">

        <div class="card mt-3 mb-2 me-3 rounded-4" style="width: 460px;">
            <div class="card-body">

                @if ($friendRequest->isNotEmpty())

                <h6 class="text-center">Friend Request</h6>

                    @foreach ($friendRequest as $fr)
                    <div class="d-flex justify-content-between align-items-center">

                        <div class="d-flex my-4 align-items-center">
                            <div class="me-2">
                                @if ($fr->sender->photo_profile)
                                <img src="{{ asset('storage/' . $fr->sender->photo_profile)  }}" class="rounded-circle" style="width: 35px; height: 35px; object-fit: cover;">
                                @else
                                <img src="{{ asset('img/user-grey.svg')  }}" style="width: 35px" alt="">
                                @endif
                            </div>
                            <div>
                                <h6><a href="/profile/{{ $fr->sender->id }}" class="text-decoration-none text-dark">{{ $fr->sender->name }}</a></h6>
                            </div>
                        </div>
                        
                        <div class="d-flex">
                            <div>
                                <a href="/confirm/{{ $fr->id }}" class="btn btn-success me-3">Confirm</a>
                            </div>
                            <div>
                                <a href="/reject/{{ $fr->id }}" class="btn btn-danger">Reject</a>
                            </div>
                        </div>

                    </div>
        
                    @endforeach

                    
                    @else
                    
                    <h6 class="text-center">You dont have any friend request</h6>
                    
                    @endif
             


            </div>
        </div>

        <div class="card mt-3 mb-2 rounded-4" style="width: 460px;">
            <div class="card-body">
                @if ($pendingList->isNotEmpty())
                <h6 class="text-center">Pending Request</h6>
                @foreach ($pendingList as $pl)
                <div class="d-flex justify-content-between align-items-center">

                    <div class="d-flex my-4 align-items-center">
                        <div class="me-2">
                            @if ($pl->receiver->photo_profile)
                            <img src="{{ asset('storage/' . $pl->receiver->photo_profile)  }}" class="rounded-circle" style="width: 35px; height: 35px; object-fit: cover;">
                            @else
                            <img src="{{ asset('img/user-grey.svg')  }}" style="width: 35px" alt="">
                            @endif
                        </div>
                        <div>
                            <h6><a href="/profile/{{ $pl->receiver->id }}" class="text-decoration-none text-dark">{{ $pl->receiver->name }}</a></h6>
                        </div>
                    </div>
                    
                    <div class="d-flex">
                        <div>
                            <a href="/cancelRequest/{{ $pl->id }}" class="btn btn-secondary">Cancel Request</a>
                        </div>
                    </div>

                </div>
    
                @endforeach
        @else
            <h6 class="text-center">You dont have any pending request</h6>
        @endif
            </div>
        </div>
    </div>

        <div class="d-flex flex-column flex-lg-row">

            <div class="card m-2 rounded-4" style="width: 460px;">
                <div class="card-body">
                    <h6 class="text-center">Your Friend</h6>
                    <div class="d-flex flex-column">
                        
                        @foreach ($friendList as $fl)
                        
                        <div class="d-flex align-items-center my-4">
                            <div class="me-2">
                                @if ($fl->user2->photo_profile)
                                <img src="{{ asset('storage/' . $fl->user2->photo_profile)  }}" class="rounded-circle" style="width: 35px; height: 35px; object-fit: cover;">
                                @else
                                <img src="{{ asset('img/user-grey.svg')  }}" style="width: 35px" alt="">
                                @endif
                            </div>
                            <div>
                                <h6><a href="/profile/{{ $fl->user2->id }}" class="text-decoration-none text-dark">{{ $fl->user2->name }}</a></h6>
                            </div>
                        </div>

                        @endforeach


                    </div>
                </div>
            </div>
            
            <div class="card m-2 rounded-4 " style="width: 460px;">
                <div class="card-body">
                    <h6 class="text-center">Suggestion People</h6>
                    <div class="d-flex flex-column">
                        @foreach ($friendSugg as $fs)
                        <div class="d-flex justify-content-between align-items-center">
    
                            <div class="d-flex my-4 align-items-center">
                                <div class="me-2">
                                    @if ($fs->photo_profile)
                                    <img src="{{ asset('storage/' . $fs->photo_profile)  }}" class="rounded-circle" style="width: 35px; height: 35px; object-fit: cover;">
                                    @else
                                    <img src="{{ asset('img/user-grey.svg')  }}" style="width: 35px" alt="">
                                    @endif
                                </div>
                                <div>
                                    <h6><a href="/profile/{{ $fs->id }}" class="text-decoration-none text-dark">{{ $fs->name }}</a></h6>
                                </div>
                            </div>
                            <div>
                                <a href="/addFriend/{{ $fs->id }}/{{ Auth::user()->id }}" class="btn btn-primary"> Add Friend</a>
                            </div>
                
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>


        <div class="container-fluid bg-white py-2 mt-3">
            <h6 class="text-secondary text-center">Made with ❤ by MaulanaElvn © 2024</h6>
        </div>
    </div>

</div>
    
@endsection