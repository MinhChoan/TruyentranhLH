<x-navbar />

<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->

    <div class="row">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0 border-dark">
                <div class="card-header text-bg-dark">Ảnh đại diện</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <img class="img-account-profile rounded-circle mb-2"
                        src="@if (Auth::user()->avatar) {{ asset('storage/avatar/' . Auth::user()->avatar) }}
                        @else {{ asset('storage/avatar/default.jpeg') }} @endif"
                        alt="" value="{{ Auth::user()->avatar }}"
                        style="width: 200px; height: 200px; object-fit: cover; border-radius: 50%;">


                    <!-- Profile picture help block-->
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <!-- Profile picture upload button-->
                    <button class="btn btn-primary" type="button">Upload new image</button>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4 border-dark">
                <div class="card-header text-bg-dark">Thông tin hiển thị</div>
                <div class="card-body ">
                    <form>
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Tên người dùng</label>
                            <input class="form-control" id="inputUsername" type="text"
                                placeholder="Tên sẽ dùng để hiển thị trên trang" value="{{ Auth::user()->username }}">
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (first name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputEmail">Email</label>
                                <input class="form-control" id="inputEmail" type="text" placeholder="Email của bạn"
                                    value="{{ Auth::user()->email }}">
                            </div>
                            <!-- Form Group (last name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Ngày tạo tài khoản</label>
                                <input class="form-control" id="inputLastName" type="text" placeholder="Tên của bạn"
                                    value="{{ date('d-m-Y', strtotime(Auth::user()->created_at)) }}" readonly>
                            </div>

                        </div>
                        <!-- Form Row        -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (organization name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputSchool">Học vấn</label>
                                <input class="form-control" id="inputSchool" type="text" placeholder=""
                                    value="">
                            </div>
                            <!-- Form Group (location)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLocation">Nơi sống</label>
                                <input class="form-control" id="inputLocation" type="text"
                                    placeholder="Enter your location" value="Việt Nam">
                            </div>
                        </div>
                        <!-- Form Group (email address)-->
                        {{-- <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">Email address</label>
                            <input class="form-control" id="inputEmailAddress" type="email" placeholder="Enter your email address" value="name@example.com">
                        </div> --}}
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Phone number</label>
                                <input class="form-control" id="inputPhone" type="tel"
                                    placeholder="Enter your phone number" value="555-123-4567">
                            </div>
                            <!-- Form Group (birthday)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBirthday">Birthday</label>
                                <input class="form-control" id="inputBirthday" type="text" name="birthday"
                                    placeholder="Enter your birthday" value="06/10/1988">
                            </div>
                        </div>
                        <!-- Save changes button-->
                        <div class="row gx-3 mb-3">
                            <div class="text-center">
                                <button class="btn btn-outline-primary" type="button">Lưu thay đổi</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
