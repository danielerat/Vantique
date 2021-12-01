<?php

require_once('../../../private/initialize.php');
include(SHARED_PATH . '/staff_header.php');
?>
<style>
#invoice {
    padding: 10px;
}

.invoice {
    position: relative;
    background-color: #FFF;
    min-height: 680px;
    padding: 10px
}

.invoice header {
    padding: 10px 0;
    margin-bottom: 20px;
    border-bottom: 1px solid #3989c6
}

.invoice .company-details {
    text-align: right
}

.invoice .company-details .name {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .contacts {
    margin-bottom: 20px
}

.invoice .invoice-to {
    text-align: left
}

.invoice .invoice-to .to {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .invoice-details {
    text-align: right
}

.invoice .invoice-details .invoice-id {
    margin-top: 0;
    color: #3989c6
}

.invoice main {
    padding-bottom: 10px
}

.invoice main .thanks {
    margin-top: -100px;
    font-size: 2em;
    margin-bottom: 50px
}

.invoice main .notices {
    padding-left: 6px;
    border-left: 6px solid #3989c6
}

.invoice main .notices .notice {
    font-size: .5em
}

.invoice table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 20px
}

.invoice table td,
.invoice table th {
    padding: 15px;
    background: #eee;
    border-bottom: 1px solid #fff
}

.invoice table th {
    white-space: nowrap;
    font-weight: 400;
    font-size: 16px
}

.invoice table td h3 {
    margin: 0;
    font-weight: 400;
    color: #3989c6;
    font-size: 1.2em
}

.invoice table .qty,
.invoice table .total,
.invoice table .unit {
    text-align: right;
    font-size: 1em
}

.invoice table .no {
    color: #fff;
    font-size: 1.6em;
    background: #3989c6
}

.invoice table .unit {
    background: #ddd
}

.invoice table .total {
    background: #3989c6;
    color: #fff
}

.invoice table tbody tr:last-child td {
    border: none
}

.invoice table tfoot td {
    background: 0 0;
    border-bottom: none;
    white-space: nowrap;
    text-align: right;
    padding: 10px 20px;
    font-size: 1.2em;
    border-top: 1px solid #aaa
}

.invoice table tfoot tr:first-child td {
    border-top: none
}

.invoice table tfoot tr:last-child td {
    color: #3989c6;
    font-size: 1.4em;
    border-top: 1px solid #3989c6
}

.invoice table tfoot tr td:first-child {
    border: none
}

.invoice footer {
    width: 100%;
    text-align: center;
    color: #777;
    border-top: 1px solid #aaa;
    padding: 8px 0
}

@media print {
    .invoice {
        font-size: 11px !important;
        overflow: hidden !important
    }

    .invoice footer {
        position: absolute;
        bottom: 10px;
        page-break-after: always
    }

    .invoice>div:last-child {
        page-break-before: always
    }
}
</style>

<?php
$id = $_GET['id'] ?? null;
if ($id == null || empty($id)) {
    header('Location: index.php');
}

$order = UserOrder::find_by_order_id($id);
if (empty($order)) {
    header('Location: index.php');
}
$user = User::find_by_username($order->username);
?>
<div id="invoice">

    <div class="toolbar hidden-print">
        <div class="text-right">
            <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
            <button class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>
        </div>
        <hr>
    </div>
    <div class="invoice overflow-auto">
        <div style="min-width: 600px">
            <header>
                <div class="row">
                    <div class="col ">
                        <a target="_blank" href="https://lobianijs.com">
                            <img src="../img/logo/logo2.png" class='w-25' data-holder-rendered="true" />
                        </a>
                    </div>
                    <div class="col company-details">
                        <h2 class="name">
                            <a target="_blank" href="www.vantique.com">
                                Vantique
                            </a>
                        </h2>
                        <div>Kigali/Kiyovu ,Kn 23 ST, </div>
                        <div>+250783305114</div>
                        <div>vantique@vantique.com</div>
                    </div>
                </div>
            </header>
            <main>
                <div class="row contacts">
                    <div class="col invoice-to">
                        <div class="text-gray-light">INVOICE TO:</div>

                        <h2 class="to"><?php echo $user->first_name . " " . $user->last_name; ?></h2>
                        <div class="address">796 Silver Harbour, TX 79273, US</div>
                        <div class="email"><a href="mailto:<?php echo $user->email; ?>"><?php echo $user->email; ?>
                            </a>
                        </div>
                    </div>
                    <div class="col invoice-details">
                        <h3 class="invoice-id"><?php echo $order->orderId; ?></h3>
                        <div class="date">Due Date: <?php echo $order->addedOn; ?></div>
                    </div>
                </div>
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-left">DESCRIPTION</th>
                            <th class="text-right">PRICE</th>
                            <th class="text-right">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Find ALl products in the order Item table 
                        $items = OrderItem::find_all_item($order->orderId);
                        $total = (float) 0;
                        $counter = 0;
                        foreach ($items as $item) {
                            $counter++;
                            $p = Product::find_by_id($item->productId);

                            $subTotal = $p->productPrice * $item->quantity;
                            $total += $subTotal;
                        ?>
                        <tr>
                            <td class="no"><?php echo $counter;
                                                ?></td>
                            <td class="text-left">
                                <h3>
                                    <a target="_blank" href="view.php?id=<?php echo h($p->id); ?>" target="_blank">
                                        <?php echo ellipse_of($p->productName, 150); ?>
                                    </a>
                                </h3>


                            </td>
                            <td class="unit">
                                <?php echo number_format($p->productPrice, 2) . "<br> X " . $item->quantity; ?>
                            </td>
                            <td class="total"><?php echo number_format($subTotal); ?></td>
                        </tr>
                        <?php } ?>

                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">SUBTOTAL</td>
                            <td><?php echo number_format($total); ?></td>
                        </tr>
                        <tr>
                            <td colspan="2">shipping</td>
                            <td>Frw <?php
                                    if ($order->deliveryMethod == 0) {
                                        echo 0.00;
                                    } else if ($order->deliveryMethod == 1) {
                                        echo 2000.00;
                                        $total += 2000;
                                    } else if ($order->deliveryMethod == 2) {
                                        echo 1500, 00;
                                        $total += 1500;
                                    } else if ($order->deliveryMethod == 3) {
                                        echo 800;
                                        $total += 800;
                                    } else {
                                        echo 500;
                                        $total += 500;
                                    }

                                    ?></td>
                        </tr>
                        <tr>
                            <td colspan="2">GRAND TOTAL</td>
                            <td><?php echo "Frw " . number_format($total, 2); ?></td>
                        </tr>
                    </tfoot>
                </table>
                <div class="thanks">Thank you!</div>
                <div class="notices">
                    <div>NOTICE:</div>
                    <div class="notice">If you need Anything changed on your order or address,feel free to reach
                        us...
                    </div>
                </div>
            </main>
            <footer>
                Invoice was created on a computer and is valid without the signature and seal.
            </footer>
        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>
    </div>
</div>


<?php

include(SHARED_PATH . '/staff_footer.php');
?>
<script>
$('#printInvoice').click(function() {
    Popup($('.invoice')[0].outerHTML);

    function Popup(data) {
        window.print();
        return true;
    }
});
</script>