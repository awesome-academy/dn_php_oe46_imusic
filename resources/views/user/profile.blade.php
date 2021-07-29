@if($user)
<div class="proflie">
  <div class="container">
    <div class="main-body">
      <div class="row">
        <div class="col-lg-4">
          <div class="card">
            <div class="card-body">
              <div class="d-flex flex-column align-items-center text-center">
                <img src="/storage/{{$user->avatar}}" alt="avatar" class="rounded-circle p-1 bg-primary" width="110">
                <div class="mt-3">
                  <h4>{{$user->fullname}}</h4>
                </div>
              </div>
              <hr class="my-4">
              <ul class="list-group list-group-flush">
                @if(auth()->user()->provider=='google')
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                  <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe me-2 icon-inline"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>Google</h6>
                  <span class="text-secondary"></span>
                </li>
                @elseif (auth()->user()->provider=='facebook')
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                  <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook me-2 icon-inline text-primary"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>Facebook</h6>
                  <span class="text-secondary"></span>
                </li>
                 @endif
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="card">
            <div class="card-body">
                 <span id="message"></span>
                  <div class="row mb-3">
                    <div class="col-sm-3">
                      <h6 class="mb-0">@lang('home.fullname')</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="text" class="form-control" value="{{$user->fullname}}" readonly>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="text" class="form-control" value="{{$user->email}}" readonly>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-sm-3">
                      <h6 class="mb-0">@lang('home.phone')</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="text" class="form-control" value="{{$user->phone}}" readonly>
                    </div>
                  </div>
                  <div class="row mb-4">
                      <h2 class="mb-12 text-info">@lang('home.changpass')</h2>
                  </div>
                  <form action="">
                      <div class="row mb-3">
                        <div class="col-sm-3">
                          <h6 class="mb-0">@lang('home.passold')</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          <input type="password" class="form-control passold" name="passold">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-sm-3">
                          <h6 class="mb-0">@lang('home.passnew')</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          <input type="password" class="form-control passnew" name="passnew">
                        </div>
                      </div>
                         <div class="row mb-3">
                        <div class="col-sm-3">
                          <h6 class="mb-0">@lang('home.comfir')</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          <input type="password" class="form-control passconfir" name="passconfir">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9 text-secondary">
                          <button type="submit" class="btn btn-primary px-4" id="changpass">Save Change</button>
                        </div>
                      </div>
                  </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endif
