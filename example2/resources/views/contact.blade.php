@extends ('layout')

@section ('content')
<div class="container-sm">
  <div class="h-100 d-flex justify-content-center align-items-center">
  <div class="card text-center hover-shadow">
  <div class="card-header"><h2>Contact us</h2></div>
  <div class="card-body">
    <form>
<!-- Name input -->
<div class="form-outline m-4">
  <input type="text" id="form4Example1" class="form-control" />
  <label class="form-label" for="form4Example1">Name</label>
</div>

<!-- Email input -->
<div class="form-outline m-4">
  <input type="email" id="form4Example2" class="form-control" />
  <label class="form-label" for="form4Example2">Email address</label>
</div>

<!-- Message input -->
<div class="form-outline m-4">
  <textarea class="form-control" id="form4Example3" rows="4"></textarea>
  <label class="form-label" for="form4Example3">Message</label>
</div>

<!-- Checkbox -->
<div class="form-check d-flex justify-content-center m-4">
  <input
    class="form-check-input me-2"
    type="checkbox"
    value=""
    id="form4Example4"
    checked
  />
  <label class="form-check-label" for="form4Example4">
    Send me a copy of this message
  </label>
</div>

<!-- Submit button -->
<button type="submit" class="btn btn-primary">Send</button>
</form>
  </div>
  <div class="card-footer">Average response time 5hr</div>
</div>
</div>
</div>
@endsection
