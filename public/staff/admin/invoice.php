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
    font-size: 1.2em
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
<!------ Include the above in your HEAD tag ---------->

<!--Author      : @arboshiki-->
<section class="container">
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
                        <div class="col">
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
                            <h2 class="to">John Doe</h2>
                            <div class="address">796 Silver Harbour, TX 79273, US</div>
                            <div class="email"><a href="mailto:john@example.com">john@example.com</a></div>
                        </div>
                        <div class="col invoice-details">
                            <h1 class="invoice-id">INVOICE 3-2-1</h1>
                            <div class="date">Date of Invoice: 01/10/2018</div>
                            <div class="date">Due Date: 30/10/2018</div>
                        </div>
                    </div>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-left">DESCRIPTION</th>
                                <th class="text-right">HOUR PRICE</th>
                                <th class="text-right">HOURS</th>
                                <th class="text-right">TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="no">04</td>
                                <td class="text-left">
                                    <h3>
                                        <a target="_blank"
                                            href="https://www.youtube.com/channel/UC_UMEcP_kF0z4E6KbxCpV1w">
                                            Youtube channel
                                        </a>
                                    </h3>
                                    <a target="_blank" href="https://www.youtube.com/channel/UC_UMEcP_kF0z4E6KbxCpV1w">
                                        Useful videos
                                    </a>
                                    to improve your Javascript skills. Subscribe and stay tuned :)
                                </td>
                                <td class="unit">$0.00</td>
                                <td class="qty">100</td>
                                <td class="total">$0.00</td>
                            </tr>
                            <tr>
                                <td class="no">01</td>
                                <td class="text-left">
                                    <h3>Website Design</h3>Creating a recognizable design solution based on the
                                    company's
                                    existing visual identity
                                </td>
                                <td class="unit">$40.00</td>
                                <td class="qty">30</td>
                                <td class="total">$1,200.00</td>
                            </tr>
                            <tr>
                                <td class="no">02</td>
                                <td class="text-left">
                                    <h3>Website Development</h3>Developing a Content Management System-based Website
                                </td>
                                <td class="unit">$40.00</td>
                                <td class="qty">80</td>
                                <td class="total">$3,200.00</td>
                            </tr>
                            <tr>
                                <td class="no">03</td>
                                <td class="text-left">
                                    <h3>Search Engines Optimization</h3>Optimize the site for search engines (SEO)
                                </td>
                                <td class="unit">$40.00</td>
                                <td class="qty">20</td>
                                <td class="total">$800.00</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="2">SUBTOTAL</td>
                                <td>$5,200.00</td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="2">TAX 25%</td>
                                <td>$1,300.00</td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="2">GRAND TOTAL</td>
                                <td>$6,500.00</td>
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
</section>


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