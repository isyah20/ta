<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('templates/header-clean') ?>
    <body>
        <style>
            :root {
        	    --bs-red-primary: #db2828;
        	    --bs-red-hover-primary: #9f0909;
        	    --bs-text-mute: #797979;
        	    --bs-label-success: #28a32d;
        	    --bs-label-warning: #f2ae0a;
        	    --bs-font-primary: 'Ubuntu', sans-serif;
        	    --bs-body-bold: 600;
        	}
        
            body { background-color: #F7F7F7; }
            
            .navbar-light {
                background: var(--bs-white);
                padding: 12px;
            }
            
            .navbar .navbar-brand { padding-left: 0; }
            
            .nav-item .active { color: var(--bs-red-primary) !important; }
            
            .nav-item:hover .nav-link { color: var(--bs-red-hover-primary) !important; }
        </style>
        
        <?php $this->load->view('templates/navbar'); ?>
        <?php $this->load->view($halaman); ?>
        <?php $this->load->view('templates/footer'); ?>
    </body>
</html>
