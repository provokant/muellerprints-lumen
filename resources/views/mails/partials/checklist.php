<table width="100%" cellpadding="0" cellspacing="0" border="0" class="devicewidth" hlitebg="edit" shadow="edit" style="font-family: Helvetica, Arial, sans-serif; font-size: 14px; line-height: 18px; padding: 20px 0;">
		<tr>
			<td width="30%">Name: </td>
			<td width="70%">{{ $checklist['name'] }}</td>
		</tr>
		<tr>
			<td>Straße: </td>
			<td>{{ $checklist['street'] }}</td>
		</tr>
		<tr>
			<td>PLZ / Stadt: </td>
			<td>{{ $checklist['zip'] }} {{ $checklist['town'] }}</td>
		</tr>
		<tr>
			<td>Telefonnummer: </td>
			<td>{{ $checklist['phone'] }}</td>
		</tr>
		<tr>
			<td>E-Mail-Adresse: </td>
			<td>{{ $checklist['mail'] }}</td>
		</tr>
		<tr>
			<td>Stichwort: </td>
			<td>{{ $checklist['title'] }}</td>
		</tr>
		<tr>
			<td>Produkt: </td>
			<td>{{ $checklist['product'] }}</td>
		</tr>
		<tr>
			<td>Beschnittenes Endformat: </td>
			<td>{{ $checklist['format'] }}</td>
		</tr>
		<tr>
			<td>Seitenanzahl: </td>
			<td>{{ $checklist['pages'] }}</td>
		</tr>
		<tr>
			<td>Ausrichtung: </td>
			<td>{{ $checklist['orientation'] }}</td>
		</tr>
		<tr>
			<td>Druck: </td>
			<td>{{ $checklist['printing'] }}</td>
		</tr>
		<tr>
			<td>Farbe: </td>
			<td>{{ $checklist['colors'] }}</td>
		</tr>
		<tr>
			<td>Inhalt-Papier: </td>
			<td>{{ $checklist['material'] }}</td>
		</tr>
		<tr>
			<td>Umschlag: </td>
			<td>{{ $checklist['cover-material'] }}</td>
		</tr>
		<tr>
			<td>Auflage: </td>
			<td>{{ $checklist['edition'] }}</td>
		</tr>
		<tr>
			<td>Verarbeitung: </td>
			<td>{{ $checklist['description'] }}</td>
		</tr>
		<tr>
			<td>Wunschtermin: </td>
			<td>{{ $checklist['date'] }}</td>
		</tr>
	</table>