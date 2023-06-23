@extends('master')

@section('title','Order Page')

@section('place')

{{-- <div class="col-md-5 col-8 align-self-center">
    <h3 class="text-themecolor m-b-0 m-t-0">@lang('lang.order') @lang('lang.page')</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('index')}}">@lang('lang.back_to_dashboard')</a></li>
        <li class="breadcrumb-item active">@lang('lang.order') @lang('lang.page')</li>
    </ol>
</div> --}}

@endsection

@section('content')

<style>
    th{
    overflow:hidden;
    white-space: nowrap;
  }
</style>

<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h4 class="font-weight-normal text-black">Factory PO List @lang('lang.page')</h4>
    </div>
</div>
<div class="row justify-content-start">
    <div class="col-8">
       <div class="mb-4">
            <div class="row">

            @csrf
                <div class="col-2">
                    <label class="">@lang('lang.from')</label>
                    <input type="date" name="from" id="from" class="form-control form-control-sm" onChange="setFrom(this.value)"  required>
                </div>
                <div class="col-2">
                    <label class="">@lang('lang.to')</label>
                    <input type="date" name="to" id="to" class="form-control form-control-sm" onChange="setTo(this.value)" required>
                </div>

                <div class="col-md-2 m-t-30">
                    <button class="btn btn-sm rounded btn-outline-info" id="search_PO">
                        <i class="fas fa-search mr-2"></i>Search
                    </button>
                </div>
            </div>
        </div>
    </div>

     @if(session()->get('user')->role != "Partner")
     <div class="col-md-4 mt-4">

         <form id="exportForm" onsubmit="return exportForm()" method="get">
             <div class="row">
            <input type="hidden" name="export_from" id="export_from" class="form-control form-control-sm hidden" required>
            <input type="hidden" name="export_to" id="export_to" class="form-control form-control-sm hidden" required>
            <div class="col-3">
                <select name="export_data_type" id="export_data_type" class="form-control form-control-sm select2" style="font-size: 12px;">
                           <option value=1 selected>PoList</option>
                           <option value=2 >Items</option>
                   </select>

           </div>
            {{-- <div class="col-3">
                 <select name="export_data_type" id="export_data_type" class="form-control form-control-sm select2" style="font-size: 12px;">
                            <option value=1 selected>Vouchers</option>
                            <option value=2 >Items</option>
                    </select>

            </div>
            <div class="col-3">
                 <select name="export_type" id="export_type" class="form-control form-control-sm select2" style="font-size: 12px;">
                            <option value=1 selected>Excel</option>
                            <option value=2 >PDF</option>
                    </select>

            </div> --}}

            <div class="col-9">
            <input type="submit" class="btn btn-sm rounded btn-outline-info col-4" value=" Export ">
            </div>
            </div>

        </form>

    </div>
    @endif

</div>


<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
                <h4 class="font-weight-bold mt-2">Factory PO @lang('lang.list')</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive text-black">
                    <table class="table" id="example23">
                        <thead>
                            <tr>
                                <th>PO @lang('lang.number')</th>
                                <th>PO Date</th>
                                <th>Receive Date</th>
                                <th>Total Amount</th>
                                <th>@lang('lang.total') @lang('lang.quantity')</th>
                                <th>Requested By</th>
                                <th>PO @lang('lang.status')</th>
                                <th class="text-center">@lang('lang.details')</th>

                                <th class="text-center">@lang('lang.action')</th>

                            </tr>
                        </thead>
                        <tbody id="factory_po_list">
                            @foreach($po_lists as $po)
                                <tr>
                                	<td>{{$po->po_number}}</td>
                                    <td style="overflow:hidden;white-space: nowrap;">{{date('d-m-Y', strtotime($po->po_date))}}</td>
                                    <td style="overflow:hidden;white-space: nowrap;">{{date('d-m-Y', strtotime($po->receive_date))}}</td>
                                    <td>{{$po->total_price}}</td>
                                    <td>{{$po->total_quantity}}</td>
                                    <td>{{$po->requested_by}}</td>

                                    @if($po->status == 0)
                                	<td><span class="badge badge-info font-weight-bold">Pending</span></td>
                                    @elseif($po->status == 1)
                                    <td><span class="badge badge-info font-weight-bold">Approved</span></td>
                                    @elseif($po->status == 2)
                                    <td><span class="badge badge-info font-weight-bold">Purchased</span></td>
                                    @elseif($po->status == 3)
                                    <td><span class="badge badge-info font-weight-bold">Arrived</span></td>
                                    @endif
                                	<td class="text-center"><a href="{{ route('po_details',$po->id)}}" class="btn btn-sm rounded btn-outline-info">Check Details</a>
                                    </td>

                                        @if($po->status !== 1)
                                        @if (session()->get('user')->role != "Factory")


                                        <td class="text-center">
                                            <a href="#" class="btn btn-outline-info" onclick="ApprovePO('{{$po->id}}')">Approve</a>
                                        </td>
                                        @endif
                                        @else
                                        <td class="text-center" style="overflow:hidden;white-space: nowrap;">
                                            <a href="#" class="btn btn-sm btn-info rounded">
                                                <i class="fas fa-info-circle"></i>
                                            </a>
                                        </td>

                                        @endif

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('js')

<script type="text/javascript">

    $('#example23').DataTable( {

        "paging":   false,
        "ordering": true,
        "info":     false

    });

    function setFrom(value){
        $("#exportForm :input[name=export_from]").val(value);
    }

     function setTo(value){
        $("#exportForm :input[name=export_to]").val(value);
    }
    function data_type(value){
        $("#exportForm :input[name=export_data_type]").val(value);
    }

    function exportForm(){


var from = $("#exportForm :input[name=export_from]").val();
var to = $("#exportForm :input[name=export_to]").val();
var type = $("#exportForm :input[name=export_data_type]").val();

console.log(from,to,type);

 let url = `/export-factorypolist/${from}/${to}/${type}`;
 window.location.href= url;
//  const today = new Date();
//  var dd = today.getDate();
//  var mm = today.getMonth()+1;
//  var yyyy= today.getFullYear();
//  if(dd <10){
//      dd = '0' + dd;
//  }
//  if(mm < 10){
//      mm = '0' + mm;
//  }
//   $('#export_from').val(yyyy+'-'+mm+'-'+dd);
// $('#export_to').val(yyyy+'-'+mm+'-'+dd);

return false;
};

$('#search_PO').click(function(){

            var from = $('#from').val();
            var to = $('#to').val();


                $.ajax({

                    type: 'POST',

                    url: '{{ route('search_factory_po_list') }}',

                    data: {
                     "_token": "{{ csrf_token() }}",
                     "to" : to,
                     "from" : from,
                    },

success: function(data) {
  
    if (data.length >0) {
        var html = '';

        $.each(data, function(i, po) {

            var url1 ='{{ route('po_details', ':id') }}';
                url1 = url1.replace(':id', po.id);

            var podate = po.po_date.split(" ")[0];
            var po_receivedate=po.receive_date.split(" ")[0];

            var po_date= new Date(podate);
            var dd = po_date.getDate();
            var mm = po_date.getMonth()+1;
            var yyyy= po_date.getFullYear();




                html += `
                <tr>

                    <td>${po.po_number}</td>
                    <td style="overflow:hidden;white-space: nowrap;">${podate}</td>
                    <td style="overflow:hidden;white-space: nowrap;">${po_receivedate}</td>
                    <td>${po.total_price}</td>
                    <td>${po.total_quantity}</td>
                    <td>${po.requested_by}</td>
                    `;
                    if(po.status == 0){
                        html+=`
                    <td><span class="badge badge-info font-weight-bold">Pending</span></td>`;
                    }
                    else if (po.status == 1) {
                        html +=`<td><span class="badge badge-info font-weight-bold">Approved</span></td>`;
                    }

                    else if (po.status == 2) {
                        html +=`<td><span class="badge badge-info font-weight-bold">Purchased</span></td>`;
                    }
                    else if (po.status == 3) {
                        html +=`<td><span class="badge badge-info font-weight-bold">Arrived</span></td>`;
                    }
                   html +=`

                    <td class="text-center"><a href="${url1}" class="btn btn-sm rounded btn-outline-info">Check Details</a>
                    </td>`;

                        if(po.status !== 1) {
                            html +=`<td class="text-center">
                                <a href="#" class="btn btn-outline-info" onclick="ApprovePO('${po.id}')">Approve</a>
                            </td>`;
                        }
                        else{
                            html +=` <td class="text-center" style="overflow:hidden;white-space: nowrap;">
                                <a href="#" class="btn btn-sm btn-info rounded">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                            </td>
                        </tr>`;
                        }




        })

        $('#factory_po_list').empty();
        $('#factory_po_list').html(html);



    } else {
        var html = `

        <tr>
            <td colspan="9" class="text-danger text-center">No Data Found</td>
        </tr>

        `;
        $('#factory_po_list').empty();
        $('#factory_po_list').html(html);

    }
},
});
})


    function ApprovePO(value) {

        var po_id = value;

        swal({
            title: "Are you Sure to approve this PO?",
            icon: 'warning',
            buttons: ["@lang('lang.no')", "@lang('lang.yes')"]
         })
        .then((isConfirm) => {

            if (isConfirm) {

                $.ajax({
                    type: 'POST',
                    url: 'PO/Approve',
                    dataType: 'json',
                     data: {
                        "_token": "{{ csrf_token() }}",
                        "po_id": po_id,
                     },

                    success: function(data) {
                        if(data == 1){
                        swal({
                            title: "Success!",
                            text: "Successfully approved PO!",
                            icon: "success",
                        });

                               setTimeout(function () {
                                    location.reload(true);
                                }, 1000);
                        }


                    },
                });
             }
        });
    }

</script>
@endsection
