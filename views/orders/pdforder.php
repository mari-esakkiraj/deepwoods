<?php 
use yii\helpers\Url;
$absoluteBaseUrl = Url::base(true);
use app\models\UserAddresses;
use app\models\Users;
use app\models\Products;
use app\models\Settings;
use yii\helpers\Html;

$orderAddress = UserAddresses::find()->where(['id' => $order->shipping_address_id])->one();
$customer = Users::find()->where(['id' => $order->customer_id])->one();
$settings = Settings::findOne(1);
$absoluteBaseUrl = Url::base(true);
$logoURL = $absoluteBaseUrl."/theme/img/deepwoods.png";
if(isset($settings->company_logo)){
    $logoURL = $settings->company_logo;
}
function amountInWord($number) {
   $no = floor($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => 'Zero', '1' => 'One', '2' => 'Two',
    '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
    '7' => 'Seven', '8' => 'Eight', '9' => ' Nine',
    '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
    '13' => 'Thirteen', '14' => 'Fourteen',
    '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
    '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
    '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
    '60' => 'Sixty', '70' => 'Seventy',
    '80' => 'Eighty', '90' => 'Ninety');
   $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);

  $points = ($point) ?
          " And " . $words[floor($point / 10) * 10]
          . " " . (($point % 10) > 0 ?$words[$point % 10] : '')  . " Paise" : '';
  return $result . "Rupees  " . $points;
}  

function convertstr($no){
    $digits_1 = strlen($no);
    $i = 0;
    $str = array();
    $words = array('0' => 'Zero', '1' => 'One', '2' => 'Two',
        '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
        '7' => 'Seven', '8' => 'Eight', '9' => ' Nine',
        '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
        '13' => 'Thirteen', '14' => 'Fourteen',
        '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
        '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
        '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
        '60' => 'Sixty', '70' => 'Seventy',
        '80' => 'Eighty', '90' => 'Ninety');
    $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
    while ($i < $digits_1) {
        $divider = ($i == 2) ? 10 : 100;
        var_dump($divider);exit;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += ($divider == 10) ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number] .
                " " . $digits[$counter] . $plural . " " . $hundred
                :
                $words[floor($number / 10) * 10]
                . " " . $words[$number % 10] . " "
                . $digits[$counter] . $plural . " " . $hundred;
        } else $str[] = null;
    }
    $str = array_reverse($str);
    $result = implode('', $str);
    return $result;
}

?>
<section class="checkout-cart-area">
<?php 
    echo '';
?>

<h3><img class="logo-main" src="<?= $logoURL ?>" alt="Logo" width="200px" /> </h3>
<div class="row">
    <div class="col">
        <table class="table table-hover table-bordered ">
            <tr>
                <th style="padding: 10px;" colspan="4">
                <?= $settings->company_name ?>, <br/>
                <?php echo nl2br(stripslashes(($settings->address_line_1))) ?><br/>
                    <!-- Shop No. 2, Ground Floor, <br/>
                    No 37/16, Mirbakshi Ali Street, <br/>
                    Royapettah, Chennai - 600 014. <br/> -->
                    Mob: +91 <?= $settings->phone_no ?> <br/>
                    Email: <?= $settings->company_email ?><br/>
                    GST No: <?= $settings->gst_number ?><br/>
                    FSSAI No: <?= $settings->fssai_number ?>
                </th>
                <td style="padding: 10px;" rowspan="2" colspan="3">
                    <u>Invoice No:</u> <?php echo $order->invoice_code ?? '-'; ?><br/><br/><br/>
                    <u>Date:</u> <?php echo date("d-m-Y",$order->created_at) ?? '-'; ?><br/><br/><br/>
                    <u>Dispatch Through:</u> Road<br/><br/><br/><br/><br/>
                    <u>Destination:</u> <?php echo $orderAddress->city ?? '-'; ?><br/><br/>

                </td>
            </tr>
            <tr>
                <td style="padding: 10px;" colspan="4">
                <u>Customer</u><br/>
                <?php echo $order->firstname ?? ''; ?> 
                <?php //echo $customer->lastname ?? ' '; ?><br/>
                <?php echo $orderAddress->address ?? ''; ?><br/>
                <?php echo $orderAddress->city ?? ''; ?><br/>
                <?php echo $orderAddress->state ?? ''; ?> -
                <?php echo $orderAddress->zipcode ?? ''; ?><br/>
                <?= !empty($order->phone) ? "Mob: ".$order->phone : ''; ?><br/>
                <?= !empty($order->email) ? "Email: ".$order->email : ''; ?><br/>
                <?= !empty($customer->gst_number) ? "GST No: ".$customer->gst_number : ''; ?><br/>
                
            </td>
            </tr>
    
            <tr>
                <th  style="padding: 10px;width:10%;">S.No</th>
                <th  style="padding: 10px;width:30%;">Description of Goods</th>
                <th  style="padding: 10px;width:15%;">HSN/SAC</th>
                <th  style="padding: 10px;width:8%;">Qty</th>
                <th  style="padding: 10px;width:15%;">Price</th>
                <th  style="padding: 10px;width:9%;">Disc%</th>
                <th  style="padding: 10px;width:13%;text-align:center;">Amount</th>
            </tr>
            <?php $gstList= []; 
            foreach ($order->orderItems as $key => $item): 
                $product = Products::findOne($item->product_id);
                if(in_array($product->hsn_sac,$gstList)) {
                    $gstList[$product->hsn_sac]['tax_amount'] += $item->product_gst_price;
                    $gstList[$product->hsn_sac]['amount'] += ($item->quantity * $item->unit_price);
                } else {
                    $gstList[$product->hsn_sac] = [
                        'rate' => $product->gst,
                        'amount' => ($item->quantity * $item->unit_price) ,
                        'tax_amount' => $item->product_gst_price,
                    ];
            }?>
                <tr>
                    <td style="padding: 10px;"><?= $key+1?></td>
                    <td style="padding: 10px;">
                        <?= $item->product_name ?><br/>
                       <small style="text-align:right"> Out Put CGST- <?= $product->gst/2?>%<br/>
                        Out Put SGST- <?= $product->gst/2?>%</small>
                    </td>
                    <td style="padding: 10px;"><?= !empty($product->hsn_sac) ? $product->hsn_sac : ''?></td>
                    <td style="padding: 10px;"><?= $item->quantity ?></td>
                    <td style="padding: 10px;text-align:right">
                        <?= $item->unit_price; ?><br/>
                        <?= $product->gst/2 ?>% <br/>
                        <?= $product->gst/2 ?>% 
                    </td>
                    <td style="padding: 10px;">0</td>
                    <td style="padding: 10px;text-align:right;">
                        <?= number_format($item->quantity * $item->unit_price,2); ?><br/>
                        <?= number_format(($item->product_gst_price / 2),2)?> <br/>
                        <?= number_format(($item->product_gst_price / 2),2)?> <br/>
                    </td>
                </tr>
            <?php endforeach; ?>
           
            <?php 
            if($order->gst != 0) 
            {
                ?>
                <tr>
                    <td style="padding: 10px;"></td>
                    <td style="padding: 10px;"></td>
                    <td style="padding: 10px;"></td>
                    <td style="padding: 10px;"></td>
                    <td style="padding: 10px;" style="text-align: right">GST <?php //echo $gst;%?></td>
                    <td></td><td style="padding: 10px;" style="text-align: right">
                        <?= $order->gst; ?>
                    </td>
                </tr>
                <?php 
            }
            ?>
            <?php 
            if($order->freight_charges != 0)  {
                ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="padding: 10px;" style="text-align: right">Freight Charges <?php //echo $freight_charges;%?></td>
                    <td></td><td style="padding: 10px;" class="text-right">
                        <?= $order->freight_charges; ?>
                    </td>
                </tr>
                <?php 
            }
            ?>
            <?php 
            if($order->promotion_price>0) {
                ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="padding: 10px;" style="text-align: right">Discount</td>
                    <td></td>
                    <td style="padding: 10px;" class="text-right">
                        <?= $order->promotion_price; ?>
                    </td>
                </tr>
                <?php 
            }
            ?>

            <tr>
                <td style="padding: 10px;"></td>
                <td style="padding: 10px;"></td>
                <td style="padding: 10px;"></td>
                <td style="padding: 10px;"></td>
                <th style="padding: 10px; text-align: right">SubTotal</th>
                <td style="padding: 10px;"></td>
                <td style="padding: 10px; text-align: right">
                    <?= $order->total_price ?>
                </td>
            </tr>
            
            <tr>
                <td style="padding: 10px;" colspan="7"> Amount Chargeable (in words) <br/><?= amountInWord($order->total_price)?></td>
            </tr>
            <tr>
        </table>
        <table class="table table-hover table-bordered taxTable" style="text-align:right;font-size:10px;">
            <tr >
                <td style="padding: 10px;font-size:10px;font-size:10px;" rowspan="2">HSN/SAC</td>
                <td style="padding: 10px;text-align:center;font-size:10px;" rowspan="2">Taxable Value</td>
                <td style="padding: 10px;text-align:center;font-size:10px;" colspan="2">Central Tax</td>
                <td style="padding: 10px;text-align:center;font-size:10px;" colspan="2">State Tax</td>
                <td style="padding: 10px;text-align:center;font-size:10px;" rowspan="2">Total Tax Amount</td>
            </tr>
            <tr>
                <td style="padding: 10px;text-align:center;font-size:10px;">Rate</td>
                <td style="padding: 10px;text-align:center;font-size:10px;">Amount</td>
                <td style="padding: 10px;text-align:center;font-size:10px;">Rate</td>
                <td style="padding: 10px;text-align:center;font-size:10px;">Amount</td>
            </tr>
            <?php $totalTax = 0;
            $totalTaxAmount = 0;
            foreach($gstList as $tax_key => $tax) {
                $totalTax += $tax['tax_amount'] ;
                $totalTaxAmount += $tax['amount'];?>
                <tr>
                    <td  style="padding: 10px;"><?= $tax_key?></td>
                    <td  style="padding: 10px;text-align:center;font-size:10px;"><?= number_format($tax['amount'],2)?></td>
                    <td  style="padding: 10px;text-align:center;font-size:10px;"><?= number_format(($tax['rate']/2),2)?></td>
                    <td  style="padding: 10px;text-align:center;font-size:10px;"><?= number_format(($tax['tax_amount']/2),2)?></td>
                    <td  style="padding: 10px;text-align:center;font-size:10px;"><?= number_format(($tax['rate']/2),2)?></td>
                    <td  style="padding: 10px;text-align:center;font-size:10px;"><?= number_format(($tax['tax_amount']/2),2)?></td>
                    <td  style="padding: 10px;text-align:center;font-size:10px;"><?= number_format($tax['tax_amount'],2) ?></td>
                </tr>

            <?php }?>
            <tr>
                <td  style="padding: 10px;"> Total</td>
                <td  style="padding: 10px;text-align:center;font-size:10px;"> <?= number_format($totalTaxAmount,2)?></td>
                <td  style="padding: 10px;text-align:center;font-size:10px;"></td>
                <td  style="padding: 10px;text-align:center;font-size:10px;"> <?= number_format(($totalTax/2),2)?></td>
                <td  style="padding: 10px;text-align:center;font-size:10px;"></td>
                <td  style="padding: 10px;text-align:center;font-size:10px;"> <?= number_format(($totalTax/2),2)?></td>
                <td  style="padding: 10px;text-align:center;font-size:10px;"> <?= number_format($totalTax,2)?></td>
            </tr>
            <tr>
                <td style="padding: 10px;" colspan="4"> Tax Amount (in words) <br/><?= amountInWord($totalTax)?></td>
                <td colspan="3" rowspan="2">
                    For Deepwoods Organics
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    Authorised Signatory
                </td>
            </tr>
            <tr>
                <td style="padding: 10px;" colspan="4"> 
                    <span>Company's PAN: AAUFD8314Q</span><br/>
                    <span>Declaration : We declare that Invoice shows the actual price of the goods described and that all particulars are true and correct.</span><br/>
                    <div style="padding-left: 30px;"><small>Note: This is a computer generated invoice no need of signature</small></div>
            </td>
            </tr>
        </table>

        
    </div>
</div>
    
   
</section>