<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body style="background-color: #F5F5F5">
    <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Timer</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01"
                aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                </ul>
                <div class="d-md-flex  ">
                    <a href="{{ route('panel.index') }}" class="btn">لوحة التحكم</a>
                    <button class="btn d-block text-center">تسجيل الخروج</button>
                </div>
            </div>
        </div>
    </nav>


    <div class="container">
        <div class="row">
            <div class="col-12 d-grid gap-3 py-3" style="grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));">

                @forelse ($devices as $device)
                    <div class="device borderd rounded p-3"
                        style=" @if ($device->status == 'مشغول') background-color: #000 !important; color: #fff  @else background-color: rgb(218 224 218) !important; @endif">
                        <div class="device-name borderd rounded p-3">
                            <h3 class="text-center">{{ $device->name }}</h3>
                        </div>
                        <div class="device-status">
                            @if ($device->status == 'مشغول')
                                <p class="text-danger text-center">{{ $device->status }}</p>
                            @else
                                <p class="text-success text-center">{{ $device->status }}</p>
                            @endif
                        </div>
                        <div class="device-btns d-flex justify-content-around align-items-center">
                            @if ($device->status == 'مشغول')
                                <button class="btn btn-danger px-4 py-2 ">انهاء</button>
                            @else
                                <button class="btn btn-success px-4 py-2 ">بدء</button>
                            @endif


                        </div>
                    </div>

                @empty
                    <h1>لا يوجد أجهزة برجاء الاضافة من هنا <a href="{{ route('panel.device.index') }}"></a></h1>
                @endforelse



            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
