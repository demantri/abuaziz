<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class neraca_saldo extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		if(!$this->session->userdata('no_user'))
        {
        	redirect('auth');
        }
        $this->load->model('model_neraca_saldo');
	}

	public function index()
	{
		$field = array('*');
		$condition = array(
			'delete' => "0"
		);
		$data = [
			'judul_form'=>'Data Neraca Saldo',
			'judul'=>'Neraca Saldo',
			'main_view'=>'view_neraca_saldo'
		];
		$this->load->view('template/index', $data);
	}
	
	public function get_neracasaldo()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		// $tahun=substr($periode,0,4);
		// $bulan=substr($periode,5,2);
		$hari = 01;
		$batas =  date("$tahun-$bulan-01");
		if($bulan=="01"){
			$namabulan="Januari";
		}else if($bulan=="02"){
			$namabulan="Februari";
		}else if($bulan=="03"){
			$namabulan="Maret";
		}else if($bulan=="04"){
			$namabulan="April";
		}else if($bulan=="05"){
			$namabulan="Mei";
		}else if($bulan=="06"){
			$namabulan="Juni";
		}else if($bulan=="07"){
			$namabulan="Juli";
		}else if($bulan=="08"){
			$namabulan="Agustus";
		}else if($bulan=="09"){
			$namabulan="September";
		}else if($bulan=="10"){
			$namabulan="Oktober";
		}else if($bulan=="11"){
			$namabulan="November";
		}else if($bulan=="12"){
			$namabulan="Desember";
		}
		
		$select = $this->db->select('akun.no_akun, akun.nama_akun, jurnal.nominal, jurnal.posisi, transaksi.tanggal_transaksi');
		$select	->from('jurnal');
		$select	->join('akun','jurnal.no_akun=akun.no_akun');
		$select	->join('transaksi','jurnal.no_transaksi=transaksi.no_transaksi');
		$select	->where(array('YEAR(tanggal_transaksi)' => $tahun, 'MONTH(tanggal_transaksi)' => $bulan));

		$select1 = $select ->group_by('jurnal.no_akun')->get()->result_array();
		// echo "<pre>"; print_r($select1); echo "</pre>"; die();
		$saldoawal=0;
		$array = array();
		foreach ($select1 as $row) {
			$row['saldo']	= $this->getsaldo($row['no_akun'], $tahun, $bulan);
			// $row['saldo']	= $row['nominal'];
			$array[]		= $row;
		}
		// echo "<pre>"; print_r($array); echo "</pre>"; die();
		
			echo "<center>
			        <h2>SD Abu Aziz</h2>
					<h2>Neraca Saldo</h2>
					<h2>Periode ".$namabulan." ".$tahun." </h2>
					</br>
				  </center>";
		
			echo "<table class='table table-striped table-bordered table-hover'>
				<thead>
					<tr>
						<th rowspan=2>no akun</th>
						<th rowspan=2>nama akun</th>
						<th>debit</th>
						<th>kredit</th>
					</tr>
				</thead>";
				echo "<tbody>"; $totald = 0; $totalk = 0;
				foreach ($array as $data) {
					echo "<tr>";
					echo 	"<td>".$data['no_akun']."</td>";
					echo 	"<td>".$data['nama_akun']."</td>";
					if (substr($data['no_akun'], 0, 1) == '1') {
						if ($data['saldo'] >= 0) {
							echo "<td>".number_format($data['saldo'],0,',','.')."</td>";
							echo "<td></td>";
							$totald += $data['saldo'];
						} else {
							echo "<td>".str_replace('-','',number_format($data['saldo'],0,',','.'))."</td>";
							echo "<td></td>";
							$totald -= $data['saldo'];

						}
					} else {
						if ($data['saldo'] >= 0) {
							echo "<td></td>";
							echo "<td>".number_format($data['saldo'],0,',','.')."</td>";
							$totalk += $data['saldo'];
						} else {
							echo "<td>".str_replace('-','',number_format($data['saldo'],0,',','.'))."</td>";
							echo "<td></td>";
							$totalk -= $data['saldo'];
						}

					}
					echo "</tr>";
				}
				echo "</tbody>";
				echo "<tfoot>";
				echo 	"<tr>";
				echo 		"<td colspan='2'>Total</td>";
				echo 		"<td>".number_format($totald,0,',','.')."</td>";
				echo 		"<td>".number_format($totalk,0,',','.')."</td>";
				echo 	"</tr>";
				echo "</tfoot>";
				
			echo "</table>";
	}

	public function getsaldo($no, $tahun, $bulan)
	{
		$select = $this->db->select('akun.no_akun, akun.nama_akun, jurnal.nominal, jurnal.posisi, transaksi.tanggal_transaksi');
		$select	->from('jurnal');
		$select	->join('akun','jurnal.no_akun=akun.no_akun');
		$select	->join('transaksi','jurnal.no_transaksi=transaksi.no_transaksi');
		$select	->where(array('YEAR(tanggal_transaksi)' => $tahun, 'MONTH(tanggal_transaksi)' => $bulan, 'jurnal.no_akun' => $no));
		$saldo = 0;
		foreach ($select->get()->result_array() as $rows) {
			if ($rows['posisi'] == 'debit') {
				if (substr($rows['no_akun'], 0, 1) == '1') {
					$saldo += $rows['nominal'];
				} else {
					$saldo -= $rows['nominal'];
				}
			} else {
				if (substr($rows['no_akun'], 0, 1) == '1') {
					$saldo -= $rows['nominal'];
				} else {
					$saldo += $rows['nominal'];
				}
			}
		}
		return $saldo;
	}
}
