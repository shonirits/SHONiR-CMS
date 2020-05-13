<html><body style="background-color:#e2e1e0;font-family:tahoma;font-size:100%;font-weight:400;line-height:1.4;color:#000;">
    <table border="0" align="center" cellpadding="0" cellspacing="0"  style="width:659px;margin:20px auto 10px;background-color:#fff;padding:20px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);-moz-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);">
        <thead>
            <tr>
              <th style="width:50%;text-align:left;font-size: 10px;font-weight:400;"><a href="{{base_url}}" title="{{company}}"><img src="{{base_url}}media/uploads/{{logo}}" border="0" alt="{{company}}" height="59" /></a>
                <p>
                <a style="text-decoration: none;color:black;" href="{{base_url}}"><strong style="font-size: 12px;">{{company}}</strong></a><br>
                    Call/WhatsApp: <a style="text-decoration: none;color:black;" href="{{whatsapp}}">{{telephone}}</a> <br>
                    Email: <a style="text-decoration: none;color:black;" href="mailto:{{email}}">{{email}}</a><br />
                    Website: <a style="text-decoration: none;color:black;" href="{{base_url}}">{{website}}</a><br />
                    Address: {{address|raw}}<br/>
                    {{city}} - {{postcode}}, {{region}}, {{country}}</p>
            </th>
              <th style="width:50%;text-align:right;font-size: 10px;font-weight:400;"><strong style="font-size: 18px;">Purchase Order</strong>
                <br/>
                <a href="{{base_url}}Orders/track/{{reference}}" title="Track Order"><img src="{{base_url}}Code/bar/code128/{{reference}}"  border="0" alt="Track Order" height="59" style="margin:5px 0 0 0;" /></a>
            <br/>
            Date: {{time|date("l, F t, Y")}}<br />
            Order#: <a href="{{base_url}}Orders/track/{{reference}}" style="text-decoration: none;color:black;" title="Track Order">{{number}}</a><br />
            Order Status: <b>{{status}}</b>
            </th>
            </tr>
        </thead>
        <tbody>
            <tr>
              <td colspan="2"><hr align="center" noshade="noshade" color="#ddd" style="margin:10px 0 10px 0;padding:0px" /></td>
            </tr>
            <tr style="vertical-align: top;" valign="top">
                <td><p  style="font-size:10px;text-align:left;margin:0 5px 0 0;padding:0 5px 0 0;"><strong style="font-size: 12px;">Bill To:</strong><br>
                Name: {{bill_name}}<br />
               Telephone: {{bill_cell}} <br />
                Email: <a href="mailto:{{bill_email}}" style="text-decoration: none;color:black;">{{bill_email}}</a><br />
                    Address: {{bill_address|raw}}<br/>
                    {{bill_city}} - {{bill_postcode}}, {{bill_region}}, {{bill_country}}
                   </p></td>
                <td><p  style="font-size:10px;"><strong style="font-size: 12px;">Ship To:</strong><br>
                  Name: {{ship_name}}<br />
                  Telephone: {{ship_cell}} <br />
                   Email: <a href="mailto:{{ship_email}}" style="text-decoration: none;color:black;">{{ship_email}}</a><br />
                       Address: {{ship_address|raw}}<br/>
                       {{ship_city}} - {{ship_postcode}}, {{ship_region}}, {{ship_country}}
                     </p></td>
              </tr>
              <tr>
                <td style="height:15px;"></td>
              </tr>
            <tr>
                <td colspan="2" >
                  <table border="1" align="center" cellpadding="2" cellspacing="1" bordercolor="#aaa" style="width:100%; text-align:center;border: solid 1px #aaa;border-collapse: collapse;line-height:1.4">
                    <thead>
                    <tr style="background-color: #BBB;font-size: 12px;">
                    <th style="width:7%">S#</th>
                    <th style="text-align:left;">Description</th>
                    <th style="width:16%">Unit Cost</th>
                    <th style="width:10%">Qty</th>
                    <th style="width:18%;text-align:right;">Total Price</th>
                    </tr>
                  </thead>
                  <tbody style="border: solid 1px #aaa;">
                    {% set x = 0 %}
                    {% for product in products %}
                    {% set x = x+1 %}
                  <tr style="background-color: #EEE;font-size: 10px;">
    <td >{{loop.index}}.</td>
    <td style="text-align:left;">
    <a href="{{base_url}}Go/Pr/{{product.product_id}}" style="text-decoration: none;color:black;">
    <strong>{{product.name}}</strong><br/>
    Reference#: {{product.reference}}{{loop.length}}
    </a>
    </td>
    <td>{{product.selling_price|write_price}}</td>
    <td>{{product.quantity}}</td>
    <td style="text-align:right;">{{(product.selling_price*product.quantity)|write_price}}</td>
    </tr> 
    {% endfor %}
    {% if gift_cover %}
    {% set x = x+1 %}
    {% set sub_total = sub_total+gift_cover_price %}
    <tr style="background-color: #EEE;font-size: 10px;">
      <td >{{x}}.</td>
      <td style="text-align:left;">
      <strong>Gift Cover</strong>
      </td>
      <td>{{gift_cover_price|write_price}}</td>
      <td>1</td>
      <td style="text-align:right;">{{gift_cover_price|write_price}}</td>
      </tr> 
    {% endif %}
    {% if tag_card %}
    {% set x = x+1 %}
    {% set sub_total = sub_total+tag_card_price %}
    <tr style="background-color: #EEE;font-size: 10px;">
      <td >{{x}}.</td>
      <td style="text-align:left;">
      <strong>Tag Card</strong><br/>
      {{tag_card_text}}
      </td>
      <td>{{tag_card_price|write_price}}</td>
      <td>1</td>
      <td style="text-align:right;">{{tag_card_price|write_price}}</td>
      </tr> 
    {% endif %}
                  </tbody>
<tfoot style="border: solid 1px #fff;font-size: 10px;">
  <tr style="border: solid 1px #fff;font-size: 10px;">
    <td colspan="2" rowspan="7" style="border:solid 1px #fff;border-top: solid 1px #aaa;text-align:left;font-size: 20px;"><em><strong>Thank you!</strong></em></td>
    <td colspan="2" style="border:solid 1px #fff;border-top: solid 1px #aaa;font-size:10px;text-align:right;">Sub Total:</td>
    <td style="border:solid 1px #fff;border-top: solid 1px #aaa;font-size:10px;text-align:right;">{{sub_total|write_price}}</td>
    </tr>
    <tr>
        <td colspan="3" style="border:solid 1px #fff;font-size:10px"><hr align="center" noshade="noshade" color="#ddd" style="margin:0px;padding:0px" /></td>
        </tr>
    <tr style="border: solid 1px #fff;font-size: 10px;">
      <td colspan="2" style="border:solid 1px #fff;font-size:10px;text-align:right;">Shipping:</td>
      <td style="border:solid 1px #fff;font-size:10px;text-align:right;">{{shipping|write_price}}</td>
      </tr>
    <tr style="border: solid 1px #fff;font-size: 10px;">
      <td colspan="3" style="border:solid 1px #fff;font-size:10px"><hr align="center" noshade="noshade" color="#ddd" style="margin:0px;padding:0px" /></td>
      </tr>
    <tr style="border: solid 1px #fff;font-size: 10px;">
      <td colspan="2" style="border:solid 1px #fff;font-size:10px;text-align:right;">Tax:</td>
      <td style="border:solid 1px #fff;font-size:10px;text-align:right;">{{tax|write_price}}</td>
      </tr>                      
      <tr style="border: solid 1px #fff;font-size: 10px;">
        <td colspan="3" style="border:solid 1px #fff;font-size:10px"><hr align="center" noshade="noshade" color="#BBB" style="margin:0px;padding:0px" /></td>
        </tr>
      <tr style="border: solid 1px #fff;font-size: 10px;">
        <td colspan="2" style="border:solid 1px #fff;font-size:10px;text-align:right;"><strong>Grand Total:</strong></td>
        <td style="border:solid 1px #fff;font-size:10px;text-align:right;"><strong>{{grand_total|write_price}}</strong></td>
        </tr>
</tfoot>


                    </table>
                </td>
              </tr>
        </tbody>
  <tfoot>

    <tr>
      <td colspan="2"><hr align="center" noshade="noshade" color="#ddd" style="margin:10px 0 10px 0;padding:0px" /></td>
    </tr>
    <tr style="vertical-align: top;" valign="top">
        <td ><p  style="font-size:10px;text-align:left;margin:0 5px 0 0;padding:0 5px 0 0;"><strong style="font-size: 12px;">Customer Comments:</strong><br />
          {{user_comments|raw}}</p></td>
        <td style="height:35px;text-align:left;"><p  style="font-size:10px;"><strong style="font-size: 12px;"> Other Information:</strong><br>
          Currency: {{currency}}<br />
          Payment Method: {{payment_method}} <br />
          Shipping Method: {{shipping_method}}<br />
          Reference#:  <a href="{{base_url}}Orders/track/{{reference}}" style="text-decoration: none;color:black;" title="Track Order">{{reference}}</a>
          
            </p></td>
      </tr>
      <tr>
        <td style="height:15px;"></td>
      </tr>
      <tr>
        <td colspan="2" style="font-size:9px;color:#BBB">
      Note:<br/>Order was created on a computer and is valid without the signature and seal.<br/> The IP address {{ip}} used to place this order.
    </td>
  </tr>
  </tfoot>

  </table>


</body></html>