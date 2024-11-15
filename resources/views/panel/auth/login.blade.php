<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&family=Tajawal:wght@200;300;400;500;700;800;900&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            transition: background-color 0.3s ease;
        }
        .active {
            background-color: black !important;
            color: white !important;
        }

    </style>

</head>

<body dir="rtl" style="position: relative;">
    <div class="container">
        <div class="row">
            <div class="col-12 h-100 d-flex justify-content-center align-items-center">
                <div class="col-md-4 col-10" >
                    @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @endif
                    <div class="card text-center py-5 shadow-lg" >
                        <div class="card-head">
                            <h1 class="fw-bold fs-3">تسجيل الدخول</h1>
                            <p>اختر نوع المستخدم</p>
                            <div class="user-btns">
                                <button class="btn border active" style="font-weight: bold;" onclick="changeForm(this,'worker')">مستخدم</button>
                                <button class="btn border" style="font-weight: bold;" onclick="changeForm(this,'user')">مالك</button>
                            </div>
                        </div>
                        <div class="card-body">

                            <form action="{{route("login.store")}}" method="POST" id="user-form">
                                @csrf
                                <div class="mb-3 text-end">
                                    <label for="phone" class="form-label ">رقم الهاتف :</label>
                                    <input type="text" class="form-control" name="phone" placeholder="ادخل رقم الهاتف" >
                                </div>
                                <input type="hidden" name="user_type" value="worker" id="user_type" readonly>
                                <div class="mb-3 text-end">
                                    <label for="phone" class="form-label ">كلمة السر :</label>
                                    <input type="text" class="form-control" name="password" placeholder="ادخل كلمة السر" >
                                </div>
                                <button class="btn btn-dark" >تسجيل الدخول</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

        <script>


            function changeForm(button,type) {
                $(".user-btns button").removeClass("active");
                $(button).addClass("active");
                if(type == 'user') {
                    $("#user_type").val('web');
                }else {
                    $("#user_type").val('worker');
                }
            }
        </script>
</body>

</html>
