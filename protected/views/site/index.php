
 <form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post">
                <input type="hidden" name="cmd" value="_xclick-subscriptions">

                <!-- IPN and PDT URLs -->
                <input type="hidden" name="notify_url" value="http://localhost:1080/vnphoto/index.php" />
                <input type="hidden" name="return" value="http://localhost:1080/vnphoto/index.php" />
                <input type="hidden" name="rm" value="0" />

                <!-- Specify details about receiver, and customer -->
                <input type="hidden" name="business" value="nhaqueonline_24h@yahoo.com.vn" />
                <input type="hidden" name="custom" value="PASSTHROUGH-VARIABLE" />

                <!-- Specify details about the item that buyers will purchase. -->
                <input type="hidden" name="item_name" value="photo" />
                <input type="hidden" name="currency_code" value="USD" />

                <input type="hidden" name="no_shipping" value="1" />
                <input type="hidden" name="no_note" value="1" />
                <input type="image" src="http://www.paypal.com/en_US/i/btn/btn_subscribe_LG.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
                <input type="hidden" name="a3" value="240">
                <input type="hidden" name="p3" value="1">
                <input type="hidden" name="t3" value="M">
                <input type="hidden" name="src" value="1">
                <input type="hidden" name="sra" value="1">
        </form>

<form action="https://www.baokim.vn/payment/product/version11" method="get"><input type="hidden" name="business" value="nhaqueonline_24h@yahoo.com.vn"><input type="hidden" name="product_name" value="vietnam photo"><input type="hidden" name="product_price" value="400000"><input type="hidden" name="product_quantity" value="1"><input type="hidden" name="total_amount" value="400000"><input type="hidden" name="url_detail" value="http://localhost:1080/vnphoto/index.php/image/210"><input type="hidden" name="url_success" value="http://localhost:1080/vnphoto/index.php/site/Administrator"><input type="hidden" name="url_cancel" value="http://localhost:1080/vnphoto/index.php/image/index"><input type="hidden" name="order_description" value="download anh ca thang voi 400000d"><input type="hidden" name="id" value=""><input type="image" src="http://developer.baokim.vn/uploads/baokim_btn/thanhtoan-l.png" border="0" name="submit" alt="Thanh toán an toàn với Bảo Kim !" title="Thanh toán trực tuyến an toàn dùng tài khoản Ngân hàng (VietcomBank, TechcomBank, Đông Á, VietinBank, Quân Đội, VIB, SHB,... và thẻ Quốc tế (Visa, Master Card...) qua Cổng thanh toán trực tuyến BảoKim.vn"></form>

