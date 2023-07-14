 
 
<script src="{{ asset("assets/js/jquery.js") }}" type="text/javascript"></script>
<html>
	 
		
				 

		<form id="addCustomers" name="addCustomers" method="post">
						{{ csrf_field() }}
				<input type="hidden" id="row" value=""/>

				<div >
			        <h4 >Add Customer</h4>
		        </div>	 

				<div class="form-group">

					<div class="col-md-6 col-sm-6 col-xs-12">
						<input type="text" id="txtcustomer"class="form-control" placeholder="Customer name*" class="form-control col-md-7 col-xs-12" >
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
						<th>Customer Address</th>
						<th>Edit</th>
				   </tr>
				  </thead>
				  <tbody>

				  </tbody>
				</table>

		</form>
		 </html>			 

     <script>

		 
        $(document).ready(function() {
		 getCustomer();
        });
         

		function saveCustomer() {
			var cust_name=$('#txtcustomer').val();
			var cust_addr=$('#txtaddr').val();
			$.ajax ({
				url: '/api/v1/saveCustomer',
				method:'post',
				dataType: 'json',
				data : {cust_name:cust_name ,cust_addr:cust_addr},
				cache:false,
				crossDomain:true,
				success:function (data) {
					alert("Saved succesfully");
					form_reset();
                    getCustomer();
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
						method: 'post',
						dataType: 'json',
						cache: false,
						crossDomain: true,

						success: function (data) {
					     var j = 1, stat='';
                         for(var i=0; i < data.length;){
							   $('#datatab tbody').append('<tr>'
 										+'<td>'+j+'</td>'
										+'<td>'+data[i].cust_name+'</td>'
										+'<td>'+data[i].cust_addr+'</td>'
										+'<td> <button type="button" id="btnSave"  class="btn btn-success" onclick="editCustomer('+data[i].id+','+data[i].cust_name+');">edit</button></td>' +
										+'</tr>');
								i++;j++;}

						},
						error: function () {

						}
					});
				
			
		}

		function editCustomer(data,id) {
			alert(data);
			$('#txtcustomer').val();
			$('#txtaddr').val( );
			var cust_name=$('#txtcustomer').val();
			var cust_addr=$('#txtaddr').val();
			$.ajax({
						url: '/api/v1/updateCustomer' ,
						method: 'post',
						dataType: 'json',
						cache: false,
						data : {cust_name:cust_name ,cust_addr:cust_addr,id:id},
						crossDomain: true,
					
						success: function () {
							getCustomer();
						},
						error: function () {

						}
					});

		}

		function form_reset() {

			$('#txtcustomer').val('');
			$('#txtaddr').val('');
	    }

 </script>



  


