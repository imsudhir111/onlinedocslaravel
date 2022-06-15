@extends('backend.doctor.layouts.app')
@section('content')
<div class="container-fluid bg-golden pb-5">
    <div class="row p-4 ">
        <div class="col-lg-6 offset-lg-3 offset-md-2 col-md-8">
            <h3 class="heading text-black text-uppercase"> Doctor All Appointments </h3>
        </div>
    </div>

    <div class="container box-Shadow g-0">
        <div class="row mb-5 g-0">
            <div class="col-md">
                <div class="bg-deepblue doctor-menu">
                    @include('backend.doctor.layouts.sub_layouts.sidebar')

                </div>
            </div>
            <div class="col-md-7 doc-background">
                <div class="doc-content ">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>All Appointments</h4>
                        </div>
                        <div class="col-md-6">
                            <p class="text-right">{{date("l")}}, {{date("d")}} {{date("M")}} {{date("Y")}}</p>
                        </div>
                    </div>
                    <div class=" bg-white p-3 rounded-2 border">
                        <div class="container-calendar">
                            <h3 id="monthAndYear"></h3>
                            <div class="button-container-calendar">
                                <button id="previous" onclick="previous()">&#8249;</button>
                                <button id="next" onclick="next()">&#8250;</button>
                            </div>
                            <table class="table-calendar" id="calendar" data-lang="en">
                                <thead id="thead-month"></thead>
                                <tbody id="calendar-body"></tbody>
                            </table>
                            <div class="footer-container-calendar">
                                <label for="month">Jump To: </label>
                                <select id="month" onchange="jump()">
                                    <option value=0>Jan</option>
                                    <option value=1>Feb</option>
                                    <option value=2>Mar</option>
                                    <option value=3>Apr</option>
                                    <option value=4>May</option>
                                    <option value=5>Jun</option>
                                    <option value=6>Jul</option>
                                    <option value=7>Aug</option>
                                    <option value=8>Sep</option>
                                    <option value=9>Oct</option>
                                    <option value=10>Nov</option>
                                    <option value=11>Dec</option>
                                </select>
                                <select id="year" onchange="jump()"></select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md">
                @include('backend.doctor.pages.profile')
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
           all_appointments_ajax();
});
</script>
@endsection
@section('script')
@endsection