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
				<table width="680" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
					<tbody>
					<!-- Spacing -->
					<tr>
						<td width="100%" height="50"></td>
					</tr>
					<!-- Spacing -->
					<tr>
						<td align="right" valign="middle" style="font-family: Helvetica, arial, sans-serif; font-size: 10px;color: #999999" st-content="preheader">
							{{ $date }}
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
				<table width="680" bgcolor="#f41202" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth" hlitebg="edit" shadow="edit">
					<tbody>
					<tr>
						<td>
							<!-- logo -->
							<table width="280" cellpadding="0" cellspacing="0" border="0" align="left" class="devicewidth">
								<tbody>
								<tr>
									<td valign="middle" width="270" style="padding: 10px 0 10px 20px;" class="logo">
										<div  color="#fff" style="font-family: Helvetica, arial, sans-serif; font-size: 10px; color: #fff; font-weight: bold;">
											muellerprints.
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
									<td width="270" valign="middle" style="font-family: Helvetica, Arial, sans-serif;font-size: 14px; color: #ffffff; line-height: 24px; padding: 10px 0;" align="right" class="menu" st-content="menu">
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

<div class="block" bgcolor="#f6f4f5" >
<table width="680" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth" hlitebg="edit" shadow="edit" style="font-family: Helvetica, Arial, sans-serif;font-size: 14px; line-height: 18px;">
	<tbody>
	<tr>
		<td bgcolor="#fff" style="padding: 20px 0;">

@section('content')
  <p><strong>Vielen Dank für Ihre Anfrage auf muellerprints.de!</strong></p>
  <p></p>
	Zusammenfassung Ihrer Anfrage vom <strong>{{ $date }}</strong>:
	<table width="100%" cellpadding="0" cellspacing="0" border="0" class="devicewidth" hlitebg="edit" shadow="edit" style="font-family: Helvetica, Arial, sans-serif; font-size: 14px; line-height: 18px; padding: 20px 0;">
		<tr>
			<td width="30%">Name: </td>
			<td width="70%">{{ $inquiry['name'] }}</td>
		</tr>
		<tr>
			<td>Telefonnummer: </td>
			<td>{{ $inquiry['phone'] }}</td>
		</tr>
		<tr>
			<td>E-Mail-Adresse: </td>
			<td>{{ $inquiry['mail'] }}</td>
		</tr>
		<tr>
			<td>Stichwort: </td>
			<td>{{ $inquiry['title'] }}</td>
		</tr>
		<tr>
			<td>Produkt: </td>
			<td>{{ $inquiry['product'] }}</td>
		</tr>
		<tr>
			<td>Format: </td>
			<td>{{ $inquiry['format'] }}</td>
		</tr>
		<tr>
			<td>Seitenanzahl: </td>
			<td>{{ $inquiry['pages'] }}</td>
		</tr>
		<tr>
			<td>Ausrichtung: </td>
			<td>{{ $inquiry['orientation'] }}</td>
		</tr>
		<tr>
			<td>Druck: </td>
			<td>{{ $inquiry['printing'] }}</td>
		</tr>
		<tr>
			<td>Farbe: </td>
			<td>{{ $inquiry['colors'] }}</td>
		</tr>
		<tr>
			<td>Papier & Gewicht: </td>
			<td>{{ $inquiry['material'] }}</td>
		</tr>
		<tr>
			<td>Auflage: </td>
			<td>{{ $inquiry['edition'] }}</td>
		</tr>
		<tr>
			<td>Objektbeschreibung: </td>
			<td>{{ $inquiry['description'] }}</td>
		</tr>
	</table>
@show

			</td>
		</tr>
		</tbody>
	</table>
</div>

<div class="block">
	<!-- Start of preheader -->
	<table width="100%" bgcolor="#f6f4f5" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="postfooter">
		<tbody>
		<tr>
			<td width="100%">
				<table width="680" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
					<tbody>
					<!-- Spacing -->
					<tr>
						<td width="50%" height="20" style="font-family: Helvetica, arial, sans-serif; font-size: 10px;color: #999999; padding: 10px 0">
						muellerprints.<br>
						Rotenbergstr. 39<br>
						70190 Stuttgart
						</td>
						<td width="50%" height="20"  style="font-family: Helvetica, arial, sans-serif; font-size: 10px;color: #999999; padding: 10px 0">
						Inhaber: Max Müller<br>
						t + 49 (0)711 / 262 49 64<br>
						f + 49 (0)711 / 262 48 60
						</td>
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

</body>
</html>