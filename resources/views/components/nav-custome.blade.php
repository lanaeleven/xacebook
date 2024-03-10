<div class="container-fluid d-flex justify-content-between b align-items-center bg-light shadow-sm my-0 fixed-top px-5" style="height: 50px">
    <div class="b fw-bold text-primary"><a href="/" class="text-decoration-none fs-5">Xacebook</a></div>
    <div class="b d-sm-flex d-none">
      <div @if ($title === 'Home')
      class="border-3 border-bottom border-primary"
      @endif >
        <a href="/" class="text-decoration-none px-4 py-2 rounded-0 btn btn-light">Home</a>
      </div>
      <div @if ($title === 'Friends')
      class="border-3 border-bottom border-primary"
      @endif >
        <a href="/friends/{{ Auth::user()->id }}" class="text-decoration-none px-4 py-2 rounded-0 btn btn-light">Friends</a>
      </div>
      <div @if ($title === 'Profile')
      class="border-3 border-bottom border-primary"
      @endif >
        <a href="/profile/{{ Auth::user()->id }}" class="text-decoration-none px-4 py-2 rounded-0 btn btn-light">Profile</a>
      </div>
    </div>
    <div class="b d-sm-flex d-none">
      <form action="/logout" method="post">
      @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
      </form>
    </div>
    <div class="dropdown d-sm-none d-block">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          Menu
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item text-center" href="/">Home</a></li>
          <li><a class="dropdown-item text-center" href="/friends/{{ Auth::user()->id }}">Friends</a></li>
          <li><a class="dropdown-item text-center" href="/profile/{{ Auth::user()->id }}">Profile</a></li>
          <li>
            <form action="/logout" method="post">
            @csrf
              <button type="submit" class="btn btn-white container-fluid">Logout</button>
            </form></li>
        </ul>
      </div>
</div>