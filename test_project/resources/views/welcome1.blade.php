
@section('content')

<!-- <div class="col-sm-12">

<div class="row"> -->
 
<html>
	 
				<div >
                <h4 >Add Customer</h4>
				</div>
				 

					<form id="addCustomers" name="addCustomers" method="post">
						{{ csrf_field() }}
						<input type="hidden" id="row" value=""/>

						 

			<div class="form-group">

				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" id="txtcustomer"class="form-control" placeholder="Customer name*"
							class="form-control col-md-7 col-xs-12" >
				</div>

				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" id="txtaddr"class="form-control" placeholder="Customer address*"
							class="form-control col-md-7 col-xs-12" >
				</div>
			</div>
            <div class="form-group">
            
             <div class="col-md-6 col-sm-6 col-xs-12">
             <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label> 
               <select id="ddlStatus" name="ddlStatus" class="form-control" data-validation="required"
                   data-validation-error-msg="Please enter status" required>
                  <option value="">Status</option> 
                 <option value="1">Active</option> 
                  <option value="2">Inactive</option> 
               </select>

             </div>
           </div>
					 
							<table class="form-group pull-right top_search" >
								<tr>
									<td>

										<button type="button" id="cancel_btn" class="btn btn-primary" data-dismiss="modal">Cancel</button>

									</td>
									<td>
				   	<button type="button" id="btnSave"  class="btn btn-success" onclick="saveCustomer();">Save</button>
									</td>
								</tr>
							</table>

						 

						<table id="datatab" class="table table-bordered" >

						<thead>
						<tr>
							<th>Sl No.</th>
							<th>Customer Name</th>
						    <th>Status</th>
							 
						</tr>
						</thead>
						<tbody>

						</tbody>
						</table>

					</form>
					<!-- </div>				 
					</div>	 -->
 </html>
 @endsection
 @section('js')
<script>

		$(document).ready(function() {
			alert( "ready!" );
			getCustomer();

		});

         

	function saveCustomer() {
		alert( "ready!" );
		var cust_name=$('#txtcustomer').val();
		var cust_addr=$('#txtaddr').val();
        $.ajax ({
            url: '/api/v1/saveCustomer',
            method:'post',
            dataType: 'json',
			data : 'customer_name='+cust_name+'&addr='+cust_addr,
            cache:false,
            crossDomain:true,
            success:function (data) {
                alert("Saved succesfully");


            window.location.href = "/customer";
            },
            error: function(data) {alert(data.error);
                errorAlert(data);

            }
        });
    }

	function getCustomer() {
		$('#datatab tbody').empty();
		 
				$.ajax({
					url: '/api/v1/getCustomer' ,
					method: 'get',
					dataType: 'json',
					cache: false,
					crossDomain: true,

					success: function (data) {
						var customer = data.CustomerDetails;
						var j = 1, stat='';

						for(var i=0; i < customer.length;){
							if(customer[i].status==2){stat='InActive';} else {stat="Active";}
							$('#datatab tbody').append('<tr>'

									+'<td>'+j+'</td>'
									+'<td>'+customer[i].customer_name+'</td>'
									+'<td>'+stat+'</td>'
								    +'</tr>');
							i++;j++;}



					},
					error: function () {

					}
				});
			 
		 
	}

 </script>
@stop