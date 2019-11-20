<!DOCTYPE html>
<html>

<?php $this->load->view('resource/_css');?>

<body class="theme-red">

   <?php $this->load->view('contact/common/_nav');?>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>TBL Contact</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-6">
                                    <h2>Contact List</h2>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="tbl-contact" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th class="text-center">First Name</th>
                                            <th class="text-center">Last Name</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Contact Number</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                     <tbody>
                                         <?php foreach($contact_list as $contact) { ?>
                                        <tr>
                                            <td class="text-center"><?php echo $contact['first_name'];?></td>
                                            <td class="text-center"><?php echo $contact['last_name'];?></td>
                                            <td class="text-center"><?php echo $contact['email'];?></td>
                                            <td class="text-center"><?php echo $contact['contact_num'];?></td>
                                            <td class="text-center">
                                                <a href="<?php echo site_url('contact/edit_contact')?>/<?php echo $contact['id'];?>"><button type="button" class="btn btn-warning">edit</button></a>
                                                <button type="button" class="btn btn-danger" onclick="deleteContact(<?php echo $contact['id'];?>)">delete</button>
                                            </td>
                                        </tr>
                                        <?php  } ?>
                                    </tbody>
                                </table>
                            </div><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php $this->load->view('resource/_js');?>
    <script type="text/javascript">
        $('#tbl-contact').DataTable({
        });

        function deleteContact(contactID){
            Swal.fire({
                title: 'Are you sure you what to delete this Contact?',
                text: "",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if(result.value){
                    $.ajax({
                        type: 'POST',
                        url: '<?=base_url('Contact/delete_contact')?>',
                        data:{
                            contact_id: contactID
                        }, success: function(data){
                            if(data == "error"){
                                Swal.fire({
                                    type: 'error',
                                    title: 'Something went wrong!',
                                    text: ''
                                });

                            }else{
                                Swal.fire(
                                    'Contact Successfully Deleted!',
                                    '',
                                    'success'
                                ).then(function(){
                                    location.href = '<?=base_url()?>';
                                });   
                            }

                        }

                    });
                }

            })

        }

    </script>
</body>

</html>