@extends('layouts.front.master')
@section('title')
نظام إدارة المواد -  كلية علوم الحاسوب
@endsection
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


            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">المواد الدراسية</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>


                    {{-- {{ route('search_class') }} --}}
                    <form action="{{ route('user_search_subjects') }}" method="post" autocomplete="off">
                        {{ csrf_field() }}

                        <br>
                        <div class="row ">

                            <div class="col">
                                <label for="inputName" class="control-label">القسم</label>
                                <select name="section_id" id="section_id" class="form-control SlectBox" required
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
                                <label for="inputName" class="control-label">المستوى الدراسي</label>
                                <select id="level_id" name="level_id" class="form-control" required>
                                    <option value="{{ $level_id ?? ' المستوي' }} " selected disabled>
                                        {{ $level_name ?? 'المستوي الدراسي  ' }}</option>
                                </select>
                            </div>



                        </div>
                        <div class="row">

                            <div class="col">
                                <label for="inputName" class="control-label">الفصل الدراسي</label>
                                <select id="semester_id" name="semester_id" class="form-control" required>
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
                                            <td><a href="{{ route('user_get_Attach', ['id'=>$subject->id]) }}"> عرض المرفقات</a></td>



                                        </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif



                <!--/div-->

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
                            $('select[name="level_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="level_id"]').append(
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
        $('select[name="level_id"]').on('click', function() {
            var levelID = $(this).val();
            if (levelID) {
                $.ajax({
                    url: "{{ URL::to('semester') }}/" + levelID,
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
