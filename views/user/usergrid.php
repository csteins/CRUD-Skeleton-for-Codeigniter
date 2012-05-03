<?
   $this->load->helper('url');
   $modify_url = site_url('user/modify/');
   $delete_url = site_url('user/delete/');
   $add_url    = site_url('user/add/');

?>
<h1>user overview</h1><br>
<form action='<?= $add_url; ?>' name="usergrid" id="usergrid" method='POST'>
    <input class="button" value="Add user" type="submit" name='add' id='add' accesskey="a">
</form>
<br />
<table border="0" cellpadding="2" cellspacing="1" width="100%">
<tr><td><b>username</b></td><td><b>password</b></td><td></td><td></td></tr>
<tbody>
<? foreach ($user_list as $row) { ?>
<tr>
<td align="left"><?= $row['username']; ?></td>
<td align="left"><?= $row['password']; ?></td>
<td align="left"><a href = "<?= $modify_url."/".$row["userid"]; ?>" >Edit</a></td>
<td align="left"><a href = "<?= $delete_url."/".$row["userid"]; ?>" onClick="javascript:return confirm('Delete?');">Delete</a></td>
</tr>
<? } ?>
</tbody>
</table>
<br />




