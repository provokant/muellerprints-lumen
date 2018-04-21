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
				<table width="580" bgcolor="#f00" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth" hlitebg="edit" shadow="edit">
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
<table width="580" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth" hlitebg="edit" shadow="edit" style="font-family: Helvetica, Arial, sans-serif;font-size: 14px; line-height: 18px;">
	<tbody>
	<tr>
		<td bgcolor="#fff" style="padding: 20px 0;">

			@section('content')
				<p>Herzlichen Dank für Ihre Bestellung!</p>

				<p>Soeben ist Ihre Bestellung eingegangen und wird umgehend bearbeitet. Ihre Bestellnummer lautet:</p>

				<p>
					<strong>Bestellnummer: {{ $order['order_number'] }}</strong>
				</p>
				
				<table width="100%" cellpadding="0" cellspacing="0" border="0" class="devicewidth" hlitebg="edit" shadow="edit" style="font-family: Helvetica, Arial, sans-serif; font-size: 14px; line-height: 18px; padding: 20px 0;">
					<tr>
						<td width="30%" valign="top">Rechnungsadresse: </td>
						<td width="70%" valign="top">
							<div>{{ $order['company'] }}</div>
							<div>{{ $order['name'] }}</div>
							<div>{{ $order['street'] }}</pbr>
							<div>{{ $order['zip'] }} {{ $order['town'] }}</div>
							<div>{{ $order['country'] }}</div>
						</td>
					</tr>
					<tr><td colspan="2"><br></td></tr>
					@if($order['delivery'])
						<tr>
							<td width="30%" valign="top">Lieferadresse: </td>
							<td width="70%" valign="top">
								<?php $delivery = json_decode($order['delivery']); ?>
								<div>{{ $delivery->name }}</div>
								<div>{{ $delivery->street }}</div>
								<div>{{ $delivery->zip }} {{ $delivery->town }}</div>
								<div>{{ $delivery->country }}</div>
							</td>
						</tr>
						<tr><td colspan="2"><br></td></tr>
					@endif
					<tr>
						<td width="30%" valign="top">Kontaktdaten:</td>
						<td width="70%" valign="top">
							<div>{{ $order['phone'] }}</div>
							<div>{{ $order['email'] }}</div>
						</td>
					</tr>
					<tr><td colspan="2"><br></td></tr>
					<tr>
						<td valign="top">Zahlungsart: </td>
						<td valign="top">{{ $order['payment'] }}</td>
					</tr>
					<tr><td colspan="2"><br></td></tr>
					<tr>
						<td valign="top">Produkte: </td>
						<td valign="top">
							@foreach(json_decode($order['products']) as $product)
								<strong>
									{{ $product->cover->name }} - {{ $product->cover->variety }}
								</strong>

								<ul style="padding: 0 0 0 16px; margin: 0;">
									@foreach($product->options as $option)
										<li>{{ $option->name }}</li>
									@endforeach

									<li>{{ $product->pattern->id }}</li>
								</ul>

								<div>Stückzahl: {{ $product->amount }}</div>
								<div>Preis: {{ $product->total }}</div>

								<hr/>
							@endforeach
						</td>
					</tr>
					<tr><td colspan="2"><br></td></tr>
					<tr>
						<td valign="top">Gesamtbetrag: </td>
						<td valign="top">
							{{ $order['sum'] }}
							@if($order['shippingCost'] != "0")
								zzgl. {{ $order['shippingCost'] }} Versandkosten
							@endif
						</td>
					</tr>
				</table>

				@if($order['payment'] == 'Vorkasse')
					<p style="padding: 10px; background: #ddd">
						<strong>COMMERZBANK</strong><br>
						<strong>Max Müller</strong><br>
						IBAN: <strong>DE1234123412341234</strong><br>
						BIC: <strong>23456789</strong><br>
						Verwendungszweck: <strong>{{ $order['order_number'] }}</strong><br>
						<br>
						<strong>Bitte überweisen Sie den obenstehenden Betrag in den kommenden 5 Werktagen.</strong>
					<p>
				@endif
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
				<table width="580" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
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
