@extends('userpage.layout')
@section('content')
  <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100 mt-7">
    <div class="container-fluid py-4 " style="width: 73% ">
      <div class="row">
        <div class="col-md-8 d-flex flex-column mx-auto">
          <div class="card">
            <!-- <div class="card-header pb-0 text-left bg-transparent">
              <h3 class="font-weight-bolder text-primary text-gradient">Welcome back</h3>
              <p class="mb-0">Enter your email and password to get what you want!</p>
            </div> -->
            <div class="card-body">
              <form action="/contactUs" method="POST" id="post_contact">
                @csrf
                <label>Name</label>
                <div class="mb-3">
                  <input type="text" class="form-control" value="{{ auth()->user()->name }}" aria-label="Name" readonly>
                </div>
                <label>Email</label>
                <div class="mb-3">
                  <input type="email" class="form-control" value="{{ auth()->user()->email }}" aria-label="Email" readonly>
                </div>
                <label>Message</label>
                <div class="mb-3">
                  <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Additional Message" rows="3" name="message" maxlength="5000" required>{{ old('message') }}</textarea>
                </div>
                <div class="text-center">
                    <button type="button" class="btn bg-gradient-primary w-100 mt-4 mb-0" onclick="$('#post_contact').submit()">Send Message</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card-plain h-100">
            <div class="card-body pb-0 ps-5">
                <div class="col mt-4 my-auto"  >
                  <h4 class="text-primary text-gradient mb-0 fadeIn1 fadeInBottom">Contact Us</h4>
                  <h1 class="fadeIn2 fadeInBottom">How Can We Help?</h1>
                  <p class="lead opacity-8 fadeIn3 fadeInBottom">Please visit FAQ's page related to your inquiry. If you don't find what you need, fill out our contact form.</p>
                  <a href="faq" class="text-dark font-weight-bolder icon-move-right pull-right">FAQ's Page
                    <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                  </a>
                </div>
              <!-- <h3 class="mb-0">How Can We Help?</h3>
              <p>Please visit FAQ's page related to your inquiry. If you don't find what you need, fill out our contact form.</p>
              <a href="javascript:;" class="text-info icon-move-right pull-right">FAQ's Page
                <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
              </a> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
