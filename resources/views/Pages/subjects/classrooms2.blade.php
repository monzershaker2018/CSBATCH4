@extends('layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الصفوف الدراسية </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ عرض الصفوف الدراسية</span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
                    <div class="col-xl-12">
{{-- عرض الاخطاء--}}
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
									<h4 class="card-title mg-b-0">الصفوف الدراسية</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
                                    <div class="row">
                                <div class="col-2">
                                    <a class="modal-effect btn btn-success btn-block" data-effect="effect-flip-horizontal" data-toggle="modal" href="#modaldemo1"><i class="fa fa-plus"></i> اضافة صف  </a>

                                </div>
                                <div class="col-3">
                                    <a class="modal-effect btn btn-danger btn-block" data-effect="effect-flip-horizontal" data-toggle="modal" href="#delete_all" id="delete_all_btn"><i class="fa fa-delete"></i>  حذف الصفوف المختارة  </a>

                                </div>
							</div>
{{-- <div class="col-4">
                            <form method="post" action="{{route('filter_classses')}}" enctype="multipart/form-data" autocomplete="off">
                                {{ csrf_field() }}


                                <div class="form-group">
                                    <label for="exampleInputEmail1"> المرحلة الدراسية</label> <br>
                                    <select name="grade_id" id="grade_id" class="form-control" onchange="this.form.submit()">
             <option selected disabled >المرحلة الدراسية</option>

                                            @foreach($grades as $grade)
                                            <option  value="{{$grade->id}}"  > {{$grade->name}}</option>
                                        @endforeach

                                    </select>
                                </div>


                    </form>

                </div> --}}




                <div class="col-4">
                    <form method="post" action="{{route('search_grades')}}" enctype="multipart/form-data" autocomplete="off">
                        {{ csrf_field() }}


                        <div class="form-group">
           <br> <br>

           <select name="grade_id" id="grade_id" class="form-control" onchange="this.form.submit()">
            <option selected disabled >المرحلة الدراسية</option>

                                           @foreach($grades as $grade)
                                           <option  value="{{$grade->id}}"  > {{$grade->name}}</option>
                                       @endforeach

                                   </select>
                        </div>





                    </form>
                </div>

                @if (isset($list_classes))

							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="my_datatable">
										<thead>
											<tr>
                                                <th class="border-bottom-0"><input type="checkbox" name="" id="select_all" onclick="check_all('box1',this)"></th>
                                                <th class="border-bottom-0">#</th>
                                                <th class="border-bottom-0">اسم الصف</th>
                                                <th class="border-bottom-0"> المرحله الدراسيه</th>
                                                <th class="border-bottom-0">ملاحظات</th>
                                                <th class="border-bottom-0"> العمليات</th>
											</tr>
										</thead>
										<tbody>

                                                                 <?php $i= 1; ?>
                                            @foreach( $list_class as $classroom)
                                                                            <tr >
                                                                                <td><input type="checkbox"  value="{{ $classroom->id}}"  class="box1"></td>
                                                                                <td>{{$i++}}</td>
                                                                                <td>{{ $classroom ->name}}</td>
                                                                                <td>{{ $classroom ->grade->name}}</td>
                                                                                <td>{{ $classroom ->notes }}</td>

                                                                                            <td>


                                                                            <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                                            data-id="{{ $classroom->id}}"
                                                                            data-name="{{ $classroom->name }}"
                                                                            data-grade_id="{{ $classroom ->grade->name }}"
                                                                            data-notes="{{ $classroom ->notes }}"
                                                                            data-toggle="modal"
                                                                            href="#edit" title="تعديل"><i class="las la-pen">تعديل</i> </a>


                                                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                                            data-id="{{ $classroom ->id}}" data-name="{{ $classroom ->name }}"
                                                                            data-toggle="modal" href="#delete" title="حذف"><i
                                                                                    class="las la-trash">حذف</i> </a>

                                                                                            </td>
                                                                                            </tr>
                                                                                        @endforeach
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                                @endif
                                                                            </div>
                                                                        </div>



                                                                    </div> <!-- row closed -->

<!-- create Modal effects -->
<div class="modal" id="modaldemo1">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">اضافة صف دراسي جديد</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                 {{-- فورم اضافه دوره جديده--}}
<form method="post" action=" {{route('classrooms.store')}} " enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="exampleInputEmail1">اسم الصف</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1"> المرحلة الدراسية</label>
        <select name="grade_id" id="grade_id" required class="form-control">
            <option value="" selected disabled>-- حدد المرحلة الدراسية --</option>
            @foreach ($grades as $grade)
            <option value="{{$grade->id}}"> {{$grade->name}} </option>
            @endforeach
        </select>

    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">  ملاحظات</label>
        <textarea name="notes" id="notes" cols="30" rows="5" class="form-control"></textarea>


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


<!-- Modal edit effects -->
<div class="modal" id="edit">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">تعديل المرحلة </h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                   {{-- فورم تعديل المرحلة --}}
                <form method="post" action="classrooms/update" enctype="multipart/form-data" autocomplete="off">
                    {{ method_field('patch') }}
                    {{ csrf_field() }}

                    <div class="form-group">
                        <input type="hidden" name="id" id="id" value="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">اسم الصف</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> المرحلة الدراسية</label> <br>
                        <select name="grade_id" id="grade_id" class="form-control">
{{-- <option selected disabled >-- اختر الدوره</option> --}}

                                @foreach($classrooms as $classroom)
                                <option  value="{{$classroom ->grade->id}}"  > {{$classroom ->grade->name}}</option>
                            @endforeach

                        </select>
                    </div>




                    <div class="form-group">
                        <label for="exampleInputEmail1"> ملاحظات </label>
                        <textarea name="notes" id="notes" cols="30" rows="5" class="form-control"></textarea>
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
<div class="modal" id="delete">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">حذف المرحلة </h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                {{-- فورم حذف رحله --}}
                <form method="post" action="classrooms/destory">
                {{ method_field('delete') }}
                {{ csrf_field() }}
                <input type="text" name="id" id="id"  class="form-control" hidden>
                <div class="form-group">
                    <label for="">هل تريد حذف هذه الصف ؟</label>
                    <input type="text" name="name" id="name"  class="form-control" readonly>
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



<!-- Modal delete effects -->
<div class="modal" id="delete_all">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">حذف الصفوف المحتارة </h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                {{-- فورم حذف رحله --}}
                <form method="post" action="{{ route('delete_all')}}">
                {{ csrf_field() }}
                <input type="text" name="delete_all_id" id="delete_all_id"  class="form-control" >
                 <div class="form-group">
                    <label for="">هل انت متاكد من عملية الحذف  ؟</label>
                    {{-- <input type="text" name="name" id="name"  class="form-control" readonly> --}}
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


			</div> <!-- Container closed -->

		</div> <!-- main-content closed -->

@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script src="{{ URL::asset('assets/js/modal.js') }}"></script>

<script>

    $('#edit').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var name = button.data('name')
        var notes = button.data('notes')
        var grade_id = button.data('grade_id')
        // ###################################
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #name').val(name);
        modal.find('.modal-body #grade_id').val(grade_id);
        modal.find('.modal-body #notes').val(notes);

    })
</script>
{{-- ################ delete ###################  --}}
<script>
    $('#delete').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var name = button.data('name')

        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #name').val(name);
    })
</script>


<script>
    $('#delete_all').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')

        var modal = $(this)
        modal.find('.modal-body #id').val(id);

    })
</script>

<script>
function check_all(className,elem){
    var element = document.getElementsByClassName(className);


    if(elem.checked){
        for(var i = 0 ; i < element.length; i++){
            element[i].checked = true;
        }
    }else{
        for(var i = 0 ; i < element.length; i++){
            element[i].checked = false;
        }

    }
}

</script>

<script>

    $(function(){
$('#delete_all_btn').click(function(){
var selected = new Array();
$('#my_datatable input[type=checkbox]:checked').each(function(){
selected.push(this.value);
});

if( selected.length > 0){
    $('#delete_all').modal('show')
    $('input[id = "delete_all_id"]').val(selected)
}
    });
});
</script>
@endsection
