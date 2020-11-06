<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>SD ABU AZIZ</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
        ============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="<?=base_url();?>assets/img/favicon.ico">
    <!-- Google Fonts
        ============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
        ============================================ -->
    <link rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap.min.css">
    <!-- Bootstrap CSS
        ============================================ -->
    <link rel="stylesheet" href="<?=base_url();?>assets/css/font-awesome.min.css">
    <!-- owl.carousel CSS
        ============================================ -->
    <link rel="stylesheet" href="<?=base_url();?>assets/css/owl.carousel.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/owl.theme.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/owl.transitions.css">
    <!-- animate CSS
        ============================================ -->
    <link rel="stylesheet" href="<?=base_url();?>assets/css/animate.css">
    <!-- normalize CSS
        ============================================ -->
    <link rel="stylesheet" href="<?=base_url();?>assets/css/normalize.css">
    <!-- meanmenu icon CSS
        ============================================ -->
    <link rel="stylesheet" href="<?=base_url();?>assets/css/meanmenu.min.css">
    <!-- main CSS
        ============================================ -->
    <link rel="stylesheet" href="<?=base_url();?>assets/css/main.css">
    <!-- educate icon CSS
        ============================================ -->
    <link rel="stylesheet" href="<?=base_url();?>assets/css/educate-custon-icon.css">
    <!-- morrisjs CSS
        ============================================ -->
    <link rel="stylesheet" href="<?=base_url();?>assets/css/morrisjs/morris.css">
    <!-- mCustomScrollbar CSS
        ============================================ -->
    <link rel="stylesheet" href="<?=base_url();?>assets/css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- metisMenu CSS
        ============================================ -->
    <link rel="stylesheet" href="<?=base_url();?>assets/css/metisMenu/metisMenu.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/metisMenu/metisMenu-vertical.css">
    <!-- calendar CSS
        ============================================ -->
    <link rel="stylesheet" href="<?=base_url();?>assets/css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/calendar/fullcalendar.print.min.css">
    <!-- x-editor CSS
        ============================================ -->
    <link rel="stylesheet" href="<?=base_url();?>assets/css/editor/select2.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/editor/datetimepicker.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/editor/bootstrap-editable.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/editor/x-editor-style.css">
    <!-- This page plugin CSS -->
    <link href="<?=base_url();?>assets/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- style CSS
        ============================================ -->
    <link rel="stylesheet" href="<?=base_url();?>assets/style.css">
    <!-- responsive CSS
        ============================================ -->
    <link rel="stylesheet" href="<?=base_url();?>assets/css/responsive.css">
    <!-- modernizr JS
        ============================================ -->
    <script src="<?=base_url();?>assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <!-- Toast -->
    <link rel="stylesheet" href="<?=base_url();?>assets/plugin/toast/jquery.toast.css">
    <!-- Sweet Alert -->
    <link rel="stylesheet" href="<?=base_url();?>assets/plugin/sweetalert/sweetalert2.css">
    
    
    <!-- jquery
        ============================================ -->
    <script src="<?=base_url();?>assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/i18n/id.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css"></link>
    <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.3.2/dist/select2-bootstrap4.min.css"></link>
    
<!-- Toast -->
<script type="text/javascript" src="<?=base_url();?>assets/plugin/toast/jquery.toast.js"></script>
<!-- Sweet Alert -->
<script type="text/javascript" src="<?=base_url();?>assets/plugin/sweetalert/sweetalert2.all.min.js"></script>
<!-- Validate -->
<script src="<?=base_url();?>assets/plugin/validate/just-validate.min.js"></script>
<!-- number -->
<script type="text/javascript" src="<?=base_url();?>assets/plugin/number/jquery.number.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/plugin/number/jquery.number.js"></script>
<!-- datetimepicker -->
<link href="<?= base_url(); ?>assets/plugin/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="<?= base_url(); ?>assets/plugin/datetimepicker/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<!-- tinymce -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugin/tinymce/tinymce.min.js"></script>
<script>
        tinymce.init({
        mode : "specific_textareas",
            editor_selector : "mceEditor",theme: "modern",width: 810,height: 300,relative_urls : false,remove_script_host : false,
        plugins: [
             "advlist autolink link image lists charmap print preview hr anchor pagebreak",
             "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
             "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
       ],
       toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
       toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
       image_advtab: true ,
       
       external_filemanager_path:"<?php echo base_url(); ?>assets/plugin/tinymce/plugins/filemanager/",
       filemanager_title:"Responsive Filemanager" ,
       external_plugins: { "filemanager" : "<?php echo base_url(); ?>assets/plugin/tinymce/plugins/filemanager/plugin.min.js"}
     });
</script>
</head>

<body onload="window.print()">
    <div class="all-content-wrapper">
        <!-- Static Table Start -->
        <div class="data-table-area mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    
                    <?php  $this->load->view($main_view); ?>

                </div>
            </div>
        </div>
        <!-- Static Table End -->
    </div>
</body>

</html>