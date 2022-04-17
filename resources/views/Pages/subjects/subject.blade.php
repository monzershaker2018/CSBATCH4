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
                <h4 class="content-title mb-0 my-auto">المواد الدراسية </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    عرض المواد الدراسية</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12">
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
                        <h4 class="card-title mg-b-0">المواد الدراسية</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <div class="row">
                        <div class="col">
                            <a class="modal-effect btn btn-primary"
                               data-effect="effect-flip-horizontal" data-toggle="modal" href="#modaldemo1"><i
                                   class="fa fa-plus"></i> اضافة مادة دراسية </a>
                               </div>
                    </div>

                    {{-- {{ route('search_class') }} --}}
                    <form action="{{ route('search_subjects') }}" method="post" autocomplete="off">
                        {{ csrf_field() }}

                        <br>
                        <div class="row ">

                            <div class="col">
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

                            <div class="col">
                                <label for="inputName" class="control-label">الفصل الدراسي</label>
                                <select id="semester_id" name="semester_id" class="form-control">
                                    <option value="{{ $semester_id ?? ' الفصل' }} " selected disabled>
                                        {{ $semester_name ?? 'الفصل الدراسي  ' }}</option>
                                </select>
                            </div>

                            <div class="col" id="search_btn">
                                <label class="form-label">&nbsp;</label>
                                <button class="form-control" type="submit"
                                    style="background-color: #3577f1;color:#fff">بحث</button>
                            </div>

                        </div>
                </div>

                <br>
                </form>





                <!--div-->

                @if (isset($list_classes))
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-md-nowrap" id="example1">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">#</th>
                                        <th class="border-bottom-0">اسم المادة</th>
                                        <th class="border-bottom-0">الفصل الدراسي</th>
                                        <th class="border-bottom-0">القسم</th>
                                        <th class="border-bottom-0"> المرفقات</th>
                                        <th class="border-bottom-0"> العمليات</th>
                                        <th class="border-bottom-0"></th>
                                    </tr>
                                </thead>
                                <tbody>



                                    <?php $i = 1; ?>
                                    @foreach ($list_classes as $subject)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $subject->name }}</td>
                                            <td>{{ $subject->Semesters->name }}</td>
                                            <td>{{ $subject->Sections->name }}</td>
                                            <td><a href="{{ route('getAttach', ['id'=>$subject->id]) }}"> عرض المرفقات</a></td>

                                            <td>
                                                <a  class="modal-effect btn btn-sm btn-info"  data-effect="effect-scale"
                                                data-toggle="modal" href="#edit{{ $subject->id }}"  title="تعديل"><i class="fa fa-edit"> </i> تعديل </a>
    
                                                <a  class="modal-effect btn btn-sm btn-danger"  data-effect="effect-scale"
                                                data-toggle="modal" href="#delete{{ $subject->id }}"  title="حذف"><i class="fa fa-trash"> </i> حذف </a>
    
                                            </td>
                                            <td></td>
                                        </tr>


                                        <!-- update Modal effects -->
                                        <div class="modal" id="edit{{ $subject->id }}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content modal-content-demo">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title">تعديل المادة الدراسية </h6><button
                                                            aria-label="Close" class="close" data-dismiss="modal"
                                                            type="button"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <form method="post" action=" subjects/update "
                                                            enctype="multipart/form-data">
                                                            {{ method_field('patch') }}
                                                            {{ csrf_field() }}
                                                            <div class="form-group">
                                                                <input type="hidden" name="id" id="id"
                                                                    value="{{ $subject->id }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">اسم المادة</label>
                                                                <input type="text" class="form-control" id="name"
                                                                    name="name" value="{{ $subject->name }}" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">القسم </label>
                                                                <select name="section_id" id="section_id"
                                                                    class="form-control SlectBox"
                                                                    onmouseover="console.log($(this).val())"
                                                                    onchange="console.log('change is firing')" required>
                                                                    <!--placeholder-->
                                                                    <option value="{{ $subject->Sections->id }}" selected>
                                                                        {{ $subject->Sections->name }}</option>
                                                                    @foreach ($sections as $section)
                                                                        <option value="{{ $section->id }}">
                                                                            {{ $section->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1"> الفصل الدراسي</label>

                                                                <select id="semester_id" name="semester_id"
                                                                    class="form-control" required>
                                                                    <option value="{{ $subject->Semesters->id }}" selected>
                                                                        {{ $subject->Semesters->name }}</option>
                                                                </select>

                                                            </div>


                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-success">تاكيد</button>
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">اغلاق</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- End Modal effects-->


                                        <!-- Modal delete effects -->
                                        <div class="modal" id="delete{{ $subject->id }}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content modal-content-demo">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title">حذف المادة </h6><button
                                                            aria-label="Close" class="close" data-dismiss="modal"
                                                            type="button"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{-- فورم حذف رحله --}}
                                                        <form method="post" action="subjects/destory">
                                                            {{ method_field('delete') }}
                                                            {{ csrf_field() }}
                                                            <input type="text" name="id" id="id" value="{{ $subject->id }}"
                                                                class="form-control" hidden>
                                                            <div class="form-group">
                                                                <label for="">هل تريد حذف هذا المادة ؟</label>
                                                                <input type="text" name="name" id="name"
                                                                    class="form-control" value="{{ $subject->name }}"
                                                                    readonly>
                                                            </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn ripple btn-primary" type="submit">تاكيد </button>
                                                        <button class="btn ripple btn-secondary" data-dismiss="modal"
                                                            type="button">اغلاق</button>
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
                @endif



                <!--/div-->






                <!-- create Modal effects -->
                <div class="modal" id="modaldemo1">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content modal-content-demo">
                            <div class="modal-header">
                                <h6 class="modal-title">اضافة مادة جديدة</h6><button aria-label="Close"
                                    class="close" data-dismiss="modal" type="button"><span
                                        aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                {{-- فورم اضافه قسم جديده --}}
                                <form method="post" action=" {{ route('subjects.store') }} " enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">اسم المادة</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>




                                    <div class="form-group">
                                        <label for="exampleInputEmail1">القسم </label>
                                        <select name="section_id" id="grade_id" class="form-control SlectBox"
                                            onclick="console.log($(this).val())" onchange="console.log('change is firing')">
                                            <!--placeholder-->
                                            <option value="" selected disabled>حدد القسم</option>
                                            @foreach ($sections as $section)
                                                <option value="{{ $section->id }}"> {{ $section->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> الفصل الدراسي</label>

                                        <select id="semester_id" name="semester_id" class="form-control">
                                        </select>

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






            </div> <!-- row closed -->


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
            $('#search_btn').hide();
            $('select[name="section_id"]').on('change', function() {

                $('#search_btn').show();


            });
        });
    </script>

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
@endsection
