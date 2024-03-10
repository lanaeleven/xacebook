@extends('layouts.main')

@section('container')
{{-- @dd($posts[0]->user->name) --}}

<div style="background-color: #f0f2f5;">
    {{-- @dd(Auth::user()->photo_profile) --}}
    @include('components.nav-custome')
    <div class="d-flex flex-column align-items-center pt-5">
        <div class="card mt-3 mb-2 rounded-4" style="width: 600px;">

            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                <div class="d-flex align-items-center">

                    <div class="d-flex flex-column align-items-center">
                        {{-- <img src="{{ asset('img/person-circle.svg')  }}" class="img-responsive" alt="" style="width: 70px"> --}}
                        @if ($user->photo_profile)
                            <img src="{{ asset('storage/' . $user->photo_profile)  }}" class="rounded-circle" style="width: 70px; height: 70px; object-fit: cover;">
                        @else
                        <img src="{{ asset('img/person-circle.svg')  }}" class="img-responsive" alt="" style="width: 70px">
                        @endif
    
                        @if (Auth::user()->id === $user->id)
    
                        <div >
                            <button data-bs-toggle="modal" data-bs-target="#editProfile" style="background: none;
                            border: none;
                            outline: none;
                            box-shadow: none;
                            font-size: 12px;
                            ">Edit Photo Profile</button>
    
                        <!-- Modal -->
                        <div class="modal fade" id="editProfile" data-bs-backdrop="static" tabindex="-1" aria-labelledby="editProfileLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="editProfileLabel">Edit Profile</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <form method="POST" action="/photoProfile" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <label for="photo_profile" class="form-label">Upload your Photo</label>
                                            <input class="form-control" type="file" id="photo_profile" name="photo_profile">
                                            <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                        </div>
                                    <button type="submit" class="btn btn-primary container-fluid">Save</button>
                                    </div>
                                </div>
                                </form>
                                </div>
                            </div>
                        </div>
    
                        {{-- end of modal --}}                       
                        </div>
                            
                        @endif
                    </div>
                    <div class="ms-3">
                        <h2>{{ $user->name }}</h2>
                    </div>

                </div>

                @if ($status === 'request')
                <div class="d-flex mt-4">
                    <div>
                        <a href="/confirm/{{ $idFr }}" class="btn btn-success me-3">Confirm</a>
                    </div>
                    <div>
                        <a href="/reject/{{ $idFr }}" class="btn btn-danger">Reject</a>
                    </div>
                </div>
                @endif

                @if ($status === 'waiting confirmation')
                <div class="mt-4">
                    <div>
                        <a href="/cancelRequest/{{ $idFr }}" class="btn btn-secondary">Cancel Request</a>
                    </div>
                </div>
                @endif

                @if ($status === 'not friend')
                <div class="mt-4">
                    <div>
                        <a href="/addFriend/{{ $user->id }}/{{ Auth::user()->id }}" class="btn btn-primary"> Add Friend</a>
                    </div>
                </div>
                @endif

                @if ($status === 'friend')
                <div class="mt-4">
                    <div class="dropdown">
                        <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: 160px">
                          Friend ✔
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item text-center" href="/unfriend/{{ Auth::user()->id }}/{{ $user->id }}">Unfriend</a></li>
                        </ul>
                      </div>
                </div>
                @endif

            </div>

            @if (Auth::user()->id === $user->id)

            {{-- Modal Button --}}
            <div class="card-body d-flex justify-content-evenly align-items-center">
                <div >
                        <button class="btn btn-primary rounded-pill container-fluid py-2 fs-6 mx-auto" data-bs-toggle="modal" data-bs-target="#createPost" style="width: 350px; background-color:">What's your Xace?</button>
                </div>
            </div>
            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show text-center mx-3" role="alert">
              Xace is fail to be aired, try again!
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            
            <!-- Modal -->
            <div class="modal fade" id="createPost" data-bs-backdrop="static" tabindex="-1" aria-labelledby="createPostLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createPostLabel">Create Xace</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form method="POST" action="/xace" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <div class="mb-3">
                                <textarea class="form-control" id="body" name="body" rows="3" required></textarea>
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">You can add image to your xace</label>
                                <input class="form-control @error('image')
                                {{ 'is-invalid' }}
                            @enderror " type="file" id="image" name="image">
                            @error('image')
                            <div id="image" class="invalid-feedback">
                              {{ $message }}
                            </div>
                            @enderror
                            </div>
                        <button type="submit" class="btn btn-primary container-fluid">Xace it!</button>
                        </div>
                    </div>
                    </form>
                    </div>
                </div>
            </div>

            {{-- end of modal --}}
                
            @endif

            




          </div>

        @foreach ($user->post->sortDesc() as $post)

        <div class="card my-2 rounded-4" style="width: 460px;">
          <div class="card-body">
              <div class="d-flex align-items-center">
                  <div class="me-2">
                    
                    @if ($user->photo_profile)
                        <img src="{{ asset('storage/' . $user->photo_profile)  }}" class="rounded-circle" style="width: 35px; height: 35px; object-fit: cover;">
                    @else
                    <img src="{{ asset('img/user-grey.svg')  }}" style="width: 35px" alt="">
                    @endif
                </div>
                  <div class="d-flex flex-column">                      
                    <div><a href="/profile/{{ $post->user->id }}" class="text-decoration-none text-dark">{{ $post->user->name }}</a></div>
                      <div><small>{{ $post->created_at->diffForHumans() }}</small></div>
                  </div>
              </div>
            <p class="card-text mt-3 fs-6">{{ $post->body }}</p>

            @if ($post->image)

            <img src="{{ asset('storage/' . $post->image)  }}" class="card-img mb-3" alt="...">
                
            @endif
            
          </div>
        </div>
                
        @endforeach

        
              

        
    </div>

    <div class="container-fluid bg-white py-2 mt-3">
        <h6 class="text-secondary text-center">Made with ❤ by MaulanaElvn © 2024</h6>
    </div>

</div>

@endsection