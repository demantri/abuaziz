<?php 
	$con=new konfig();
?>
<li>
	<a title="Landing Page" href="<?= site_url('dashboard'); ?>" aria-expanded="false"><span class="educate-icon educate-home icon-wrap" aria-hidden="true"></span> <span class="mini-click-non">Home</span></a>
</li>
<?php if($this->session->userdata('jabatan')=="Tata Usaha"){?>
<li>
	<a class="has-arrow" href="#">
		   <span class="educate-icon educate-course icon-wrap"></span>
		   <span class="mini-click-non">Master Data</span>
		</a>
	<ul class="submenu-angle" aria-expanded="true">
		<li><a href="<?= site_url('akun'); ?>"><span class="mini-sub-pro">Akun</span></a></li>
		<!-- <li><a href="<?= site_url('pegawai'); ?>"><span class="mini-sub-pro">Pegawai</span></a></li> -->
		<li><a href="<?= site_url('siswa'); ?>"><span class="mini-sub-pro">Siswa</span></a></li>
		<li><a href="<?= site_url('master_pendapatan'); ?>"><span class="mini-sub-pro">Jenis Pend Lain-lain</span></a></li>
		<li><a href="<?= site_url('rincian_biaya'); ?>"><span class="mini-sub-pro">Rincian Biaya</span></a></li>
		<li><a href="<?= site_url('potongan_biaya'); ?>"><span class="mini-sub-pro">Potongan Biaya</span></a></li>
		<li><a href="<?= site_url('tahun_ajaran'); ?>"><span class="mini-sub-pro">Tahun Angkatan</span></a></li>
		<li><a href="<?= site_url('kelas'); ?>"><span class="mini-sub-pro">Kelas</span></a></li>
	</ul>
</li>
<li>
	<a class="has-arrow" href="#">
		   <span class="educate-icon educate-data-table icon-wrap"></span>
		   <span class="mini-click-non">Transaksi</span>
		</a>`
	<ul class="submenu-angle" aria-expanded="true">
		<!-- <li><a href="<?= site_url('pendaftaran'); ?>"><span class="mini-sub-pro">Pendaftaran</span></a></li> -->
		<li><a href="<?= site_url('daftar_ulang'); ?>"><span class="mini-sub-pro">Daftar Ulang</span></a></li>
		<li><a href="<?= site_url('pendapatan_dll'); ?>"><span class="mini-sub-pro">Pendapatan Lain-lain</span></a></li>
        <li><a href="<?= site_url('spp'); ?>"><span class="mini-sub-pro"> SPP Bulanan</span></a></li>
	</ul>
</li>
<li>
	<a class="has-arrow" href="#">
		   <span class="educate-icon educate-charts icon-wrap"></span>
		   <span class="mini-click-non">Laporan</span>
		</a>
	<ul class="submenu-angle" aria-expanded="true">
		<li><a href="<?= site_url('jurnal'); ?>"><span class="mini-sub-pro">Jurnal Umum</span></a></li>
		<li><a href="<?= site_url('buku_besar'); ?>"><span class="mini-sub-pro">Buku Besar</span></a></li>
		<li><a href="<?= site_url('neraca_saldo'); ?>"><span class="mini-sub-pro">Neraca Saldo</span></a></li>
		<li><a href="<?= site_url('laporan_kas'); ?>"><span class="mini-sub-pro">Laporan Kas Masuk</span></a></li>
        <li><a href="<?= site_url('laporan_pemb'); ?>"><span class="mini-sub-pro">Pembayaran SPP</span></a></li>
        <li><a href="<?= site_url('laporan_tung'); ?>"><span class="mini-sub-pro">Tunggakan SPP</span></a></li>
	</ul>
</li>
<?php }?>

<?php if($this->session->userdata('jabatan')=="Bendahara Yayasan"){?>
<li>
	<a class="has-arrow" href="#">
		   <span class="educate-icon educate-course icon-wrap"></span>
		   <span class="mini-click-non">Master Data</span>
		</a>
	<ul class="submenu-angle" aria-expanded="true">
		<li><a href="<?= site_url('beban_beban'); ?>"><span class="mini-sub-pro">Beban-beban</span></a></li>
		<li><a href="<?= site_url('pegawai'); ?>"><span class="mini-sub-pro">Pegawai</span></a></li>
		<li><a href="<?= site_url('siswa'); ?>"><span class="mini-sub-pro">Siswa</span></a></li>
		<li><a href="<?= site_url('master_pengeluaran'); ?>"><span class="mini-sub-pro">Pengeluaran Lain-lain</span></a></li>
	</ul>
</li>
<li>
	<a class="has-arrow" href="#">
		   <span class="educate-icon educate-course icon-wrap"></span>
		   <span class="mini-click-non">Transaksi</span>
		</a>
	<ul class="submenu-angle" aria-expanded="true">
		<li><a href="<?= site_url('pendapatan'); ?>"><span class="mini-sub-pro">Pendapatan</span></a></li>
		<li><a href="<?= site_url('pendapatan_dll'); ?>"><span class="mini-sub-pro">Pendapatan Lain-lain</span></a></li>
		<li><a href="<?= site_url('beban'); ?>"><span class="mini-sub-pro">Pengeluaran Beban</span></a></li>
	</ul>
</li>
<li>
	<a class="has-arrow" href="#">
		   <span class="educate-icon educate-course icon-wrap"></span>
		   <span class="mini-click-non">Laporan</span>
		</a>
	<ul class="submenu-angle" aria-expanded="true">
		<li><a href="<?= site_url('jurnal'); ?>"><span class="mini-sub-pro">Jurnal</span></a></li>
		<li><a href="<?= site_url('buku_besar'); ?>"><span class="mini-sub-pro">Buku Besar</span></a></li>
	</ul>
</li>
<?php }?>

<?php if($this->session->userdata('jabatan')=="Ketua Yayasan"){?>
<li>
	<a class="has-arrow" href="#">
		   <span class="educate-icon educate-course icon-wrap"></span>
		   <span class="mini-click-non">Laporan</span>
		</a>
	<ul class="submenu-angle" aria-expanded="true">
		<li><a href="<?= site_url('jurnal'); ?>"><span class="mini-sub-pro">Jurnal</span></a></li>
		<li><a href="<?= site_url('buku_besar'); ?>"><span class="mini-sub-pro">Buku Besar</span></a></li>
	</ul>
</li>
<?php }?>

<?php if($this->session->userdata('jabatan')=="Bagian Operasional"){?>
<li>
	<a class="has-arrow" href="#">
		   <span class="educate-icon educate-course icon-wrap"></span>
		   <span class="mini-click-non">Master Data</span>
		</a>
	<ul class="submenu-angle" aria-expanded="true">
		<li><a href="<?= site_url('siswa'); ?>"><span class="mini-sub-pro">Siswa</span></a></li>
	</ul>
</li>
<li>
	<a class="has-arrow" href="#">
		   <span class="educate-icon educate-course icon-wrap"></span>
		   <span class="mini-click-non">Transaksi</span>
		</a>
	<ul class="submenu-angle" aria-expanded="true">
		<li><a href="<?= site_url('pendaftaran'); ?>"><span class="mini-sub-pro">Pendaftaran</span></a></li>
<!-- 		<li><a href="<?= site_url('daftar_ulang'); ?>"><span class="mini-sub-pro">Daftar Ulang</span></a></li>
		<li><a href="<?= site_url('pendapatan_dll'); ?>"><span class="mini-sub-pro">Pendapatan Lain-lain</span></a></li> -->
	</ul>
</li>
<?php }?>

<?php if($this->session->userdata('jabatan')=="ayam"){?>

<li>
	<a class="has-arrow" href="#">
		   <span class="educate-icon educate-course icon-wrap"></span>
		   <span class="mini-click-non">Master Data</span>
		</a>
	<ul class="submenu-angle" aria-expanded="true">
		<li><a href="<?= site_url('akun'); ?>"><span class="mini-sub-pro">Akun</span></a></li>
		<li><a href="<?= site_url('beban_beban'); ?>"><span class="mini-sub-pro">Beban-beban</span></a></li>
		<li><a href="<?= site_url('aset'); ?>"><span class="mini-sub-pro">Aset</span></a></li>
		<li><a href="<?= site_url('pegawai'); ?>"><span class="mini-sub-pro">Pegawai</span></a></li>
		<li><a href="<?= site_url('siswa'); ?>"><span class="mini-sub-pro">Siswa</span></a></li>
		<li><a href="<?= site_url('master_pendapatan'); ?>"><span class="mini-sub-pro">Pendapatan Lain-lain</span></a></li>
		<li><a href="<?= site_url('master_pengeluaran'); ?>"><span class="mini-sub-pro">Pengeluaran Lain-lain</span></a></li>
	</ul>
</li>
<li>
	<a class="has-arrow" href="#">
		   <span class="educate-icon educate-course icon-wrap"></span>
		   <span class="mini-click-non">Transaksi</span>
		</a>
	<ul class="submenu-angle" aria-expanded="true">
		<li><a href="<?= site_url('pendaftaran'); ?>"><span class="mini-sub-pro">Pendaftaran</span></a></li>
		<li><a href="<?= site_url('daftar_ulang'); ?>"><span class="mini-sub-pro">Daftar Ulang</span></a></li>
		<li><a href="<?= site_url('spp'); ?>"><span class="mini-sub-pro">SPP Bulanan</span></a></li>
		<li><a href="<?= site_url('pendapatan'); ?>"><span class="mini-sub-pro">Pendapatan</span></a></li>
		<li><a href="<?= site_url('pendapatan_dll'); ?>"><span class="mini-sub-pro">Pendapatan Lain-lain</span></a></li>
		<li><a href="<?= site_url('beban'); ?>"><span class="mini-sub-pro">Pengeluaran Beban</span></a></li>
	</ul>
</li>
<li>
	<a class="has-arrow" href="#">
		   <span class="educate-icon educate-course icon-wrap"></span>
		   <span class="mini-click-non">Laporan</span>
		</a>
	<ul class="submenu-angle" aria-expanded="true">
		<li><a href="<?= site_url('jurnal'); ?>"><span class="mini-sub-pro">Jurnal</span></a></li>
		<li><a href="<?= site_url('buku_besar'); ?>"><span class="mini-sub-pro">Buku Besar</span></a></li>
	</ul>
</li>
<?php }?>

<!-- admin -->
<?php if ($this->session->userdata('jabatan') == "admin") { ?>
	<li>
		<a title="Landing Page" href="<?= site_url('users'); ?>" aria-expanded="false"><span class="educate-icon educate-course icon-wrap" aria-hidden="true"></span> <span class="mini-click-non">Users</span></a>
	</li>
<?php } ?>