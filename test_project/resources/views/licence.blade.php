 
 
<script src="{{ asset("assets/js/jquery.js") }}" type="text/javascript"></script>
<html>
	 
		
				 

		<form id="addCustomers" name="addCustomers" method="post">
						{{ csrf_field() }}
				<input type="hidden" id="row" value=""/>

				<div >
			        <h4 >Add Licence</h4>
		        </div>	 

				<div class="form-group">


                 
            
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Office</label> 
                        <select id="ddloffice" name="ddloffice" class="form-control" data-validation="required"
                              required>
                            <option value="">Select</option> 
                            <option value="1">office1</option> 
                            <option value="2">office2</option> 
                            <option value="2">office3</option> 
                        </select>

                    </div>
       

					<div class="col-md-6 col-sm-6 col-xs-12">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Licence number*</label> 
						<input type="text" id="txtlno"class="form-control"  class="form-control col-md-7 col-xs-12" >
					</div>

                    <div class="col-md-6 col-sm-6 col-xs-12">Licence Date
                        <input type="date" id="txtlDate" class="form-control" placeholder="Licence Date*" class="form-control col-md-7 col-xs-12">
                    </div>

					<div class="col-md-6 col-sm-6 col-xs-12">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Licence name*</label> 
						<input type="text" id="txtlname"class="form-control"  class="form-control col-md-7 col-xs-12" >
					</div>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Licence address*</label> 
						<input type="text" id="txtaddr"class="form-control"  class="form-control col-md-7 col-xs-12" >
					</div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Licence type</label> 
                        <select id="ddlltype" name="ddlStatus" class="form-control" data-validation="required"
                            data-validation-error-msg="Please enter status" required>
                            <option value="">Select</option> 
                            <option value="1">A</option> 
                            <option value="2">B</option> 
                            <option value="2">C</option> 
                        </select>

                    </div>
				</div>

             
					 
				<table class="form-group pull-right top_search" >
					<tr>
						 
						<td>
		                  <button type="button" id="btnSave"  class="btn btn-success" onclick="saveLicense();">Save</button>
						</td>
					</tr>
				</table>

						 

				<table id="datatab" class="table table-bordered" >
				  <thead>
				    <tr>
						<th>Sl No.</th>
						<th>Office name</th>
                        <th>License no</th>
						<th>License date</th>
                        <th>License name</th>
                        <th>License address</th>
                        <th>License type</th>
						<th>Edit</th>
                        <th>Delete</th>
				   </tr>
				  </thead>
				  <tbody>

				  </tbody>
				</table>

		</form>
		 </html>			 

     <script>

		 
        $(document).ready(function() {
		 getLicense();
        });
         

		function saveLicense() {
			var off_name=$('#ddloffice').val();
			var lic_no=$('#txtlno').val();
            var lic_date=$('#txtlDate').val();
            var lic_name=$('#txtlname').val();
            var lic_addr=$('#txtaddr').val();
            var lic_type=$('#ddlltype').val();
			$.ajax ({
				url: '/api/v1/saveLicense',
				method:'post',
				dataType: 'json',
				data : {off_name:off_name ,lic_no:lic_no,lic_date:lic_date,lic_name:lic_name,lic_addr:lic_addr,lic_type:lic_type},
				cache:false,
				crossDomain:true,
				success:function (data) {
					alert("Saved succesfully");
				    getLicense();
				},
				error: function(data) {alert(data.error);
					errorAlert(data);

				}
			});
		}

        function deleteLicense1($id) {
         var id=$id;
		 
         $.ajax({
                     url: '/api/v1/deleteLicense' ,
                     method: 'post',
                     dataType: 'json',
                     data : {id:id },
                     cache: false,
                     crossDomain: true,
                 
                     success: function (data) {
                        alert("deleted succesfully");
                        getLicense();
                     },
                     error: function () {

                     }
                 });

     }

     function deleteLicense(id){
 
        var msg = confirm("Are you sure to proceed?");
        if (msg) {
            $.ajax({
                url: '/api/v1/deleteLicense/' + id,
                method: 'delete',
                dataType: 'json',
                data : {id:id },
                cache: false,
                crossDomain: true,
                success: function (data) {
                    
                    alert(data.message);
                    getLicense();
                   
                },
                error: function () {

                }
            });
        }
        }

     

		function getLicense() {
			        $('#datatab tbody').empty();
			
					$.ajax({
						url: '/api/v1/getLicense' ,
						method: 'post',
						dataType: 'json',
						cache: false,
						crossDomain: true,

						success: function (data) {
					     var j = 1, stat='';
                         for(var i=0; i < data.length;){
							   $('#datatab tbody').append('<tr>'
 										+'<td>'+j+'</td>'
                                        +'<td>'+data[i].office+'</td>'
										+'<td>'+data[i].licence_no+'</td>'
										+'<td>'+data[i].licence_date+'</td>'
                                        +'<td>'+data[i].licence_name+'</td>'
                                        +'<td>'+data[i].licence_address+'</td>'
                                        +'<td>'+data[i].licence_type+'</td>'
                                        +'<td> <button type="button" id="btnSave"  class="btn btn-success" onclick="editLicense('+data[i].id+');">edit</button></td>' +'</td>'
                                        +'<td> <button type="button" id="btnSave"  class="btn btn-success" onclick="deleteLicense('+data[i].id+');">delete</button></td>' +'</td>'
                                        +'</tr>');
								i++;j++;}

						},
						error: function () {

						}
					});
				
			
		}

		function editLicense(data) {
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

        

		// function form_reset() {

		// 	$('#txtcustomer').val('');
		// 	$('#txtaddr').val('');
	    // }

 </script>



  


