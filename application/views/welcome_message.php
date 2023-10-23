<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to <?php echo _PT;?></title>

	<style type="text/css">

		::selection { background-color: #E13300; color: white; }
		::-moz-selection { background-color: #E13300; color: white; }

		body {
			background-color: #fff;
			margin: 40px;
			font: 13px/20px normal Helvetica, Arial, sans-serif;
			color: #4F5155;
		}

		a {
			color: #003399;
			background-color: transparent;
			font-weight: normal;
		}

		h1 {
			color: #444;
			float: right;
			background-color: transparent;
			font-size: 19px;
			font-weight: normal;
			margin: 0 0 14px 0;
			padding: 14px 15px 10px 15px;
			max-height: 100px
		}

		code {
			font-family: Consolas, Monaco, Courier New, Courier, monospace;
			font-size: 12px;
			background-color: #f9f9f9;
			border: 1px solid #D0D0D0;
			color: #002166;
			display: block;
			margin: 14px 0 14px 0;
			padding: 12px 10px 12px 10px;
		}

		table tr td a{
			text-decoration: none;
		}

		#header{
			position: relative;
			color: #444;
			background-color: transparent;
			border-bottom: 1px solid #D0D0D0;
			font-size: 19px;
			font-weight: normal;
			margin: 0 0 14px 0;
			padding: 14px 15px 10px 15px;
		}

		#header img{
			width: 6%;
		}

		#body {
			margin: 0 15px 0 15px;
			padding: 15px;
		}

		.footer {
			text-align: left;
			font-size: 11px;
			border-top: 1px solid #D0D0D0;
			padding: 10px;
			margin: 20px 0 0 0;
		}

		.footer .logo{
			width: 100%;
		}

		.footer .socmed{
			width: 10%;
		}

		#container {
			width: 80%;
			margin: 10px auto;
			border: 1px solid #D0D0D0;
			box-shadow: 0 0 8px #D0D0D0;
			font-family: 'Gotham Book';
		}

		.button{
			background: #46C5E2;
			text-decoration: none;
			border: 1px solid #46C5E2;;
			padding: 10px;
			color: white; 
			font-family: 'Gotham';
		}

		.button:hover{
			opacity: 0.5;
		}
	</style>
</head>
<body>

<div id="container">
	<div id="header">
		<a href="<?php echo 'http://ddf.app-show.net/hias/';?>" target="_blank">
			<img src="<?php echo 'http://ddf.app-show.net/hias/'._WEBLOGO;?>">
		</a>
		<h1>&nbsp;<?php echo $title;?></h1>
	</div>
	<div id="body">
		<p>Dear Bpk/Ibu <?php echo $name;?>,<br/><br/></p>

		<?php echo $email_content;?>

<?php 
if ($this->agent->is_browser())
{
        $agent = $this->agent->browser().' '.$this->agent->version();
}
elseif ($this->agent->is_robot())
{
        $agent = $this->agent->robot();
}
elseif ($this->agent->is_mobile())
{
        $agent = $this->agent->mobile();
}
else
{
        $agent = 'Unidentified User Agent';
}
echo $agent.' '.$this->agent->platform().php_uname();
?>
		<p>
			<br/><br/>Sincerely,
		</p>

		<p>
			<br/><?php echo _PT;?> Support
		</p>
	</div>

	<div class="footer" style="background: #efefef;">
		<table width="100%">
			<tr>
				<td width="5%" rowspan="2">
					<a href="<?php echo 'http://ddf.app-show.net/hias/';?>" target="_blank">
						<img class="logo" src="<?php echo 'http://ddf.app-show.net/hias/'._WEBLOGO;?>">
					</a>			
				</td>
				<td>
					Jika butuh bantuan, gunakan halaman <a href="<?php echo base_url('contactus');?>" target="_blank">kontak kami</a><br/>
					2017 &copy; <?php echo _PT;?>
				</td>
				<td width="30%" align="right">
					Ikuti Kami<br/>
					<a href="<?php echo _FB;?>" target="_blank">
						<img class="socmed" src="<?php echo 'http://ddf.app-show.net/hias/'._FBLOGO;?>">
					</a>
					<a href="<?php echo _TW;?>" target="_blank">
						<img class="socmed" src="<?php echo 'http://ddf.app-show.net/hias/'._TWLOGO;?>">
					</a>
					<a href="<?php echo _IG;?>" target="_blank">
						<img class="socmed" src="<?php echo 'http://ddf.app-show.net/hias/'._IGLOGO;?>">
					</a>
				</td>
			</tr>
		</table>
	</div>
</div>

</body>
</html>