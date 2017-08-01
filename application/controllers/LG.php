<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LG extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
	parent::__construct();
	$this->load->model('mymodel');
	$this->load->database();
	}


	function header(){
		$data = array();
		return $this->load->view('global/header',$data,true);
	}

	function footer(){
		$data = array();
		return $this->load->view('global/footer',$data,true);
	}



	public function index()
	{
		$data = array();
		$data['event_time']="2018-11-30 23:59:00";
		$comp = array(
			'content' => $this->load->view('LG/index',$data,true),
			'header' => '',
			'footer' => '',
		);
		$this->load->view('layout/index',$comp);
	}

	public function syarat()
	{
		$data = array();

		$comp = array(
			'content' => $this->load->view('LG/syarat',$data,true),
			'header' => '',
			'footer' => '',
		);
		$this->load->view('layout/index',$comp);
	}

	public function winvoucer()
	{
		$data = array();

		$comp = array(
			'content' => $this->load->view('LG/voucher-menang',$data,true),
			'header' => '',
			'footer' => '',
		);
		$this->load->view('layout/index',$comp);
	}

	public function voucer()
	{
		$data = array();

		$comp = array(
			'content' => $this->load->view('LG/voucher-kalah',$data,true),
			'header' => '',
			'footer' => '',
		);
		$this->load->view('layout/index',$comp);
	}


	public function cam_360()
	{
		$data = array();
		$data['event_time']="2016-11-03 23:59:00";
		$comp = array(
			'content' => $this->load->view('LG/cam_360',$data,true),
			'header' => $this->header(),
			'footer' => $this->footer(),
		);
		$this->load->view('layout/index',$comp);
	}

	public function inputfb(){
		$fb_id = $_POST['id'];
		$nama = $_POST['nama'];
		$email = $_POST['email'];
		$k=substr(md5($email),1, 5);
		$rand=rand(1111,9999);
		$kode=$rand.$k;

		$data = array(
			'fb_id' => $fb_id,
			'nama' => $nama,
			'email' => $email,
			'kode' => $kode,
			'created_at' => date("Y-m-d H:i:s")
		);

		$members = $this->mymodel->get_fb($email);
		$totalmember=$this->mymodel->get_total_fb();
		$totalmember=$totalmember[0]['total'];

		if(empty($members)){
			$res = $this->mymodel->InsertData('register_fb',$data);
			if($res){
			$input['nama']=$nama;
			$input['email']=$email;
			$input['kode']=$kode;

			$dataArray = array(
				'nama'=>$input['nama'],
				'email'=>$input['email'],
				'kode_unik'=>$kode,
			);
			$this->send_addmember($dataArray);
			print json_encode(array('status'=>true,'nama'=>$input['nama'],'email'=>$input['email'],'totalmember'=>$totalmember));
			die;
		}else{
			print json_encode(array('status'=>false,'status'=>'gagal','totalmember'=>$totalmember));
			die;
		}

		}

		print json_encode(array('status'=>true,'data'=>$data,'members'=>$members,'totalmember'=>$totalmember));
		die;
	}


	function register() {
		$nama = $_POST['nama'];
		$email = $_POST['email'];
		$telp = $_POST['telp'];

		$data = array(
			'nama' => $nama,
			'email' => $email,
			'telp' => $telp,
		);

		$res = $this->mymodel->InsertData('registration',$data);
		print json_encode(array('status'=>true));
	 }

	function checkEmail()
	{

	$result['email']="";
	$result2['telp']="";
	$email = $_POST['email'];
	$telp = $_POST['telp'];

	$where1="where email = '$email'";
	$query1 = $this->mymodel->get_registration($where1);

	$where2="where telp = ".$telp;
	$query2 = $this->mymodel->get_registration($where2);

	foreach($query1 as $row1) {
	$result['email']=$row1->email;
	}

	foreach($query2 as $row2) {
	$result2['telp']=$row2->telp;
	}

	if(($result['email']) || ($result2['telp'])){
		print_r(json_encode(array('status'=>1,'email'=>$result['email'],'telp'=>$result2['telp'])));	die;
	}else{
		print_r(json_encode(array('status'=>0)));die;
	}


	}



	 /**
	  * Update the specified resource in storage.
	  *
	  * @param  int  $id
	  * @return Status
	 **/
	 public function updatecontact()
	 {
		$nama = $_POST['nama'];
		$email = $_POST['email'];
		$telp = $_POST['telp'];
		$k=substr(md5($email),1, 5);
		$rand=rand(1111,9999);
		$kode=$rand.$k;


		$data = array(
			'nama' => $nama,
			'email' => $email,
			'telp' => $telp,
			'kode' => $kode,
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s"),
		);

		$res = $this->mymodel->InsertData('registration',$data);
		if($res){
			$input['nama']=$nama;
			$input['email']=$email;
			$input['kode']=$kode;

			$dataArray = array(
				'nama'=>$input['nama'],
				'email'=>$input['email'],
				'kode_unik'=>$kode,
			);
			$this->send_addmember($dataArray);
			print json_encode(array('status'=>true,'nama'=>$input['nama'],'email'=>$input['email'],'kode'=>$input['kode']));
		}else{
			print json_encode(array('status'=>false,'status'=>'gagal'));
		}
	 }

	 function get_members($last_id, $num){
		$members = DB::table('register_fb')
		->where('id', '>', $last_id)
		->take($num)->get();
		return $members;
	}

	function send_email(){
		$last_id = 0;
		$num = 2;
		$members = $this->get_members($last_id, $num);
		while ($members != null && !empty($members)) {
			foreach($members as $one_member) {
				$last_id = $one_member->id;
				$username = trim($one_member->nama);
				$email = trim($one_member->email);
				echo "Sending to #{$last_id}: {$email}\n";
				$dataArray = array(
					'email' => $email,
					'namemember' => $username
				);
				$results = $this->send_addmember($dataArray);
				print_r($results); echo "\n\n";
			}
			unset($members);
			$members = '';
		}
		unset($members);
	}


	function template_email(){
		$template='
		<html lang="en">
		 <head>

				 <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

				 <style type="text/css">
					 body {
						 background: #ffffff;
						 margin:0;
						 padding:0;
						 border:0;
						 outline:0;
						 font-size:100%;
						 font-family: Open Sans, sans-serif, Arial, Helvetica;
						 color: #6c6d6f;
					 }
					 table {
						 border-collapse:collapse;
						 border-spacing:0;
					 }
					 h2 {
						 margin-bottom:50px;
						 font-weight:400;
					 }
					 h1 {
						 color:#181818;
						 font-size:24px;
						 font-family: Open Sans, sans-serif, Arial, Helvetica;
						 font-weight:400;
					 }
					 p {
						 color: #58595b;
						 font-size:16px;
					 }
				 </style>
			 </head>

		 <body id="body" style="background: #ffffff;margin:0;padding:0;border:0;outline:0;font-size:100%;font-family: Open Sans;color: #6c6d6f;">

			 <table width="750" cellpadding="0" cellspacing="0">
					 <tr>
						 <td align="center" valign="top">
							 <img src="http://berbagi-energi.com/image/header-email.jpg">
						 </td>
					 </tr>
					 <tr>
						 <td align="center" valign="top" style="padding-top:45px">
							 <table border="0" cellpadding="0" cellspacing="0" width="75%">
								 <tr>
									 <td>
										 <h2 style="font-family: Open Sans, sans-serif, Arial, Helvetica;">Hi, !#NAME!</h2>
										 <h1><span style="color:#b81e4e">Selamat!</span> Anda memenangkan Voucher<br>Sodexo sebesar Rp100rb</h1>
										 <p style="margin-bottom:20px;font-family: Open Sans, sans-serif, Arial, Helvetica;">
											 Terimakasih telah mendaftar ke acara Hemat Energi Bagimu Negeri bersama LG di Car Free day.
										 </p>

										 <p style="margin-bottom:20px;font-family: Open Sans, sans-serif, Arial, Helvetica;">
											 Tunjukkan email ini untuk penbambilan hadiah di acara Car Free Day tanggal 20 November 2016. Sampai Jumpa!
										 </p>

									 </td>
								 </tr>
							 </table>
						 </td>
					 </tr>
					 <tr>
						 <td align="right" valign="bottom">
							 <img src="http://berbagi-energi.com/image/footer-email.jpg">
						 </td>
					 </tr>
				 </table>
		 </html>';

		return $template;
	}


	function send_addmember($dataArray = null){
		$results['msg'] = '';
		$results['status'] = '';
		$template=$this->template_email();
		$template = str_replace('!#NAME', $dataArray['nama'], $template);
		$template = str_replace('!#KODE_UNIK', $dataArray['kode_unik'], $template);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($ch, CURLOPT_USERPWD, 'api:key-031f6c645c2c27d331e152ba8a959e28');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v3/mybmw.co.id/messages');
		curl_setopt($ch, CURLOPT_POSTFIELDS, array(
			'from' => 'LG-G5<admin@LG-G5.co.id>',
			//'to' => 'fauzi.rahman@kana.co.id',
			'to' => $dataArray['email'],
			'subject' => "Play With GFriend5",
			'html' => $template,
			'o:campaign' => 'fkdf5'
		));
		$result = curl_exec($ch);
		$info = curl_getinfo($ch);
		$res = json_decode($result, TRUE);
		//$res['email'] = $dataArray['email'];
		if ($info['http_code'] != '200') {
			$results['msg'] = $res['message'];
			$results['status'] = '0';
		}
		else {
			$results['msg'] = $res['message'];
			$results['status'] = '1';
		}
		curl_close($ch);
		//echo $result;

		return $results;
	}
}
