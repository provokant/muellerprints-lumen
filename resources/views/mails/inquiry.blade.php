<html xmlns="http://www.w3.org/1999/xhtml"><head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title></title>
</head>
<body>

<div class="block">
	<!-- Start of preheader -->
	<table width="100%" bgcolor="#f6f4f5" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="preheader">
		<tbody>
		<tr>
			<td width="100%">
				<table width="580" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
					<tbody>
					<!-- Spacing -->
					<tr>
						<td width="100%" height="50"></td>
					</tr>
					<!-- Spacing -->
					<tr>
						<td align="right" valign="middle" style="font-family: Helvetica, arial, sans-serif; font-size: 10px;color: #999999" st-content="preheader">

						</td>
					</tr>
					<!-- Spacing -->
					<tr>
						<td width="100%" height="5"></td>
					</tr>
					<!-- Spacing -->
					</tbody>
				</table>
			</td>
		</tr>
		</tbody>
	</table>
	<!-- End of preheader -->
</div>
<div class="block">
	<!-- start of header -->
	<table width="100%" bgcolor="#f6f4f5" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="header">
		<tbody>
		<tr>
			<td>
				<table width="580" bgcolor="#004cad" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth" hlitebg="edit" shadow="edit">
					<tbody>
					<tr>
						<td>
							<!-- logo -->
							<table width="280" cellpadding="0" cellspacing="0" border="0" align="left" class="devicewidth">
								<tbody>
								<tr>
									<td valign="middle" width="270" style="padding: 10px 0 10px 20px;" class="logo">
										<div class="imgpop">
											<a href="#"><img src="" alt="logo" border="0" style="display:block; border:none; outline:none; text-decoration:none;" st-image="edit" class="logo"></a>
										</div>
									</td>
								</tr>
								</tbody>
							</table>
							<!-- End of logo -->
							<!-- menu -->
							<table width="280" cellpadding="0" cellspacing="0" border="0" align="right" class="devicewidth">
								<tbody>
								<tr>
									<td width="270" valign="middle" style="font-family: Helvetica, Arial, sans-serif;font-size: 14px; color: #ffffff;line-height: 24px; padding: 10px 0;" align="right" class="menu" st-content="menu">
									</td>
									<td width="20"></td>
								</tr>
								</tbody>
							</table>
							<!-- End of Menu -->
						</td>
					</tr>
					</tbody>
				</table>
			</td>
		</tr>
		</tbody>
	</table>
	<!-- end of header -->
</div>

@section('content')
	Es wurde eine Anfrage von muellerpints.de am <strong>{{ $date }}</strong> verschickt:
	<table>
		<tr>
			<td>Name</td>
			<td>{{ $inquiry['name'] }}</td>
		</tr>
		<tr>
			<td>Telefonnummer</td>
			<td>{{ $inquiry['phone'] }}</td>
		</tr>
		<tr>
			<td>E-Mail-Adresse</td>
			<td>{{ $inquiry['mail'] }}</td>
		</tr>
		<tr>
			<td>Format</td>
			<td>{{ $inquiry['format'] }}</td>
		</tr>
		<tr>
			<td>Ausrichtung</td>
			<td>{{ $inquiry['orientation'] }}</td>
		</tr>
		<tr>
			<td>Papier</td>
			<td>{{ $inquiry['material'] }}</td>
		</tr>
		<tr>
			<td>Seiten</td>
			<td>{{ $inquiry['pages'] }}</td>
		</tr>
		<tr>
			<td>Ausdruck</td>
			<td>{{ $inquiry['printing'] }}</td>
		</tr>
		<tr>
			<td>Farben</td>
			<td>{{ $inquiry['colors'] }}</td>
		</tr>
		<tr>
			<td>Auflage</td>
			<td>{{ $inquiry['edition'] }}</td>
		</tr>
	</table>
@show

<div class="block">
	<!-- Start of preheader -->
	<table width="100%" bgcolor="#f6f4f5" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="postfooter">
		<tbody>
		<tr>
			<td width="100%">
				<table width="580" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
					<tbody>
					<!-- Spacing -->
					<tr>
						<td width="100%" height="5"></td>
					</tr>
					<tr>
						<td width="100%" height="5"></td>
					</tr>
					<!-- Spacing -->
					</tbody>
				</table>
			</td>
		</tr>
		</tbody>
	</table>
	<!-- End of preheader -->
</div>

</body></html>