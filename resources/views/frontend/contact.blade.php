@extends('frontend.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

        </div>
    </div>
</div>
<form id="biscolab-recaptcha-invisible-form" style="margin-left:120px;" class="py-4 col-8" method="post">
    @csrf
    <div class="form-floating mb-3">
        <input type="text" class="form-control name" id="name" name="name"
            aria-describedby="name" placeholder="Full Name" required>
        <label for="name">Full Name</label>
    </div>
    <div class="form-floating mb-3">
        <input type="email" class="form-control email" id="email" name="email" required>
        <label for="email">Email Address</label>
    </div>
    <div class="form-floating">
        <textarea class="form-control message"  name="message"
            placeholder="Leave a comment here" id="contactMessage" style="height: 100px" required></textarea>
        <label for="contactMessage">Comments</label>
    </div>
    <div class="g-recaptcha" data-sitekey="6LfTkBwiAAAAAJkqFsSbxSPyUoKg6xUHP4Fx8-Vz"></div>
      <br/>
    <button class="btn btn-warning my-2 float-end"
        data-callback='onSubmit' data-action='submit'>Submit</button>
</form>

<script>
    function onSubmit(token) {
        var bodyFormData = {
            'name' : $('#name').val(),
            'email' : $('#email').val(),
            'message' : $('#contactMessage').val(),
            'recaptchaToken': token,
        };
        axios({
                method: "post",
                url: "{{route('save.enquiry')}}",
                data: bodyFormData,
            })
            .then(function (response) {
                if(response.data.success == false) {
                    $.each(response.data.errors, function(key, value) {
                        $('.'+key).addClass("is-invalid");
                    });
                } else if(response.data.success == true) {
                    location.reload();
                }
            })
            .catch(function (response) {
                console.log(response);
            });
    }

</script>
@endsection
