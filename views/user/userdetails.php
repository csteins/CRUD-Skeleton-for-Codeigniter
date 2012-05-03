<?
$this->load->helper('url');
$action_url = site_url("/user/$action/");
$overview_url = site_url('/user/');
?>
<h1>Edit user</h1>
<a href="<? echo $overview_url;?>"><input value="back to overview" type="button"></a><br>
<form name="userdetails" method="POST" action="<?= $action_url; ?>">
	<input type='hidden' name='user[userid]' value='<?= $user['userid']; ?>' >
		<table cellspacing="2" cellpadding="2" border="0" width="100%">
			    <tr valign='top'>
            <td align='left'><b>username:</b></td>
            <td>
               <input type='text' name='user[username]' value='<?= $user['username']; ?>'"/>
            </td>
    </tr>
    <tr valign='top'>
            <td align='left'><b>password:</b></td>
            <td>
               <input type='text' name='user[password]' value='<?= $user['password']; ?>'"/>
            </td>
    </tr>
		</table>
	<input type="submit" name="Submit" value="Save user" accesskey="s">
</form>