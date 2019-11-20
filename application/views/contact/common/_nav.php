<!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="#" style="font-weight: bold;">TBL Contact</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <!--
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="javascript:void(0);" title="EDIT PROFILE"  class="js-search" data-close="true"><i class="material-icons">account_circle</i></a></li>
                    <li><a href="<?php echo base_url();?>" title="LOG OUT" class="js-search" data-close="true"><i class="material-icons">exit_to_app</i></a></li>
                -->
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></div>
                    <div class="email"><?php echo $this->session->userdata('email_address');?></div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="active">
                        <a href="<?php echo base_url() ?>">
                            <!-- <i class="material-icons">home</i> -->
                            <span>Contact List</span>
                        </a>
                        <a href="<?php echo base_url('contact/add_contact') ?>">
                            <!-- <i class="material-icons">home</i> -->
                            <span>Add Contact</span>
                        </a>
                    </li>
                   
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                     <a href="javascript:void(0);">TBL Contacts</a>
                </div>
            </div>
            <!-- #Footer -->
        </aside>
    </section>
