<!DOCTYPE html>
<html>
<head>
    <title>Low Quantity Alert</title>
</head>
<body>
    <h1>Low Quantity Alert</h1>
    <p>The following item has a low quantity:</p>
    <p>Item Name: {{ $item->name }}</p>
    <p>Item price: {{ $item->price }}</p>
    <p>Quantity: {{ $item->pivot->quantity }}</p>
    <p>Please take action to replenish the inventory.</p>
</body>
</html>
