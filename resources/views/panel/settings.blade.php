@extends('panel.layouts.app')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">



                        </div>
                    </div>
                </div>
                <!-- end page title -->


                <div class="row">

                    <div class="col-lg-6 mx-auto">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1" style="font-family: cairo;font-weight: bold">
                                    الاعدادات</h4>

                            </div>

                            <form action="{{ route('panel.settings.store') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="live-preview">
                                        <div class="row gy-4 align-items-center gap-2 justify-content-center flex-column">
                                            <div class="col-xxl-6 col-md-6">
                                                <div>
                                                    <label for="name" class="form-label required">الاسم</label>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                        placeholder="ادخل الاسم" required value="{{ auth()->guard('web')->user()->name ?? auth()->guard('worker')->user()->name }}">
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-xxl-6 col-md-6">
                                                <div>
                                                    <label for="phone" class="form-label required">رقم الهاتف</label>
                                                    <input type="text" class="form-control" id="phone" name="phone"
                                                        placeholder="ادخل رقم الهاتف" required value="{{ auth()->guard('web')->user()->phone ?? auth()->guard('worker')->user()->phone }}">
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-xxl-6 col-md-6">
                                                <div>
                                                    <label for="password" class="form-label">كلمة السر <small class="text-danger">*اذا لا تريد تغير كلمة السر القديمة اتركها فارغة*</small></label>
                                                    <input type="password" class="form-control" id="password" name="password"
                                                        placeholder="ادخل كلمة السر" >
                                                </div>
                                            </div>
                                            <!--end col-->
                                            @if (auth()->guard("web")->user())
                                            <div class="col-xxl-6 col-md-6">
                                                <div>
                                                    <label for="single_price" class="form-label">سعر الساعة للسنجل</label>
                                                    <input type="text" class="form-control" id="single_price"
                                                        name="single_price" placeholder="ادخل سعر الساعة للسنجل">
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-xxl-6 col-md-6">
                                                <div>
                                                    <label for="multi_price" class="form-label">سعر الساعة للمالتي</label>
                                                    <input type="text" class="form-control" id="multi_price"
                                                        name="multi_price" placeholder="ادخل سعر الساعة للمالتي">
                                                </div>
                                            </div>
                                            <!--end col-->

                                            @endif
                                            <div class="col-xxl-6 col-md-6">
                                                <div>
                                                    <button class="form-control btn btn-success">حفظ</button>
                                                </div>
                                            </div>

                                        </div>
                                        <!--end row-->
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div> <!-- container-fluid -->
        </div><!-- End Page-content -->


    </div>
@endsection
@section('js')
@endsection
