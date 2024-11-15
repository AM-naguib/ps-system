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
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class=" mb-0" style="font-family: 'Cairo', sans-serif">الاصناف</h4>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div class="listjs-table" id="customerList">
                                    <div class="row g-4 mb-3">
                                        <div class="col-sm-auto">
                                            <div>
                                                <button type="button" onclick="storeItemForm()"
                                                    class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn"
                                                    data-bs-target="#showModal"><i
                                                        class="ri-add-line align-bottom me-1"></i>
                                                        اضافة صنف
                                                    </button>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="d-flex justify-content-sm-end">
                                                <div class="search-box ms-2">
                                                    <input type="text" class="form-control search"
                                                        placeholder="بحث...">
                                                    <i class="ri-search-line search-icon"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="table-responsive table-card mt-3 mb-1">
                                        <table class="table align-middle table-nowrap" id="customerTable">
                                            <thead class="table-light">
                                                <tr>

                                                    <th class="sort" data-sort="m">مسلسل</th>
                                                    <th class="sort" data-sort="name">الاسم</th>
                                                    <th class="sort" data-sort="price">السعر</th>
                                                    <th class="sort" data-sort="">اجراء</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list form-check-all">
                                                @forelse ($items as $item)
                                                    <tr>
                                                        <td class="m">{{ $loop->iteration }}</td>
                                                        <td class="name">{{ $item->name }}</td>
                                                        <td class="price">{{ $item->price }}</td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <div class="edit">
                                                                    <button class="btn btn-sm btn-success edit-item-btn"
                                                                        data-bs-toggle="modal" data-bs-target="#showModal"
                                                                        onclick="getItem({{ $item->id }})">تعديل</button>
                                                                </div>
                                                                <div class="remove">
                                                                    <button class="btn btn-sm btn-danger remove-item-btn"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deleteRecordModal"
                                                                        onclick="$('#deleteRecord').attr('data-id', '{{ $item->id }}')">حذف</button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="text-center">لا يوجد بيانات</td>
                                                    </tr>
                                                @endforelse


                                            </tbody>
                                        </table>
                                        <div class="noresult" style="display: none">
                                            <div class="text-center">
                                                <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                                    colors="primary:#121331,secondary:#08a88a"
                                                    style="width:75px;height:75px">
                                                </lord-icon>
                                                <h5 class="mt-2" style="font-family: 'Cairo'">غير موجود</h5>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <div class="pagination-wrap hstack gap-2">
                                            <a class="page-item pagination-prev disabled" href="javascript:void(0);">
                                                Previous
                                            </a>
                                            <ul class="pagination listjs-pagination mb-0"></ul>
                                            <a class="page-item pagination-next" href="javascript:void(0);">
                                                Next
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->


                <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-light p-3">
                                <h5 class="modal-title" id="exampleModalLabel"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                    id="close-modal"></button>
                            </div>
                            <form class="tablelist-form" autocomplete="off" id="ItemForm">
                                <div class="modal-body">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="ItemName" class="form-label">اسم الصنف</label>
                                        <input type="text" id="ItemName" class="form-control"
                                            placeholder="ادخل اسم الصنف" required name="name" />
                                    </div>

                                    <div class="mb-3">
                                        <label for="ItemPrice " class="form-label">سعر الصنف</label>
                                        <input type="number" id="ItemPrice" class="form-control"
                                            placeholder="ادخل  سعر الصنف" required name="price" />
                                    </div>



                                </div>
                                <div class="modal-footer">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">غلق</button>
                                        <button class="btn btn-success" id="add-btn">حفظ</button>
                                        <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                    id="btn-close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mt-2 text-center">
                                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                        colors="primary:#f7b84b,secondary:#f06548"
                                        style="width:100px;height:100px"></lord-icon>
                                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                        <h4>متاكد ؟</h4>

                                    </div>
                                </div>
                                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                    <button type="button" class="btn w-sm btn-light"
                                        data-bs-dismiss="modal">اغلق</button>
                                    <button type="button" class="btn w-sm btn-danger " id="deleteRecord"
                                        onclick="deleteItem()">نعم, احذف!</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end modal -->

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

    </div>


@endsection
@section('js')
    <script>
        var options = {
            valueNames: ['m', 'name', 'price']
        };

        var customerList = new List('customerList', options);
        customerList.on('updated', function(list) {
            if (list.matchingItems.length === 0) {
                document.querySelector('.noresult').style.display = 'block';
            } else {
                document.querySelector('.noresult').style.display = 'none';
            }
        });

        function getItem(id) {


            $.ajax({
                url: "{{ route('panel.items.getItem', '') }}/" + id,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    $("#ItemName").val(response.name);
                    $("#ItemPrice").val(response.price);
                    $("#ItemForm").attr("action", "{{ route('panel.items.update', '') }}/" + id);
                    $("#ItemForm").attr("method", "PUT");
                    $("#notePassword").text("* لا تقم بكتابة كلمة السر اذا كنت لا تريد التعديل *");


                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });
        }

        function storeItemForm() {
            $('#ItemForm').attr('method', 'POST');
            $('#ItemForm').attr('action', '{{ route('panel.items.store') }}')


        }

        $("#ItemForm").submit(function(e) {
            e.preventDefault();
            var formData = $("#ItemForm").serialize();
            $.ajax({
                url: $("#ItemForm").attr("action"),
                type: $("#ItemForm").attr("method"),
                data: formData,
                success: function(response) {
                    console.log(response);
                    $("#ItemForm")[0].reset();
                    $("#showModal").modal("hide");
                    $("#customerTable").load(location.href + " #customerTable");
                    Swal.fire({
                        title: "تم الحفظ",
                        icon: "success",
                    });

                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: "حدث خطأ",
                        icon: "error",
                    });
                }
            });
        });

        function deleteItem() {
            let id = $('#deleteRecord').attr('data-id')

            $.ajax({
                url: "{{ route('panel.items.destroy', '') }}/" + id,
                type: 'DELETE',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // أضف رمز CSRF هنا
                },
                success: function(response) {
                    $("#customerTable").load(location.href + " #customerTable");
                    $("#deleteRecordModal").modal("hide");
                    Swal.fire({
                        title: "تم الحذف",
                        icon: "success",
                    });
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    Swal.fire({
                        title: "حدث خطأ",
                        icon: "error",
                    });
                }
            });
        }
    </script>
@endsection
