<?php
$insert = true;
$server = "localhost";
$username = "root";
$password = "";
$db="rest";

$con = mysqli_connect($server, $username, $password ,$db);
if(!$con){
    die("connect failed");
}

echo '<script>
if(localStorage.length==0)
      window.location.href = "../index.html";
</script>';

$order_no = $_POST['orderNoHelper'];
$name = $_POST['namehelper'];
$address = $_POST['addresshelper'];
$total = $_POST['totalhelper'];
$allfoods = $_POST['allfoodshelper'];
$allamounts = $_POST['allamountshelper'];

$foodlist = explode('#',$allfoods);
$amountlist = explode('#',$allamounts);

$date = date("Y/m/d");
$sql1 = "insert into user_def values('$order_no','$name','$address','$date','$total')";
if($con->query($sql1)){}
else {
    header("Location: ../index.html");
    exit();
}

for ($i = 0; $i < count($foodlist); $i++)  {
    $sql = "insert into orders (food,amount,order_no) values ('$foodlist[$i]','$amountlist[$i]','$order_no');";
    if($con->query($sql)){
    }
    else {echo $sql;echo $con->error;}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirm</title>
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');

body {
    background-color: #ffe8d2;
    font-family: 'Montserrat', sans-serif
}

.card {
    border: none
}

.logo {
    background-color: #eeeeeea8
}

.totals tr td {
    font-size: 13px
}

.footer {
    background-color: #eeeeeea8
}

.footer span {
    font-size: 12px
}

.product-qty span {
    font-size: 12px;
    color: #dedbdb
}
.home{
    float: right;
    background: #3a3b3c;
    padding:13px;
    font-size: 14px;
    border: none;
    color: white;
    border-radius:5px;
    font-weight:bold;
    transition: 0.3s;
    margin-right:-15px;
    font-family:Montserrat;
}
.home:hover{
    background: white;
    color: #3a3b3c;
    border: thin solid #3a3b3c;
}
    </style>
</head>
<body>
    <div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="text-left logo p-2 px-5"> <img src="../img/checked.png" width="50"> <button class="home" onclick="location.href = '../index.html';">Home</button></div>
                    <div class="invoice p-5">
                        <h5>Your order is placed</h5> <span class="font-weight-bold d-block mt-4" id="name">Hello, </span> <span>You order has been confirmed and will be delivered within 45 mins!</span>
                        <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="py-2"> <span class="d-block text-muted">Order Date</span> <span><?php echo date("j M Y"); ?></span> </div>
                                        </td>
                                        <td>
                                            <div class="py-2"> <span class="d-block text-muted">Order No</span> <span><?php echo $_POST['orderNoHelper']; ?></span> </div>
                                        </td>
                                        <td>
                                            <div class="py-2"> <span class="d-block text-muted">Payment</span> <span>COD</span> </div>
                                        </td>
                                        <td>
                                            <div class="py-2"> <span class="d-block text-muted">Delivery Address</span> <span id="address"></span> </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="product border-bottom table-responsive">
                            <table class="table table-borderless">
                                <tbody id="ordersum">
                                    
                                </tbody>
                            </table>
                        </div>
                        <div class="row d-flex justify-content-end">
                            <div class="col-md-5">
                                <table class="table table-borderless">
                                    <tbody class="totals">
                                        <tr>
                                            <td>
                                                <div class="text-left"> <span class="text-muted">Subtotal</span> </div>
                                            </td>
                                            <td>
                                                <div class="text-right"> <span id="subtotal">&#8377 </span> </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="text-left"> <span class="text-muted">Delivery charges</span> </div>
                                            </td>
                                            <td>
                                                <div class="text-right"> <span>&#8377 20</span> </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="text-left"> <span class="text-muted">GST(5%)</span> </div>
                                            </td>
                                            <td>
                                                <div class="text-right"> <span id="GST">&#8377 </span> </div>
                                            </td>
                                        </tr>
                                        
                                        <tr class="border-top border-bottom">
                                            <td>
                                                <div class="text-left"> <span class="font-weight-bold">Total</span> </div>
                                            </td>
                                            <td>
                                                <div class="text-right"> <span id="total" class="font-weight-bold">&#8377 </span> </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <p>We will be sending you order details on your email!</p>
                        <p class="font-weight-bold mb-0">Thanks for ordering</p> <span>Foodarc Team</span>
                    </div>
                    <div class="d-flex justify-content-between footer p-3"> <span>Need Help? Reach us at +91-9521246172</span> <span><?php echo date("j M Y"); ?></span> </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var bd=document.getElementById('ordersum');
        for(const key in localStorage){
            if(!isNaN(key[key.length-1])){
              bd.innerHTML+='<tr><td width="80%"> <span class="font-weight-bold">'+key+'</span></td><td width="20%"><div class="text-right"> <span class="font-weight-bold">'+localStorage.getItem(key)+'</span> </div></td></tr>'
            }
          }
          document.getElementById('name').innerHTML+=localStorage.getItem('name');
          document.getElementById('address').innerHTML=localStorage.getItem('address');
          document.getElementById('subtotal').innerHTML=localStorage.getItem('total');
          document.getElementById('GST').innerHTML+=localStorage.getItem('gst');
          document.getElementById('total').innerHTML+=localStorage.getItem('fintotal');
          setTimeout(()=>{
            localStorage.clear();
          }, 2000);
    </script>
    
</body>
</html>
