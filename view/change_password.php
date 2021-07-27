
<!DOCTYPE html>
<html lang="en">
<head>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
        box-sizing: border-box;
      }
      input {
        margin-bottom: 3px;
        width: 255px;
      }
      label {
        display: inline-block;
        width: 160px;
<div width='100px'>
        <form action='./changepasschk.php' method="POST">
         
      }
 </style>
                <legend>
                    <b>Change Password</b>
                </legend>
                <table align="center">
                    <tr>
                        <td align="right">Current Password:</td>
                        <td><input type='password' name='current' required/>
                    </tr>
                    <tr>
                        <td align="right"><span style="color: green"> New Password:</span></td>
                        <td><input type='password' name='new' required/></td>
                    </tr>
                    <tr>
                        <td align="right"><span style="color: red;">Retype New Password:</span></td>
                        <td><input type='password' name='cnp' required/></td>
                    </tr>
                    
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>
                    <tr>
                        <td align="center" colspan="2"><input type='submit' value="Confirm"></td>
                    </tr>
                </table>
            </fieldset>
        </form>
    </div>
    
</body>
</html>
