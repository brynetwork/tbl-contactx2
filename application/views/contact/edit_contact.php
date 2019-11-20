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
                                                    <input type="text" class="form-control" id="firstname" placeholder="First Name" value="<?php echo $contactdetails->first_name; ?>" name="firstname"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" id="lastname" placeholder="Last Name" value="<?php echo $contactdetails->last_name; ?>" name="lastname"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                      <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" id="email" placeholder="Email" value="<?php echo $contactdetails->email; ?>" name="Email"/>
                                                </div>
                                            </div>
                                        </div>
                                         <div class="col-sm-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" id="contactnumber" placeholder="Contact Number" value="<?php echo $contactdetails->contact_num; ?>" name="contactnumber">
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
                <button onclick="update_contact()" type="button" style="margin-bottom: 10px; padding-bottom: 10px; padding-top: 10px; padding-left: 50px; padding-right: 50px; font-size: 25px; font-weight: bolder;" class="btn bg-teal waves-effect">Update</button>
                <button onclick="cancel_update()" type="button" style="margin-bottom: 10px; padding-bottom: 10px; padding-top: 10px; padding-left: 50px; padding-right: 50px; font-size: 25px; font-weight: bolder;" class="btn btn-danger waves-effect">Cancel</button>
            </div>

        </div>
    </section>
    <?php $this->load->view('resource/_js');?>
    <script type="text/javascript">

        function update_contact() {
            $.ajax({
                type: 'POST',
                    url:'<?=base_url('Contact/update_contact')?>',
                    data: {
                        id: <?php echo $contactdetails->id; ?>,
                        firstname: $("#firstname").val(),
                        lastname: $("#lastname").val(),
                        email: $("#email").val(),
                        contactnumber:$("#contactnumber").val()
                    }, success:function(data) {
                        if(data == "OK"){
                            Swal.fire(
                                'Contact Sucessfully Updated!',
                                '',
                                'success'
                            ).then(function() {
                                location.href = '<?=base_url()?>';
                            });
                        }else if(data == "error"){
                            Swal.fire({
                                type: 'error',
                                title: 'Something went wrong!',
                                text: ''
                            });
                        }else{
                             Swal.fire(
                                'Contact Sucessfully Updated!',
                                '',
                                'success'
                            ).then(function() {
                                location.href = '<?=base_url()?>';
                            });
                        }

                    }
            });
            
        }

        function cancel_update(){
            location.href = '<?=base_url()?>';
        }
    </script>
</body>

</html>