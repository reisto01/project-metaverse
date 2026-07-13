@extends('userpage.layout')
@section('content')
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <div class="row  mt-8">
      <div class="col-md-6 mx-auto text-center">
        <h2>Popular Land's and Property's Marketplace</h2>
        <p>A lot of people don't appreciate the moment until it's passed. I'm not trying my hardest, and I'm not trying
          to do </p>
      </div>
    </div>
    <div class="container-fluid py-2">
      <div class="card">
        <div class="card-header pb-0 p-3">
          <div class="row mx-4">
            <div class="col mt-4">
              
                <form action="/shop" method="GET" class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search popular Land's or Property's..." name="search_me" value="{{ $search }}" aria-label="Search marketplace" aria-describedby="button-addon2">
                <button class="btn bg-gradient-primary btn-primary mb-0" type="submit" id="button-search">Search</button>
                </form>
                
              
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row mb-2 mx-2">
            @if ($land->isEmpty() && $properties->isEmpty())
              <div class="col-12 py-5 text-center text-muted">
                <h5>No marketplace listings found</h5>
                <p class="mb-0">Try a different search or add a listing from the admin dashboard.</p>
              </div>
            @endif
            <!-- Col Card Item -->
            @foreach ($land as $item)
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 my-sm-3">
              <!-- Card Item -->
              <div class="card">
                <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1 move-on-hover">
                  <a href="javascript:;" class="d-block">
                    <img src="{{asset($item->image)}}" class="img-fluid border-radius-lg">
                  </a>
                </div>
    
                <div class="card-body pt-2">
                  <span class="text-gradient text-info text-uppercase text-xs font-weight-bold my-2">SANDBOX</span>
                  <a href="{{ $item->url }}" rel="noopener noreferrer" class="card-title h5 d-block text-darker">
                    {{$item->title}}
                  </a>
                  <p class="card-description mb-4 text-justify text-sm " style="text-overflow:ellipsis;overflow:hidden;white-space:nowrap;max-width:400px;">
                    {{$item->description}}
                  </p>
                  <div class="align-items-center">
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="text-capitalize name text-bold mb-0">{{$item->owner}}</p>
                      <div class="avatar-group">
                        <img src="{{ URL::asset('img/kit/pro/eth.svg') }}" class="avatar p-2">
                        <span class="text-dark text-gradient font-weight-bolder">
                          {{$item->price}}
                        </span>
                      </div>
                    </div>
                </div>
                </div>
              </div>
            </div>  
            @endforeach

            @foreach ($properties as $item)
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 my-sm-3">
              <!-- Card Item -->
              <div class="card">
                <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1 move-on-hover">
                  <a href="javascript:;" class="d-block">
                    <img src="{{asset($item->image)}}" class="img-fluid border-radius-lg">
                  </a>
                </div>
    
                <div class="card-body pt-2">
                  <span class="text-gradient text-info text-uppercase text-xs font-weight-bold my-2">SANDBOX</span>
                  <a href="{{ $item->url }}" rel="noopener noreferrer" class="card-title h5 d-block text-darker">
                    {{$item->title}}
                  </a>
                  <p class="card-description mb-4 text-justify text-sm " style="text-overflow:ellipsis;overflow:hidden;white-space:nowrap;max-width:400px;">
                    {{$item->description}}
                  </p>
                  <div class="align-items-center">
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="text-capitalize name text-bold mb-0">{{$item->owner}}</p>
                      <div class="avatar-group">
                        <img src="{{ URL::asset('img/kit/pro/eth.svg') }}" class="avatar p-2">
                        <span class="text-dark text-gradient font-weight-bolder">
                          {{$item->price}}
                        </span>
                      </div>
                    </div>
                </div>
                </div>
              </div>
            </div>  
            @endforeach
            
          </div>
        </div>
      </div>
    </div>
  </main>
 @endsection
