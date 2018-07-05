<html xmlns="http://www.w3.org/1999/xhtml"><head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title></title>
</head>
<body>

@include('mails.partials.header', array('date' => $date))

<div class="block" bgcolor="#f6f4f5" >
<table width="680" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth" hlitebg="edit" shadow="edit" style="font-family: Helvetica, Arial, sans-serif;font-size: 14px; line-height: 18px;">
	<tbody>
	<tr>
		<td bgcolor="#fff" style="padding: 20px 0;">

			@section('content')
				<p>Herzlichen Dank für Ihre Bestellung!</p>
				<p>
					<strong>Bestellnummer: {{ $order['order_number'] }}</strong>
				</p>
				<p>
					<strong>Rechnungsnummer: R-{{ $order['order_number'] }}</strong>
				</p>
				
				@include('mails.partials.order', array('order' => $order))

				@if($order['payment'] == 'Vorkasse')
					<p style="padding: 10px; background: #ddd">
						Bank: <strong>Stuttgarter Volksbank eG</strong><br>
						Empfänger: <strong>Max Müller</strong><br>
						IBAN: <strong>DE73 6009 0100 0525 0360 08</strong><br>
						BIC: <strong>VOBADESS</strong><br>
						Verwendungszweck: <strong>{{ $order['order_number'] }}</strong><br>
						<br>
						<strong>Bitte überweisen Sie den Gesamtbetrag in Höhe von {{ number_format($order['sum'], 2, ',', '.') }} € auf obenstehendes Konto.</strong>
					<p>
				@endif
			@show

		</td>
	</tr>
	</tbody>
	</table>
</div>

@include('mails.partials.footer')

</body>
</html>
