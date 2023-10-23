<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>HIAS</title>
  <style>
     body { margin: 0; padding: 0; }
     .button{
      text-decoration: none;
      padding: 10px;
      color: white; 
      font-family: 'Gotham';
     }

     .button:hover{
      opacity: 0.5;
     }

    @media(min-width: 490px){
      p { 
       font-size: 14px; font-family: 'Gotham Book'; 
      }    
    } 

    @media(max-width: 480px){
      p{
        font-size: 11px !important;
      }
    }

    @media only screen and (max-device-width: 480px) {
       body {
       width: 320px !important; margin: 0; padding: 0;
      }

       table[class="wrappertable"] {
       width: 320px !important;
      }
       table[class="structure"] {
       width: 300px !important;
      }
       td[class="wrappercell"] {
       padding: 0 5px !important;
      }
       td[class="maincontent"] {
       padding: 15px 10px 5px !important;
      }
       table[class="titletable"] {
       width: 300px !important;
       margin: 0 0 0 0 !important;
      }
       td[class="titlecell"] {
       padding-top: 5px !important;
       padding-bottom: 20px !important;
      }
       h1[class="title"] {
       padding: 0px 10px 0 5px !important;
      }
       img[class="logo"] {
       display: none !important;
      }
       img[class="logo_hias_footer"] {
       width: 100%;
      }
       td[class="avatar"] {
       padding:10px 0 10px 10px !important;
      }
       td[class="tweeter"] {
       padding:10px 10px 10px 10px !important;
      }
       td[class="action"] {
       padding:15px 0 10px 10px !important;
      }
       td[class="replywrapper"] {
       padding:2% !important;
      }
       a[class="notifications"] {
       font-size:13px !important;
       line-height: 16px !important;
      }
       td[class="footerwrap"] {
       padding:25px 15px !important;
      }
      div[class="datetext"] { font-size: 0.8em !important; -webkit-text-size-adjust: none; }
    }
  </style>
</head>
<body>
<table cellspacing="0" cellpadding="0" border="0" width="100%" class="wrappertable">
  <tbody>
    <tr>
      <td style="background-color:#e9eff2;padding:30px 15px 0" class="wrappercell"><table cellspacing="0" cellpadding="0" border="0" align="center" width="710" style="font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;font-size:16px;color:#333" class="structure">
          <tbody>

            <tr>
              <td align="left" style="background-color:#fff; padding: 10px; border-bottom: 1px solid #efefef;">
                <div align="left" style="width: 20%; float: left">
                  <a href="<?php echo 'http://ddf.app-show.net/hias/';?>" target="_blank">
                    <img style="width: 40px;" src="<?php echo 'http://ddf.app-show.net/hias/'._WEBLOGO;?>">
                  </a>
                </div>
                <div align="right" style="width: 80%; float: left;">
                  &nbsp;<?php echo $title;?>
                </div>
              </td>
            </tr>

            <tr>
              <td style="background-color:#fff;padding:3%;" class="maincontent">
                <table cellpadding="0" cellspacing="0" border="0" width="600" align="center" style="margin:0 auto" class="titletable">
                  <tbody>
                    <tr>
                      <td height="36" width="540" valign="middle" class="titlecell">
                        <p class="signature" style="font-size: 12px;">Dear Bpk/Ibu <?php echo $name;?>,<br/><br/></p>

                        <?php echo $email_content;?>

                        <p class="signature" style="font-size: 12px;">
                          <br/><br/>Sincerely,
                        </p>

                        <p class="signature" style="font-size: 12px;">
                          <br/><?php echo _PT;?> Support
                        </p>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </td>
            </tr>

            <tr>
              <td style="background-color:#f1f1f1;padding:2%;border-top:1px solid #E4ECF0" class="replywrapper">
                <table cellpadding="0" cellspacing="0" border="0">
                  <tbody>
                    <tr>
                      <td valign="middle" style="width: 10%;padding:0 0 0 15px">
                        <table cellpadding="0" border="0" cellspacing="0">
                          <tbody>
                            <tr>
                              <td width="1" height="1" style="background-color:#fff"></td>
                              <td></td>
                              <td width="1" height="1" style="background-color:#fff"></td>
                            </tr>
                            <tr>
                              <td></td>
                              <td style="padding:5px">
                                <a href="<?php echo 'http://ddf.app-show.net/hias/';?>" target="_blank">
                                  <img style="width: 30px;" src="<?php echo 'http://ddf.app-show.net/hias/'._WEBLOGO;?>">
                                </a>
                              </td>
                              <td></td>
                            </tr>
                            <tr>
                              <td width="1" height="1" style="background-color:#fff"></td>
                              <td></td>
                              <td width="1" height="1" style="background-color:#fff"></td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                      <td valign="middle" style="width: 70%;padding:0 0 0 15px;font-size:10px;line-height:19px">
                        Jika butuh bantuan, gunakan halaman <a href="<?php echo base_url('contactus');?>" target="_blank">kontak kami</a><br/>
                        2017 &copy; <?php echo _PT;?>
                      </td>
                      <td valign="middle" style="width: 20%;padding:0 0 0 15px;font-size:10px;line-height:19px">
                        Ikuti Kami<br/>
                        <a style="text-decoration: none" href="<?php echo _FB;?>" target="_blank">
                          <img style="width: 20%;" src="<?php echo 'http://ddf.app-show.net/hias/'._FBLOGO;?>">
                        </a>
                        <a style="text-decoration: none" href="<?php echo _TW;?>" target="_blank">
                          <img style="width: 20%;" src="<?php echo 'http://ddf.app-show.net/hias/'._TWLOGO;?>">
                        </a>
                        <a style="text-decoration: none" href="<?php echo _IG;?>" target="_blank">
                          <img style="width: 20%;" src="<?php echo 'http://ddf.app-show.net/hias/'._IGLOGO;?>">
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </td>
            </tr>

            <tr>
              <td>
                <div style="padding:0 5px">
                  <div style="min-height:2px;line-height:2px;font-size:2px;background-color:#e2e7e7;clear:both"></div>
                </div>
              </td>
            </tr>

            <tr>
              <td style="font-size:11px;line-height:16px;color:#aaa;padding:25px 40px" class="footerwrap">
                Please do not reply to this message; it was sent from an unmonitored email address.  This message is a service email related to your use of Hias Web.  For general inquiries or to request support with your Hias account, please visit us at 
                <a href="<?php echo base_url('contactus');?>" style="color:#6d90a9;text-decoration:none" target="_blank">Hias Support</a>. 
              </td>
            </tr>

          </tbody>
        </table></td>
    </tr>
  </tbody>
</table>
</body>
</html>
