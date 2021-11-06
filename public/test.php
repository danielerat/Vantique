<?php
require_once("../private/initialize.php");
// require_once(PRIVATE_PATH . "/shared/public_header.php");
echo "<pre>";



// $item = ['user' => $_COOKIE["PHPSESSID"], 'productId' => 1, 'quantity' => 2];
// $cart->setCart(['item' => $item]);
// $cart->clearCart();

// $item = ['user' => $_COOKIE["PHPSESSID"], 'productId' => 9, 'quantity' => 2];
// $cart->setCart(['item' => $item]);
// $item = ['user' => $_COOKIE["PHPSESSID"], 'productId' => 2, 'quantity' => 1];
// $cart->setCart(['item' => $item]);

// $item = ['user' => $_COOKIE["PHPSESSID"], 'productId' => 5, 'quantity' => 2];
// $cart->setCart(['item' => $item]);

// $cart->getCart();
// $cart->clearCart();

// echo " Cart Items:<br>";
// print_r($cart->cart_items);

// echo Cart::$cart_items[0][0][0]['user'];


// $cart->deleteItem(4);

// $cart->clearCart();


print_r($cart->cartCount());
print_r($cart->cart_items);

echo "<br>Total Products:" . $cart->cartCount();
echo "<hr>";
print_r($_COOKIE);
$e = 35;
while ($e <= 48) {
    echo $e . "<br>";
    $e++;
}
// require_once(PRIVATE_PATH . "/shared/public_header.php");
?>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".sizingReference">Small modal</button>

<div class="modal fade sizingReference" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

        </div>
    </div>
</div>


<div class="table-wrapper u-s-m-b-60">
    <table>
        <thead>
            <tr>
                <th>Chinese</th>
                <th>Us Sizing</th>
            </tr>
        </thead>
        <tbody>

            Show Sizing Reference
            <tr>
                <td>35</td>
                <td> 5</td>
            </tr>
            <tr>
                <td>36</td>
                <td>5.5</td>
            </tr>
            <tr>
                <td>37</td>
                <td> 6</td>
            </tr>
            <tr>
                <td>38</td>
                <td>6.5</td>
            </tr>
            <tr>
                <td>39</td>
                <td> 7</td>
            </tr>
            <tr>
                <td>40</td>
                <td>7.5</td>
            </tr>
            <tr>
                <td>41</td>
                <td> 8</td>
            </tr>
            <tr>
                <td>42</td>
                <td>8.5</td>
            </tr>
            <tr>
                <td>43</td>
                <td>9.5</td>
            </tr>
            <tr>
                <td>44</td>
                <td> 10</td>
            </tr>
            <tr>
                <td>45</td>
                <td> 11</td>
            </tr>
            <tr>
                <td>46</td>
                <td> 12</td>
            </tr>
            <tr>
                <td>47</td>
                <td> 13</td>
            </tr>
            <tr>
                <td>48</td>
                <td> 14</td>
            </tr>
        </tbody>
    </table>
</div>
<div class="table-wrapper u-s-m-b-60">
    <table>
        <thead>
            <tr>
                <th>Chinese</th>
                <th>Us Sizing</th>
            </tr>
        </thead>
        <tbody>

            Show Sizing Reference
            <tr>
                <td>35</td>
                <td> 5</td>
            </tr>
            <tr>
                <td>36</td>
                <td>5.5</td>
            </tr>
            <tr>
                <td>37</td>
                <td> 6</td>
            </tr>
            <tr>
                <td>38</td>
                <td>6.5</td>
            </tr>
            <tr>
                <td>39</td>
                <td> 7</td>
            </tr>
            <tr>
                <td>40</td>
                <td>7.5</td>
            </tr>
            <tr>
                <td>41</td>
                <td> 8</td>
            </tr>
            <tr>
                <td>42</td>
                <td>8.5</td>
            </tr>
            <tr>
                <td>43</td>
                <td>9.5</td>
            </tr>
            <tr>
                <td>44</td>
                <td> 10</td>
            </tr>
            <tr>
                <td>45</td>
                <td> 11</td>
            </tr>
            <tr>
                <td>46</td>
                <td> 12</td>
            </tr>
            <tr>
                <td>47</td>
                <td> 13</td>
            </tr>
            <tr>
                <td>48</td>
                <td> 14</td>
            </tr>
        </tbody>
    </table>
</div>
<div class="table-wrapper u-s-m-b-60">
    <table>
        <thead>
            <tr>
                <td>Size</td>
                <td>Shoulder</td>
                <td>Chest Width</td>
                <td>Length</td>
                <td>Sleeve LengthSize</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>M</td>
                <td> 43</td>
                <td>98</td>
                <td>62</td>
                <td> 61</td>
            <tr>
                <td>L</td>
                <td> 44</td>
                <td>102</td>
                <td>64</td>
                <td> 62</td>
            <tr>
                <td>XL</td>
                <td> 45</td>
                <td>106</td>
                <td>66</td>
                <td> 63</td>
            <tr>
                <td>XXL</td>
                <td> 46</td>
                <td>110</td>
                <td>68</td>
                <td> 64</td>
            <tr>
                <td>XXXL</td>
                <td> 47</td>
                <td>114</td>
                <td>70</td>
                <td> 65</td>
            <tr>
                <td>4XL</td>
                <td> 48</td>
                <td>118</td>
                <td>72</td>
                <td> 66</td>



        </tbody>
    </table>
</div>