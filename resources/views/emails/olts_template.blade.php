<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="icon" href="{{$data['client_logo']}}">
  <title>{{ $data['client_name'] }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style type="text/css">
  /**
   * Google webfonts. Recommended to include the .woff version for cross-client compatibility.
   */
  @media screen {
    @font-face {
      font-family: 'Source Sans Pro';
      font-style: normal;
      font-weight: 400;
      src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format('woff');
    }

    @font-face {
      font-family: 'Source Sans Pro';
      font-style: normal;
      font-weight: 700;
      src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format('woff');
    }
  }

  /**
   * Avoid browser level font resizing.
   * 1. Windows Mobile
   * 2. iOS / OSX
   */
  body,
  table,
  td,
  a {
    -ms-text-size-adjust: 100%; /* 1 */
    -webkit-text-size-adjust: 100%; /* 2 */
  }

  /**
   * Remove extra space added to tables and cells in Outlook.
   */
  table,
  td {
    mso-table-rspace: 0pt;
    mso-table-lspace: 0pt;
  }

  /**
   * Better fluid images in Internet Explorer.
   */
  img {
    -ms-interpolation-mode: bicubic;
  }

  h1 {
    color: #e0aa3e;
    font-size: 18px;
    font-weight: bold;
    margin-top: 0;
    text-align: left;
}

h2 {
    font-size: 16px;
    font-weight: bold;
    margin-top: 0;
    text-align: left;
}

h3 {
    font-size: 14px;
    font-weight: bold;
    margin-top: 0;
    text-align: left;

  /**
   * Remove blue links for iOS devices.
   */
  a[x-apple-data-detectors] {
    font-family: inherit !important;
    font-size: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
    color: inherit !important;
    text-decoration: none !important;
  }

  /**
   * Fix centering issues in Android 4.4.
   */
  div[style*="margin: 16px 0;"] {
    margin: 0 !important;
  }

  body {
    width: 100% !important;
    height: 100% !important;
    padding: 0 !important;
    margin: 0 !important;
    -premailer-cellpadding: 0;
    -premailer-cellspacing: 0;
    -premailer-width: 100%;
    background-color: #000000;
    border-bottom: 1px solid #000000;
  }

  /**
   * Collapse table borders to avoid space between cells.
   */
  table {
    border-collapse: collapse !important;
  }

  .table td {
    color: #cccccc;
    font-size: 15px;
    line-height: 18px;
    margin: 0;
    padding: 10px 0;
  }

  a {
    color: #1a82e2;
  }

  .button {
    -webkit-text-size-adjust: none;
    border-radius: 4px;
    color: #fff;
    display: inline-block;
    overflow: hidden;
    text-decoration: none;
  }

  img {
    height: auto;
    line-height: 100%;
    text-decoration: none;
    border: 0;
    outline: none;
  }
  </style>

</head>
<body style="background-color: #000000;">

  <!-- start preheader -->
  <div class="preheader" style="display: none; max-width: 0; max-height: 0; overflow: hidden; font-size: 1px; line-height: 1px; color: #fff; opacity: 0;">
    <!-- A preheader is the short summary text that follows the subject line when an email is viewed in the inbox. -->
  </div>
  <!-- end preheader -->

  <!-- start body -->
  <table border="0" cellpadding="0" cellspacing="0" width="100%">

    <!-- start logo -->
    <tr>
      <td align="center" bgcolor="#000000">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
          <tr>
            <td align="center" valign="top" style="padding: 36px 24px; color: #e0aa3e;">
              <a href="{{$data['site_url']}}" target="_blank" style="display: inline-block;">
                <img src="{{$data['client_logo']}}" alt="Logo" border="0" width="48" style="display: block; width: 70px; max-width: 70px; min-width: 70px;">
              </a><b />
              <h1 style="text-align: center; margin: 0; color: #e0aa3e;">{{ $data['client_name'] }}</h1>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <!-- end logo -->

    <!-- start hero -->
    <tr>
      <td align="center" bgcolor="#000000">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
          <tr>
            <td align="center" bgcolor="#2d2d2d" style="padding: 36px 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border-top: 3px solid #d4dadf;">
              <h1 style="text-align: center; margin: 0; font-size: 20px; font-weight: 700; letter-spacing: -1px; line-height: 48px; color: #e0aa3e;">{{ $data['subject'] }}</h1>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <!-- end hero -->

    <!-- start copy block -->
    <tr>
      <td align="center" bgcolor="#000000">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">

          <!-- start copy -->
          <tr>
            <td align="left" bgcolor="#353535" style="padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; color: #cccccc;">
              {!! $data['body'] !!}
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <!-- end copy block -->

    <!-- start receipt address block -->
    <tr>
      <td align="center" bgcolor="#000000" valign="top" width="100%">
        <table align="center" bgcolor="#353535" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; color: #cccccc;">
            @if($data['cta_link'])
                <tr>
                    <td align="center" style="padding:0 24px 36px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                        <a 
                            href="{{ $data['cta_link'] }}" 
                            target="_blank" 
                            style="
                                text-decoration: none;
                                background: #e0aa3e;
                                color: #ffffff;
                                text-align: center;
                                padding-top: 10px;
                                padding-bottom: 10px;
                                cursor: pointer;
                                font-weight: 900;
                                width: 100%;
                                display:inline-block
                            "
                        >{{ $data['cta_text'] }}</a>
                    </td>
                </tr>
            @endif

            <tr>
                <td align="left" bgcolor="#353535" style="padding: 0px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; color: #cccccc;">
                Regards, <br />
                <span style="font-weight: 900;">{{ $data['client_name'] }}</span>
                </td>
            </tr>

            @if($data['cta_link'])
                <tr>
                    <td align="center" bgcolor="#353535" style="padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;  border-bottom: 3px solid #d4dadf; color: #cccccc;">
                    <hr>
                        If you’re having trouble clicking the "{{$data['cta_text']}}" button, copy and paste the URL below into your web browser: <strong>{{ $data['cta_link'] }}</strong>
                    </td>
                </tr>
            @endif
        </table>
      </td>
    </tr>
    <!-- end receipt address block -->

    <!-- start footer -->
    <tr>
      <td align="center" bgcolor="#000000" style="padding: 24px;">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
          <tr>
            <td align="center" bgcolor="#000000" style="padding: 12px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #333;">
              <p style="margin: 0; text-align: center;">&copy; 2020-{{ date('Y') }} {{ $data['client_name'] }}. All rights reserved.</p>
            </td>
          </tr>

        </table>
      </td>
    </tr>
    <!-- end footer -->

  </table>
  <!-- end body -->

</body>
</html>
