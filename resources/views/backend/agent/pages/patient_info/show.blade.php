@extends('backend.agent.layouts.app')

@section('content')
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content pt-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Profile Information </h3>

                                 <a href="{{ url('agent/patient') }}" class="btn-sm btn-primary"
                                    style="float: right; position: absolute;right: 14px;margin: 0 auto;top: 8px;">
                                    <i class="fas fa-arrow-left" aria-hidden="true"></i>
                                </a>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->

                            <form role="form" id="serviceFormEdit"
                                action="{{ route('service.update', $patient_by_id->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                {{-- <input type="hidden" name="doctorid" id="doctorid"> --}}
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <label for="service_name">Name </label>
                                                <input type="text" class="form-control" id="service_name" readonly
                                                    name="service_name" placeholder="Service Name"
                                                    value="{{ $patient_by_id->name ? $patient_by_id->name : 'n/a' }}">
                                                @error('service_name')
                                                    <span class="text-danger" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="caption">Email </label>
                                                <input type="text" class="form-control" id="caption" readonly
                                                    name="caption" placeholder="Caption"
                                                    value="{{ $patient_by_id->email }}">

                                            </div>
                                            <div class="row">
                                            <div class="col-4">
                                            <div class="form-group">
                                                <label for="caption">Mobile</label>

                                                <input type="text" class="form-control" id="paragraph_1" readonly
                                                    name="paragraph_1" placeholder="paragraph 1"
                                                    value="{{ $patient_by_id->mobile ? $patient_by_id->mobile : 'n/a' }}">

                                            </div>
                                            </div>
                                             <div class="col-4">
                                                <div class="form-group">
                                                    <label for="caption">Age</label>
            
                                                    <input type="text" class="form-control" id="age" readonly
                                                        name="age" placeholder="Age" value="{{ $patient_by_id->age ? $patient_by_id->age.' Years' : 'n/a' }}">
            
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="caption">Gender </label>
                                                   <input type="text" class="form-control" readonly value="{{$patient_by_id->gender ? $patient_by_id->gender : 'n/a'}}"">
                                                </div>
                                            </div>
                                        </div>
            
                                        </div>
                                        <div class="text-center col-lg-4">
                                            <img class="img-fluid user-img"
                                                src="{{ !empty($patient_by_id->photo) ? url('upload/profile_image/' . $patient_by_id->photo) : url('upload/profile_image/no_image.png') }}">
                                        </div>
                                    </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="caption">Address </label>
                                            <textarea type="text"  rows="2" cols="50" class="form-control" readonly >{{$patient_by_id->address ? $patient_by_id->address : 'n/a'}} State: {{isset($patient_by_id['state'][0]->state) ? $patient_by_id['state'][0]->state  : 'n/a'}} City: {{isset($patient_by_id['city'][0]->name) ? $patient_by_id['city'][0]->name  : 'n/a'}}</textarea>
                                        </div>
                                    </div>
                                     

                                </div>
                            </div>
                        </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                                </div>
                            </form>
                        </div>
                    </div>
                    








                    <table id="all_services" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Sr No.</th>
                            <th>Email</th> 
                            <th>Mobile</th>
                            <th>Amount</th>
                            <th>Payment id</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $sr_no=1; ?>
                            @foreach($Patient_payment_history as $Patient_paymenthistory)
                            <tr>
                                <td>{{$sr_no++}}</td>
                                <td>{{$Patient_paymenthistory->email}}</td>
                                <td>{{$Patient_paymenthistory->phone}}</td>
                                <td>{{$Patient_paymenthistory->amount}}</td>
                                <td>{{$Patient_paymenthistory->razorpay_paymentid}}</td>
                                <td>{{$Patient_paymenthistory->payment_status}}</td>
                                <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@fat">Book Now</button></td>
                            </tr>
                            @endforeach
                        </tbody>
                         
                      </table>
 
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                  {{-- booking form --}}

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Schedule Appointment</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form id="schedule_appointment_form">
                            <div class="form-group">
                                <label for="caption">Select Date and Time</label>
                                <input type="text" id="datetimepicker3" onChange="check_available_slot({{$patient_by_id->id}})" class="form-control" name="datetime" value="">
                            <input type="hidden" name="doctor_id" id="doctor_id" value="">
                            </div>
                            <div class="form-group" id="show_available_slots">
                                 <style>
                                     
.tabs {
  --bar-color: red;
  --background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 60%, #e0e0e0);

  display: flex;
  width: 600px;
  border: 1px solid #ddd;
}

.tabs > .tab {
  flex: 1;
  display: flex;
}

.tab > .tab-input {
  width: 0;
  height: 0;
  margin: 0;
  display: none;
}

.tab > .tab-box {
  padding: .5rem;
  width: 100%;
  text-align: center;
  transition: 0.5s;
  border-bottom: 2px solid rgba(0,0,0,0);
}

.tab > .tab-input:checked + .tab-box {
  background: var(--background);
  border-color: var(--bar-color);
}

                                 </style>

 
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#tabs-1-data" role="tab">First Panel</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tabs-2-data" role="tab">Second Panel</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tabs-3-data" role="tab">Third Panel</a>
                                    </li>
                                </ul><!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tabs-1-data" role="tabpanel">
                                    </div>
                                    <div class="tab-pane" id="tabs-2-data" role="tabpanel">
                                        <p>Second Panel</p>
                                    </div>
                                    <div class="tab-pane" id="tabs-3-data" role="tabpanel">
                                        <p>Third Panel</p>
                                    </div>
                                </div>
                            </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary" onclick="confirm_appointment_booking({{$patient_by_id->id}})">Book</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  {{-- booking form --}}
                {{-- <div class="row">
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Payment Information </h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->

                            
                        </div>
                                 
                        </div>
                    </div>
                    <!-- /.col -->
                </div> --}}
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script')
@endsection
