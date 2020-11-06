<!-- Modal add -->
<div class="modal fade" id="modal-add-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Users</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- <div class="modal-body"> -->
        <!--  -->
        <form method="POST" action="<?= site_url('users/save') ?>">
          <div class="modal-body">

            <div class="form-group row">
                <label for="username" class="col-sm-3 col-form-label">Username</label>
                <div class="col-sm-9">
                <input type="text" name="username" class="form-control username" placeholder="Username" autocomplete="off" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-9">
                <input type="password" class="form-control password" id="password" name="password" placeholder="Password" autocomplete="off" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                <div class="col-sm-9">
                <input type="text" class="form-control jabatan" id="jabatan" name="jabatan" placeholder="Jabatan" autocomplete="off" required>
                </div>
            </div>

          </div>
        <!-- </form> -->
      <!-- </div> -->
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <input type="submit" id="btn-save" class="btn btn-primary" value="Save changes">
	      </div>
  		</form>
    </div>
  </div>
</div>

<!-- Modal edit -->
<?php foreach ($user as $r) { ?>
	<div class="modal fade" id="modal-edit-user<?= $r->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Users</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- <div class="modal-body"> -->
        <!--  -->
        <form method="POST" action="<?= site_url('users/update') ?>">
          <div class="modal-body">

          	<input type="text" name="id" id="id" class="hidden" value="<?= $r->id?>">

            <div class="form-group row">
                <label for="username" class="col-sm-3 col-form-label">Username</label>
                <div class="col-sm-9">
                <input type="text" name="username_edit" class="form-control username1" placeholder="Username" id="username1" value="<?= $r->username ?>" autocomplete="off">
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-9">
                <input type="password" class="form-control password1" id="password2" name="password_edit" placeholder="Password" value="<?= $r->password ?>" autocomplete="off">
                </div>
            </div>

            <div class="form-group row">
                <label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                <div class="col-sm-9">
                <input type="text" class="form-control jabatan1" id="jabatan2" name="jabatan_edit" placeholder="Jabatan" value="<?= $r->jabatan?>" autocomplete="off">
                </div>
            </div>
          </div>
      <!-- </div> -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" id="btn-edit" class="btn btn-success">Update</button> -->
	    <input type="submit" id="btn-edit" class="btn btn-primary" value="Update">
      </div>
      </form>
    </div>
  	</div>
	</div>
<?php } ?>

<!-- js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/core.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/md5.js"></script>
<!-- <script src="https://https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.js"></script> -->

<!-- <script type="text/javascript">
	$(document).ready(function() {

	    tampil_data();

	    $('#table').DataTable({

	    	"processing":true,  
           	"serverSide":true,
           	"responsive": true,
           	// "order":[], 
           	"ajax" : {
           		url : "<?= base_url('users/list_data') ?>",
	    		type: "POST"
           	},
           	"columnDefs":[  
                {  
                     "targets":[0],  
                     "orderable":true
                },  
           	],  
	    });

	    // save
	    $('#btn-save').on('click' , function () {
	      // alert('ke klik')
	      // ambil data nya dulu
	      let username = $('.username').val();
	      let password = $('.password').val();
	      let jabatan  = $('.jabatan').val();

	      // console.log(username)

	      $.ajax ({
	        type : "POST",
	        url : "<?= base_url('users/save') ?>",
	        dataType: "JSON",
	        data: {
	          username:username,
	          password:password,
	          jabatan:jabatan
	        }, 
	        success: function (data) {
	          // console.log(data)
	          $('[name = "username"]').val("");
	          $('[name = "password"]').val("");
	          $('[name = "jabatan"]').val("");
	          $('#modal-add-user').modal("hide");
	          // location.reload()
	          tampil_data();
	        }
	      });
	      return false;
	    });

	    // tampil
	    function tampil_data() {
	      // body...
	      $.ajax ({
	        type : "GET",
	        url : "<?= base_url('users/list_data') ?>", 
	        async : true,
	        dataType: "JSON",
	        success:function (data) {
	          let html = '';
	          let i;
	          let no = '1';
	          for(i=0; i<data.length; i++){
	            html += '<tr>'+
		                    '<td>'+ no++ +'</td>'+
		                    '<td>'+data[i].username+'</td>'+
		                    '<td>'+CryptoJS.MD5(data[i].password).toString()+'</td>'+
		                    '<td style="text-align:center;">'+
		                    '<a data-toggle="modal" data-target="#modal-edit-user" class="btn btn-warning btn-xs edit" data="'+data[i].id+'"><i class="fa fa-pencil"></i></a>'+' '+
		                    '<a href="javascript:;" class="btn btn-danger btn-xs hapus" data="'+data[i].id+'"><i class="fa fa-trash"></i></a>'+
		                    '</td>'+
	                    '</tr>';
	          }
	          $('#show_data').html(html);
	        }
	      });
	    }

	    // show before edit
	    $('#show_data').on('click', '.edit', function () {
	      // ambil id
	      	let id = $(this).attr('data');
	      
	      	$.ajax ({
		        type : "GET",
		        url : "<?= base_url('users/get_user') ?>",
		        dataType: "JSON",
		        data : {id:id},
		        success:function (data) {
		          $.each(data, function (id, username, password, jabatan) {
		            $('#modal-edit-user').modal("show");
		            $('[name = "id"]').val(data.id);
		            $('[name = "username_edit"]').val(data.username);
		            $('[name = "password_edit"]').val(CryptoJS.MD5(data.password).toString());
		            $('[name = "jabatan_edit"]').val(data.jabatan);
		          });
		        }
	      	});
	      	return false;
	    });

	    // update data
	    $('#btn-edit').on('click',function(){

	      	let id = $('#id').val();
	      	let username = $('#username1').val();
	      	let password = $('#password2').val();
	      	let jabatan = $('#jabatan2').val();

	      	// alert(password)
	      	$.ajax({
	        	type : "POST",
	        	url  : "<?php echo base_url('users/update_data')?>",
	        	dataType : "JSON",
	        	data : {
	          		id:id,
	          		username:username,
	          		password:password,
	          		jabatan:jabatan
	        	},
	        	success: function(data)
	          		{
			            $('[name = "id"]').val("");
			            $('[name = "username_edit"]').val("");
			            $('[name = "password_edit"]').val("");
			            $('[name = "jabatan_edit"]').val("");
			            $('#modal-edit-user').modal("hide");
	            		tampil_data();
	            		location.reload();
	          		}
	      		});
	      	return false;
	    });
  	});
</script>