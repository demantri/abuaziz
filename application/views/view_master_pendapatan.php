<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:none" id="modal-form-master_pendapatan">
	<div class="sparkline13-list">
		<div class="sparkline13-hd">
			<div class="main-sparkline13-hd">
				<h1 id="form-title"></h1>
			</div>
		</div>
		<div class="sparkline13-graph">
			<div class="datatable-dashv1-list custom-datatable-overright">
				<form action="#" class="js-form-master_pendapatan form" id="form-master_pendapatan">
					<label for="password">Nama Master Pendapatan</label>
					<div class="form-group">
						<div class="form-line">
							<input type="hidden" data-validate-field="aksi" name="aksi" id="aksi" class="form-control">
							<input type="text" placeholder="Nama Master Pendapatan" data-validate-field="nama_pendapatan" name="nama_pendapatan" id="nama_pendapatan" class="form-control">

							<?php if($this->session->userdata('jabatan') == 'Bendahara Yayasan'){ ?>
								<br>
								<select class="form-control" name="no_akun" required=""  data-validate-field="no_akun" id="no_akun">
									<option value="">Pilih Akun</option>
									<?php foreach ($akun as $row) { ?>
										<option value="<?= $row['no_akun'] ?>"><?= $row['no_akun']." - ".$row['nama_akun'] ?></option>
									<?php } ?>
								</select>
							<?php } ?>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" name="simpan" class="btn btn-sm btn-default" onclick="batal()">Batal</button>
						<button type="submit" name="simpan" class="btn btn-sm btn-primary" >Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:true" id="modal-data-master_pendapatan">
	<div class="sparkline13-list">
		<div class="sparkline13-hd">
			<div class="main-sparkline13-hd">
				<h1><?php echo $judul_form; ?></h1>
			</div>
		</div>
		<div class="sparkline13-graph">
			<div class="datatable-dashv1-list custom-datatable-overright">
				<button type="button" class="btn btn-sm btn-primary" name="tambah_master_pendapatan" onclick="tambah()">Tambah <?php echo $judul; ?></button>
				<br/>
				<br/>
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="table">
						<thead>
							<tr>
								<th>No</th>
								<th>No Pendapatan</th>
								<?php if($this->session->userdata('jabatan') == 'Bendahara Yayasan'){ 
									echo "<th>Akun</th>";
								}?>
								<th>Nama Master Pendapatan</th>
								<th>Aksi</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    //datatables
    table = $('#table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('master_pendapatan/ajax_list')?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0,-1 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],

    });
	// table.ajax.reload();  //just reload table
});

	function tambah() {
      $('#modal-form-master_pendapatan').fadeIn('slow');
      $('#modal-data-master_pendapatan').fadeOut('slow');
	  $('#form-title').html("Tambah Data");
	  $('#aksi').val("tambah");
    }
	
	function batal() {
      $('#modal-form-master_pendapatan').fadeOut('slow');
      $('#modal-data-master_pendapatan').fadeIn('slow');
	  $('#form-title').html("");
	  $('#form-master_pendapatan')[0].reset();
    }
	
	function edit(no_pendapatan){
		$.ajax({
			url:'<?= site_url(); ?>/master_pendapatan/data/',
			data: {'no_pendapatan':no_pendapatan},
            type:'POST',
			dataType:'JSON',
			success:function(msg){
				$('input[name="aksi"]').val(msg.no_pendapatan);
				$('input[name="nama_pendapatan"]').val(msg.nama_pendapatan);
				
				$('#modal-form-master_pendapatan').fadeIn('slow');
				$('#modal-data-master_pendapatan').fadeOut('slow');
				$('#form-title').html("Edit Data");
			}
		});
	}
	
	function hapus(no_pendapatan){
		Swal.fire({
		  title: 'Hapus Data Ini?',
		  text: "Kalo Udah Dihapus Ga Akan Balik Lagi Loh!",
		  type: 'question',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Hapus!',
		  cancelButtonText: 'Jangan!',
		  reverseButtons: true
		}).then((result) => {
		  if (result.value) {
			$.ajax({
				url:'<?= site_url(); ?>/master_pendapatan/hapus/',
				data: {'no_pendapatan':no_pendapatan},
				type:'POST',
				dataType:'JSON',
				success: function(response) {
					if(response.status) {
						$.toast({
							heading: 'Info',
							text: 'Data Berhasil dihapus!',
							position: 'top-right',
							showHideTransition: 'slide',
							icon: 'info'
						});
						table.ajax.reload();  //just reload table
						batal();  //just reload table
					} else{
						$.toast({
							heading: 'Bahaya',
							text: response.message,
							position: 'top-right',
							showHideTransition: 'slide',
							icon: 'error'
						});
					}
				}
			});
		  }else{
			Swal.fire(
			  'Batal',
			  'Data Batal Untuk Dihapus',
			  'warning'
			)
		  }
		});
	}
	
	
	new window.JustValidate('.js-form-master_pendapatan', {
        rules: {
            nama_pendapatan: {
                required: true
            },
            no_akun : {
            	required : true
            }
        },
		messages: {
		  nama_pendapatan: {
			required: 'Form Tidak Boleh Kosong'
		  },
		  no_akun: {
			required: 'Form Tidak Boleh Kosong'
		  }
		},

        submitHandler: function (form, values, ajax) {
		var aksi = document.getElementById('aksi').value;
		if(aksi=="tambah"){
			var url = "<?= site_url('master_pendapatan/tambah'); ?>";
		}else{
			var url = "<?= site_url('master_pendapatan/ubah'); ?>";
		}
            $.ajax({
			  url: url,
			  method: "POST",
			  data: values,
			  dataType: "JSON",
			  success: function(response) {
				if(response.status) {
					$.toast({
						heading: 'Info',
						text: 'Data Berhasil Ditambah!',
						position: 'top-right',
						showHideTransition: 'slide',
						icon: 'info'
					});
					table.ajax.reload();  //just reload table
					batal();  //just reload table
				} else{
					$.toast({
						heading: 'Bahaya',
						text: response.message,
						position: 'top-right',
						showHideTransition: 'slide',
						icon: 'error'
					});
				}
			  }
			});
        },
    });
</script>
