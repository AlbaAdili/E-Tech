@extends("layouts/master")

@section("title","Home Page")

@section("content")
    <section class="video-section">
        <div class="video-container">
          <video autoplay loop muted class="video-background">
            <source src="{{ asset('images/Macbook-Video-Presentation.webm') }}" type="video/webm">
          </video>
        </div>
        <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center">
          <div class="col-md-6 p-lg-5 mx-auto my-5">
            <h1 class="display-3 fw-bold text-white">Discover the Future of Tech</h1>
            <h3 class="mb-3 fw-normal text-white">Shop Technology Latest Arrivals Online</h3>
            <div class="d-flex gap-3 justify-content-center lead fw-normal">
              <a class="icon-link text-white" href="./about.html">
                Learn more
                <svg class="bi bi-cart text-white" width="16" height="16"><use xlink:href="#chevron-right"/></svg>
              </a>
              <a class="icon-link text-white" href="./shop.html">
                Buy
                <svg class="bi bi-cart text-white" width="16" height="16"><use xlink:href="#chevron-right"/></svg>
              </a>
            </div>
          </div>
        </div>
    </section> 
@endsection