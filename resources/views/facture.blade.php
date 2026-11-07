<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
body{font-family: DejaVu Sans, sans-serif; color:#000; padding:30px}
.header{border-bottom:3px solid #000; padding-bottom:15px; display:flex; justify-content:space-between}
h1{font-size:28px; margin:0}
.badge{background:#000; color:#fff; padding:5px 12px; border-radius:20px; font-size:11px}
table{width:100%; border-collapse:collapse; margin-top:25px}
th{background:#000; color:#fff; padding:10px; text-align:left; font-size:12px}
td{padding:10px; border-bottom:1px solid #ddd; font-size:13px}
.total{margin-top:20px; text-align:right; font-size:18px; font-weight:bold}
.footer{margin-top:40px; text-align:center; font-size:11px; color:#777; border-top:1px solid #ddd; padding-top:15px}
</style>
</head>
<body>
<div class="header">
  <div>
    <h1>CHEZ Maman OLA</h1>
    <p style="font-size:12px; color:#555">Boutique de mèches - Calavi, Bénin<br>Tel: 01 45 20 19 08</p>
  </div>
  <div style="text-align:right">
    <span class="badge">FACTURE #{{ $order->id }}</span>
    <p style="font-size:12px">{{ $order->created_at->format('d/m/Y H:i') }}</p>
  </div>
</div>

<p><b>Cliente :</b> {{ $order->user->name ?? 'Cliente' }}<br>
<b>Téléphone MoMo :</b> {{ $order->phone_momo }}<br>
<b>Livraison :</b> {{ $order->delivery_address }}<br>
<b>Paiement :</b> {{ strtoupper($order->payment_method) }} - {{ $order->payment_status }}</p>

<table>
<tr><th>Produit</th><th>Quantité</th><th>Prix unitaire</th><th>Sous-total</th></tr>
@foreach($order->produits as $p)
<tr>
  <td>{{ $p->nom }}</td>
  <td>{{ $p->pivot->quantite }}</td>
  <td>{{ number_format($p->pivot->prix_unitaire,0,' ',' ') }} FCFA</td>
  <td>{{ number_format($p->pivot->prix_unitaire * $p->pivot->quantite,0,' ',' ') }} FCFA</td>
</tr>
@endforeach
</table>

<div class="total">TOTAL : {{ number_format($order->total,0,' ',' ') }} FCFA</div>
<p style="font-size:12px; margin-top:10px">Statut : <b>{{ $order->statut }}</b></p>

<div class="footer">Merci pour votre achat chez CHEZ Maman OLA - Calavi<br>WhatsApp : 01 45 20 19 08 | Retours sous 24h si produit non ouvert</div>
</body>
</html>