@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"> المرفقات </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/عرض
                    المرفقات </span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12">
            {{-- عرض الاخطاء --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0"> المرفقات</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <a class="modal-effect btn btn-primary btn-block" data-effect="effect-flip-horizontal"
                        data-toggle="modal" href="#modaldemo1"><i class="fa fa-plus"></i> اضافة مرفق جديد</a>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">   أسم المرفق</th>
                                    <th class="border-bottom-0">   أسم المادة</th>
                                    {{-- <th class="border-bottom-0">   المادة</th> --}}
                                    <th class="border-bottom-0">  العمليات</th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($attachments as $attachemnt)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{$attachemnt -> name}}</td>
                                        <td>{{$attachemnt -> Subjects -> name}}</td>
                                        {{-- <td>{{$semester -> Sub -> name}}</td> --}}

                                        <td>

                                            <a  class="btn btn-sm btn-primary" href="{{ route('view_file', ['subject'=> $attachemnt -> Subjects -> name , 'source' => $attachemnt -> source]) }}" title="عرض"><i class="fa fa-eye"> </i> عرض </a>

                                            <a  class="btn btn-sm btn-success"href="{{ route('download_file', ['subject'=> $attachemnt -> Subjects -> name , 'source' => $attachemnt -> source]) }} " title="تحميل"><i class="fa fa-download"> </i> تحميل </a>

                                        {{-- <a class=" btn btn-sm btn-success"  href="{{ url('view_file/'. $attachemnt->soucre ) }}" title="تحميل"><i
                                                class="las la-download">تحميل</i> </a> --}}


                                                <a  class="modal-effect btn btn-sm btn-info"  data-effect="effect-scale"
                                                data-toggle="modal" href="#edit{{ $attachemnt->id }}"  title="تعديل"><i class="fa fa-edit"> </i> تعديل </a>

                                                <a  class="modal-effect btn btn-sm btn-danger"  data-effect="effect-scale"
                                                data-toggle="modal" href="#delete{{ $attachemnt->id }}"  title="حذف"><i class="fa fa-trash"> </i> حذف </a>



                                        </td>
                                    </tr>


<!-- Modal edit effects -->
<div class="modal" id="edit{{ $attachemnt->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">تعديل المرفق </h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                   {{-- فورم تعديل المرفق --}}
                <form method="post" action="{{ route('attachments.update' , $attachemnt->id  ) }}" enctype="multipart/form-data" autocomplete="off">
                    {{ method_field('patch') }}
                    {{ csrf_field() }}

                    <div class="form-group">
                        <input type="hidden" name="id" id="id" value="{{ $attachemnt->id }}">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">اسم المرفق</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $attachemnt->name }}">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> مسار المرفق</label>
                        <input type="file"  class="form-control" id="image" name="source"   value="{{ $attachemnt->source }}" required>
                    </div>

                    <div class="form-group">
                        <img src="{{ asset('assets/img/faces/1.jpg')}}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                    </div>

                    <div class="form-group">
                        <label for="inputName" class="control-label">القسم</label>
                            <select name="section_id" id="section_id" class="form-control SlectBox"
                                onclick="console.log($(this).val())" onchange="console.log('change is firing')">
                                <!--placeholder-->



                                <option value="{{ $section_id ?? ' القسم' }} " selected disabled>
                                    {{ $section_name ?? 'القسم  ' }}</option>
                                {{-- <option value="الكل">الكل</option> --}}
                                @foreach ($sections as $section)
                                    <option value="{{ $section->id }}"> {{ $section->name }}</option>
                                @endforeach
                            </select>

                    </div>

                    <div class="form-group">
                        <label for="inputName" class="control-label">الفصل الدراسي</label>
                        <select id="semester_id" name="semester_id" class="form-control">
                            <option value="{{ $semester_id ?? ' الفصل' }} " selected disabled>
                                {{ $semester_name ?? 'الفصل الدراسي  ' }}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> المادة</label>
                    {{-- <select name="section_id" class="form-control"> --}}

                        <select id="subject_id" name="subject_id" class="form-control">
                            <option value="{{ $attachemnt->Subjects->id }}" selected>{{ $attachemnt->Subjects->name }}</option>
                            {{-- <option value="{{ $subject_id ?? ' المادة' }} " selected disabled>
                                {{ $subject_name ?? 'المادة' }}</option> --}}
                        </select>

                     </div>

            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary" type="submit">تعديل </button>
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">اغلاق</button>
            </div>
        </form>
        </div>
    </div>
</div><!-- End edit Modal effects-->


<!-- Modal delete effects -->
<div class="modal" id="delete{{ $attachemnt->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">حذف المرفق </h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                {{-- فورم حذف رحله --}}
                <form method="post" action="{{ route('attachments.destroy' , $attachemnt->id  ) }}">
                {{ method_field('delete') }}
                {{ csrf_field() }}
                <input type="text" name="id" id="id" value="{{ $attachemnt->id }}"  class="form-control" hidden>
                <div class="form-group">
                    <label for="">هل تريد حذف هذا المرفق ؟</label>
                    <input type="text" name="name" id="name"  value="{{ $attachemnt->name }}" class="form-control" readonly>
                </div>


            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary" type="submit">تاكيد </button>
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">اغلاق</button>
            </div>
        </form>
        </div>
    </div>
</div><!-- End edit Modal effects-->


                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



    </div> <!-- row closed -->

    <!-- create Modal effects -->
    <div class="modal" id="modaldemo1">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title"> إضافة مرفق</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    {{-- فورم اضافه دوره جديده --}}
                    <form method="post" action=" {{ route('attachments.store') }} " enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">إسم المرفق</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">المرفق </label>
                            <input type="file" name="source" id="image" class="form-control ">

                        </div>

                        <div class="form-group">
        <img src="{{ asset('') }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
    </div>

                        <div class="form-group">
                            <label for="inputName" class="control-label">القسم</label>
                                <select name="section_id" id="section_id" class="form-control SlectBox"
                                    onclick="console.log($(this).val())" onchange="console.log('change is firing')">
                                    <!--placeholder-->



                                    <option value="{{ $section_id ?? ' القسم' }} " selected disabled>
                                        {{ $section_name ?? 'القسم  ' }}</option>
                                    {{-- <option value="الكل">الكل</option> --}}
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}"> {{ $section->name }}</option>
                                    @endforeach
                                </select>

                        </div>

                        <div class="form-group">
                            <label for="inputName" class="control-label">الفصل الدراسي</label>
                            <select id="semester_id" name="semester_id" class="form-control">
                                <option value="{{ $semester_id ?? ' الفصل' }} " selected disabled>
                                    {{ $semester_name ?? 'الفصل الدراسي  ' }}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1"> المادة</label>
                        {{-- <select name="section_id" class="form-control"> --}}

                            <select id="subject_id" name="subject_id" class="form-control">
                                <option value="{{ $subject_id ?? ' المادة' }} " selected disabled>
                                    {{ $subject_name ?? 'المادة' }}</option>
                            </select>
                            {{-- @foreach ($subjects as $subject)
                            <option value="{{ $subject -> id }}">{{ $subject ->name }}</option>
                            @endforeach
                        </select> --}}
                         </div>


                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">تاكيد</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- End Modal effects-->



    </div> <!-- Container closed -->

    </div> <!-- main-content closed -->

@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('select[name="section_id"]').on('change', function() {
                var SectionId = $(this).val();
                if (SectionId) {
                    $.ajax({
                        url: "{{ URL::to('section') }}/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="semester_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="semester_id"]').append(
                                    '<option value="' +
                                    key + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>

<script>
    $(document).ready(function() {
        //click
        $('select[name="semester_id"]').on('click', function() {
            var semesterId = $(this).val();

            if (semesterId) {
                $.ajax({
                    url: "{{ URL::to('attach') }}/" + semesterId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {

                        $('select[name="subject_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="subject_id"]').append(
                                '<option value="' +
                                key + '">' + value + '</option>');
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>


<script>

    $("#image").change(function () {

        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.image-preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
        }

    });
     </script>


@endsection
