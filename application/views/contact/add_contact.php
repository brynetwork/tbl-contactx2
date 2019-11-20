<!DOCTYPE html>
<html>

<?php $this->load->view('resource/_css');?>

<body class="theme-red">

   <?php $this->load->view('contact/common/_nav');?>
    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <h2 class="card-inside-title">Contact Information</h2><br>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" id="firstname" placeholder="First Name" name="firstname"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" id="lastname" placeholder="Last Name" name="lastname"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                      <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" id="email" placeholder="Email" name="Email" />
                                                </div>
                                            </div>
                                        </div>
                                         <div class="col-sm-6">
                                         	<div class="form-group">
		                                        <div class="form-line">
		                                            <input type="text" class="form-control" id="contactnumber" placeholder="Contact number" name="contactnumber">
		                                        </div>
                                   			</div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Input -->

            <div class="row">
                <button onclick="save_contact()" type="button" style="margin-bottom: 10px; padding-bottom: 10px; padding-top: 10px; padding-left: 50px; padding-right: 50px; font-size: 25px; font-weight: bolder;" class="btn bg-teal waves-effect">Save</button>
                <button onclick="cancel_add()" type="button" style="margin-bottom: 10px; padding-bottom: 10px; padding-top: 10px; padding-left: 50px; padding-right: 50px; font-size: 25px; font-weight: bolder;" class="btn btn-danger waves-effect">Cancel</button>
            </div>

        </div>
    </section>
    
    <?php $this->load->view('resource/_js');?>
    <script type="text/javascript">

    	function save_contact() {
    		$.ajax({
    			type: 'POST',
	    			url:'<?=base_url('Contact/save_contact')?>',
	    			data: {
	    				firstname: $("#firstname").val(),
						lastname: $("#lastname").val(),
						email:$("#email").val(),
						contactnumber:$("#contactnumber").val()
	    			},
    			success:function(data) {
                       console.log("bryCheck: "+data);
    				if(data.slice(-2) == "OK"){
                        Swal.fire(
                            'Contact Sucessfully Added!',
                            '',
                            'success'
                        ).then(function() {
                            location.href = '<?=base_url()?>';
                        });
                    }else if(data == "er"){
                        Swal.fire({
                            type: 'error',
                            title: 'Something went wrong!',
                            text: ''
                        });
                    }else{
                        Swal.fire({
                          title: 'Validation',
                          type: 'info',
                          html: data
                        });
                    }

    			}
    		});
    	}

        function cancel_add(){
            location.href = '<?=base_url()?>';
        }
    </script>
</body>

</html>