<html xmlns="http://www.w3.org/1999/xhtml"><head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title></title>
</head>
<body>

@include('mails.partials.header', array('date' => $date))

<div class="block" bgcolor="#f6f4f5" >
<table width="580" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth" hlitebg="edit" shadow="edit" style="font-family: Helvetica, Arial, sans-serif;font-size: 14px; line-height: 18px;">
	<tbody>
	<tr>
		<td bgcolor="#fff" style="padding: 20px 0;">

			@section('content')
				<p>
					Soeben wurde eine neue Bestellung auf notizbücher-shop.com aufgegeben:
				</p>

				<p>
					<strong>Rechnungsnummer: R-{{ $order['order_number'] }}</strong>
				</p>
				
				@include('mails.partials.order', array('order' => $order))

			@show

		</td>
	</tr>
	</tbody>
	</table>
</div>

@include('mails.partials.footer')

</body>
</html>
