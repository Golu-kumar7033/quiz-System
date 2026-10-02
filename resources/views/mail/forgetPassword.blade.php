<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password</title>
</head>

<body style="margin:0; padding:0; background-color:#f4f6f8; font-family:Arial, Helvetica, sans-serif;">

  <table width="100%" cellpadding="0" cellspacing="0" border="0"
         style="background-color:#f4f6f8; padding:40px 15px;">
    <tr>
      <td align="center">

        <table width="100%" cellpadding="0" cellspacing="0" border="0"
               style="max-width:600px; background:#ffffff; border-radius:10px; overflow:hidden;">

          <!-- Header -->
          <tr>
            <td align="center" style="padding:30px 20px; background:#2563eb;">
              <h1 style="margin:0; color:#ffffff; font-size:28px;">
                Quiz System
              </h1>
            </td>
          </tr>

          <!-- Content -->
          <tr>
            <td style="padding:40px 35px; color:#333333;">

              <h2 style="margin-top:0; font-size:24px;">
                Reset Your Password
              </h2>

              <p style="font-size:16px; line-height:1.6;">
                Hi,
              </p>

              <p style="font-size:16px; line-height:1.6;">
                We received a request to reset the password for your Quiz
                System account. Click the button below to create a new password.
              </p>

              <!-- Button -->
              <table cellpadding="0" cellspacing="0" border="0" style="margin:30px auto;">
                <tr>
                  <td align="center" bgcolor="#2563eb" style="border-radius:6px;">
                    <a href="{{$link}}"
                       style="display:inline-block; padding:14px 28px;
                              font-size:16px; color:#ffffff;
                              text-decoration:none; font-weight:bold;">
                      Reset Password
                    </a>
                  </td>
                </tr>
              </table>

              <p style="font-size:14px; line-height:1.6; color:#666666;">
                This password reset link will expire in 24 hours.
              </p>

              <p style="font-size:14px; line-height:1.6; color:#666666;">
                If you didn't request a password reset, you can safely ignore
                this email. Your password will remain unchanged.
              </p>

              <p style="margin-bottom:0; font-size:16px; line-height:1.6;">
                Thanks,<br>
                <strong>Quiz System Team</strong>
              </p>

            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td align="center"
                style="padding:20px; background:#f8f9fa; color:#888888; font-size:12px;">
              © 2026 Quiz System. All rights reserved.
            </td>
          </tr>

        </table>

      </td>
    </tr>
  </table>

</body>
</html>
