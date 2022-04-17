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
                    <h4 class="content-title mb-0 my-auto"> الأقسام </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/عرض
                        الأقسام </span>
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
                            <h4 class="card-title mg-b-0"> الأقسام</h4>
                            <i class="mdi mdi-dots-horizontal text-gray"></i>
                        </div>
                        <a class="modal-effect btn btn-primary btn-block" data-effect="effect-flip-horizontal"
                            data-toggle="modal" href="#modaldemo1"><i class="fa fa-plus"></i> اضافة قسم جديد</a>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-md-nowrap" id="example1">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">#</th>
                                        <th class="border-bottom-0"> القسم</th>
                                        <th class="border-bottom-0"> العمليات</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($sections as $section)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $section->name }}</td>

                                            <td>
                                                <a  class="modal-effect btn btn-sm btn-info"  data-effect="effect-scale"
                                                data-toggle="modal" href="#edit{{ $section->id }}"  title="تعديل"><i class="fa fa-edit"> </i> تعديل </a>

                                                <a  class="modal-effect btn btn-sm btn-danger"  data-effect="effect-scale"
                                                data-toggle="modal" href="#delete{{ $section->id }}"  title="حذف"><i class="fa fa-trash"> </i> حذف </a>

                                            </td>
                                        </tr>


                                        <!-- Modal edit effects -->
                                        <div class="modal" id="edit{{ $section->id }}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content modal-content-demo">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title">تعديل القسم </h6><button
                                                            aria-label="Close" class="close" data-dismiss="modal"
                                                            type="button"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{-- فورم تعديل القسم --}}
                                                        <form method="post" action="sections/update"
                                                            enctype="multipart/form-data" autocomplete="off">
                                                            {{ method_field('patch') }}
                                                            {{ csrf_field() }}

                                                            <div class="form-group">
                                                                <input type="hidden" name="id" id="id"
                                                                    value="{{ $section->id }}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">اسم القسم</label>
                                                                <input type="text" class="form-control" id="name"
                                                                    name="name" value="{{ $section->name }}">
                                                            </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn ripple btn-primary" type="submit">تعديل </button>
                                                        <button class="btn ripple btn-secondary" data-dismiss="modal"
                                                            type="button">اغلاق</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div><!-- End edit Modal effects-->


                                        <!-- Modal delete effects -->
                                        <div class="modal" id="delete{{ $section->id }}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content modal-content-demo">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title">حذف القسم </h6><button aria-label="Close"
                                                            class="close" data-dismiss="modal" type="button"><span
                                                                aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{-- فورم حذف رحله --}}
                                                        <form method="post" action="sections/destory">
                                                            {{ method_field('delete') }}
                                                            {{ csrf_field() }}
                                                            <input type="text" name="id" id="id"
                                                                value="{{ $section->id }}" class="form-control" hidden>
                                                            <div class="form-group">
                                                                <label for="">هل تريد حذف هذا القسم ؟</label>
                                                                <input type="text" name="name" id="name"
                                                                    value="{{ $section->name }}" class="form-control"
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
                </div>
            </div>



        </div> <!-- row closed -->

        <!-- create Modal effects -->
        <div class="modal" id="modaldemo1">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title"> إضافة قسم</h6><button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        {{-- فورم اضافه دوره جديده --}}
                        <form method="post" action=" {{ route('sections.store') }} " enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">إسم القسم</label>
                                <input type="text" class="form-control" id="name" name="name" required>
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
    @endsection
