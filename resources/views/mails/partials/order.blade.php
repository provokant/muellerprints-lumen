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
        <div><strong>Preis: {{ $product->total }}</strong></div>

        <hr/>
      @endforeach
    </td>
  </tr>
  <tr><td colspan="2"><br></td></tr>
  <tr>
    <td valign="top">Versandkosten:</td>
    <td valign="top">{{ $order['shippingCost'] }}</td>
  </tr>
  <tr>
    <td valign="top">19% MwSt.:</td>
    <td valign="top">{{ number_format((int)$order['sum'] * 0.19, 2, ',', '.') }} €</td>
  </tr>
  <tr>
    <td valign="top"><strong>Gesamtbetrag:</strong> </td>
    <td valign="top">
      <strong>{{ number_format($order['sum'], 2, ',', '.') }} €</strong>
      inkl. MwSt.
    </td>
  </tr>
</table>

<p>Lieferung erfolgt nach vollständiger Bezahlung der Rechnung.</p>