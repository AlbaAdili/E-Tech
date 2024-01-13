@extends("layouts/master")

@section("title","Contact Page")

@section("content")
<section>
        <div class="modal modal-sheet position-static d-block" tabindex="-1" role="dialog" id="modalSignin">
            <div class="modal-dialog" role="document">
              <div class="modal-content py-4 border-0">
                <div class="p-1 pb-3 border-bottom-0">
                  <h1 class="fw-normal mb-0 fs-2">Let’s Discuss Your Needs</h1>
                  <p class="contact-description">Tell us all about your problem right here, or send us an email at <span>hello@company.com</span></p>
                </div>
                <div class="modal-body p-1 pt-0">
                  <form method="POST" action="{{ route('contact.store') }}">
                  @csrf
                    <div class="form-floating mb-4">
                      <input type="text" name="name" class="form-control rounded-3" id="floatingName" placeholder="Name & Company">
                      <label for="floatingInput">Name</label>
                    </div>
                    <div class="form-floating mb-4">
                      <input type="email" name="email" class="form-control rounded-3" id="floatingEmail" placeholder="name@example.com">
                      <label for="floatingInput">Email</label>
                    </div>
                    <div class="form-floating mb-4">
                      <textarea type="text" name="description" class="form-control rounded-3" id="floatingProjectDescription" placeholder="Project Description" style="height: 150px;"></textarea>
                      <label for="floatingDescription">Problem Description</label>
                    </div>                  
                    <button class="w-50 btn btn-lg mb-4 rounded-3 btn-primary" type="submit">Send</button>
                  </form>
                </div>
              </div>
            </div>
        </div>
      </section>

@endsection