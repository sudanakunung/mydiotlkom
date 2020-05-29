<!DOCTYPE html>
<html>
   <head>
      <title>Mydiosing - Admin</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <?php include 'css.php'; ?>
      <style type="text/css">
         .cke_chrome{
         border: 1px solid #cacaca !important;
         }
         .cke_bottom{
         background:#f0474e !important;
         }
         tbody tr td button{
         padding: 5px 10px !important
         }
      </style>
      <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>plugins/sweetalert-master/dist/sweetalert.css">
    <script type="text/javascript" src="<?php echo base_url();?>plugins/sweetalert-master/dist/sweetalert.min.js"></script>
   </head>
   <body>
      <div class="app app-default">
        <?php include 'sidebar.php'; ?>

         <div class="app-container">
            <?php include 'header.php'; ?>
            <div class="row">
               <div class="col-xs-12">
                  <div class="contianer">
                     <div class="row">
                        <div class="col-md-12">
                          <?php if ($this->session->flashdata('berhasil') != null): ?>
                            <div class="alert alert-warning alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <?php echo $this->session->flashdata('berhasil');?>
                           </div>
                          <?php endif ?>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <!--main form-->
                           <div class="card">
                              <div class="card-header">
                                 Daftar Artikel
                              </div>
                              <div class="card-body no-padding">
                                 <table class="datatable table table-striped primary" cellspacing="0" width="100%" id="table">
                                    <thead>
                                       <tr>
                                          <th>No</th>
                                          <th>Artikel</th>
                                          <th>Bahasa</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                           <!--end main form-->
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <?php include 'footer.php'; ?>
         </div>
      </div>
      <?php include 'js.php'; ?>
    <script type="text/javascript" src="<?php echo base_url();?>assets/cookie.js"></script>

      <script>
        var table = null;
        
         $(document).ready(function($) {
           $.removeCookie("csrf");
          table = $('#table').DataTable({
            "dom": '<"top"fl<"clear">>rt<"bottom"ip<"clear">>',
              "oLanguage": {
                "sSearch": "",
                "sLengthMenu": "_MENU_"
              },
              "initComplete": function initComplete(settings, json) {
                $('div.dataTables_filter input').attr('placeholder', 'Search...');
                // $(".dataTables_wrapper select").select2({
                //   minimumResultsForSearch: Infinity
                // });
              },
            'paging'      : true,
            'lengthChange': true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            //"bDdestroy" : true,
            // Load data for the table's content from an Ajax source
            "ajax": {
              "url": "<?php echo site_url('AdminPost/getPost');?>",
              "type": "POST",
              },
              "columnDefs": [
                {
                  "targets": [ 0 ], //first column / numbering column
                  "orderable": false, //set not orderable
                },
              ],
          });
        });
         function hapus(kode) {

          var csrf = $.cookie("csrf");
          if (csrf == null) {
            csrf = '<?php echo $this->security->get_csrf_hash(); ?>';
          }
                swal({
                  title: "Data Akan dihapus?",
                  text: "Data yang sudah dihapus tidak bisa dikembalikan!",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#0760ef",
                  confirmButtonText: "Ya, Hapus!",
                  cancelButtonText: "Batal!",
                  closeOnConfirm: false,
                  closeOnCancel: false
                },
                function(isConfirm){
                  if (isConfirm) {
                    jQuery.ajax({
                    type: "POST",
                    url: "<?php echo site_url('AdminPost/delete');?>",
                    dataType: 'json',
                    data: {id:kode, <?php echo $this->security->get_csrf_token_name(); ?>:csrf},
                    success: function(res){
                        if(res.res =true){
                            swal({
                                title: "Sukses",
                                text: "Data Berhasil di Hapus",
                                showConfirmButton: true,
                                confirmButtonColor: '#0760ef',
                                type:"success"
                            },
                            function(){
                              table.ajax.reload();
                              $.removeCookie("csrf");
                              $.cookie("csrf", ""+res.token);
                            });
                        }
                    }
                    });
                  } else {
                    swal("Batal", "Data Aman.... :)", "error");
                  }
                });
            }
      </script>
   </body>
</html>