<div class="container-fluid bg-golden pb-5">
    <div class="row p-4 ">
        <div class="col-lg-6 offset-lg-3 offset-md-2 col-md-8">
            <h3 class="heading text-black text-uppercase"> Doctor Dashboard</h3>
        </div>
    </div>
    <form>
        <div class="container box-Shadow g-0">
            <div class="row mb-5 g-0">
                <div class="col-md">
                    <div class="bg-deepblue doctor-menu">
                        <?php
                        include "doctor-navbar.php";
                        ?>
                    </div>
                </div>
                <div class="col-md-7 doc-background">
                    <div class="doc-content edit-content">
                        <div class=" bg-white p-3 rounded-2 border">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="">Email</label>
                                        <input id="" class="form-control" type="text" name="" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="">Name</label>
                                        <input id="" class="form-control" type="password" name="" placeholder="Name">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <div class="form-group mb-3">
                                            <label for="">Phone</label>
                                            <input id="" class="form-control" type="text" name="" placeholder="Phone">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="">Gender</label>
                                        <select id="" class="form-control" name="">
                                                <option>--Choose--</option>
                                                <option>Male</option>
                                                <option>Female</option>
                                            </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <div class="form-group mb-3">
                                        <label for="">DOB</label>
                                            <input id="" class="form-control" type="text" name="" placeholder="DOB">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                    <label for="">Age</label>
                                            <input id="" class="form-control" type="text" name="" placeholder="Age" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                    <label for="">Address</label>
                                    <textarea id="" class="form-control" type="text" name="" placeholder="Address"></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="">State</label>
                                            <select id="" class="form-control" name="">
                                                <option>--Choose--</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="">City</label>
                                            <select id="" class="form-control" name="">
                                                <option>--Choose--</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="">Highest Education</label>
                                            <select id="" class="form-control" name="">
                                                <option>--Choose--</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="">Professional Experience</label>
                                            <select id="" class="form-control" name="">
                                                <option>--Choose--</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="d-block">Working Days</label>
                                    <input type="checkbox"> Monday <input type="checkbox"> Tuesday <input type="checkbox"> Wednesday <input type="checkbox"> Thursday <input type="checkbox"> Friday <input type="checkbox"> Saturday <input type="checkbox"> Sunday
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="d-block">Working Hours (Morning)</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="">From</label>
                                                <input type="time" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="">To</label>
                                                <input type="time" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="d-block">Working Hours (Evening)</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="">From</label>
                                                <input type="time" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="">To</label>
                                                <input type="time" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                <div class="col-md-2 text-right"><button type="submit" class="btn btn-deepBlue">Submit</button></div>
                                </div>
                        </div> 
                    </div>
                </div>
                <div class="col-md bg-white">
                    <?php

                    include "doctor-profile.php";
                    ?>
                </div>
            </div>
        </div>
    </form>
</div>
