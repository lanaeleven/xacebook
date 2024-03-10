    @php
    @endphp
@extends('layouts.main')

@section('container')
{{-- @dd($posts[0]->user->name) --}}

<div style="background-color: #f0f2f5;">
    @include('components.nav-custome')
    <div class="d-flex flex-column align-items-center pt-5">
        
        <div class="card mt-3 mb-2 rounded-4" style="width: 460px;">
            <div class="card-body d-flex justify-content-evenly align-items-center">
                <div >
                    <img src="img\person-circle.svg" class="img-responsive" alt="" style="width: 35px">
                </div>
                <div>
                    <button class="btn btn-primary rounded-pill container-fluid py-2 fs-6 mx-auto" data-bs-toggle="modal" data-bs-target="#createPost" style="width: 350px; background-color:">Hi {{ Auth::user()->name }}, What's your Xace?</button>
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
                                <textarea class="form-control @error('body')
                                {{ 'is-invalid' }}
                            @enderror " id="body" name="body" rows="3" required placeholder="Let's xace it!"></textarea>
                            @error('body')
                            <div id="body" class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
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

          </div>

        @foreach ($posts as $post)

        <div class="card my-2 rounded-4" style="width: 460px;">
          <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="me-2">
                    @if ($post->user->photo_profile)
                    <img src="{{ asset('storage/' . $post->user->photo_profile)  }}" class="rounded-circle" style="width: 35px; height: 35px; object-fit: cover;">
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