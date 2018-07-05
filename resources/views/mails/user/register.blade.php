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
				<table width="680" bgcolor="#3c6c9e" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth" hlitebg="edit" shadow="edit">
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
        <p>
          Vielen Dank für Ihre Anmeldung auf <a href="https://www.notizbücher-shop.com"></a>www.notizbücher-shop.com</a>.
        </p>
        
        <p>Bitte bestätigen Sie Ihre Registrierung mit folgendem Link:</p>

        <p>
          <a href="{{ $app_url }}{{ $endpoint }}{{ $activation }}">Konto aktivieren</a>
        </p>

				<p>Oder öffnen Sie folgenden Link manuell in Ihrem gewünschten Browser:</p>

				<p>
					{{ $app_url }}{{ $endpoint }}{{ $activation }}
				</p>

				<p>
					<i>Der Link ist nur für 24 Stunden aktiv und das angelegte Konto wird gelöscht. Danach ist Ihre angegebene E-Mail-Adresse wieder verfügbar für eine Erneute Registrierung.</i>
				</p>
				
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
