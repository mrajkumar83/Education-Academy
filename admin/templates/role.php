<div class="content-warp">
<div class="table">
<form method="post" name="subjectForm" id="subjectForm" action="../admin/logic/role_logic.php?op=<?php echo $op;?>">
  <table cellspacing="0" cellpadding="0" class="listing form">
    <tbody>
      <tr>
        <th colspan="4" class="full">Role</th>
      </tr>
      <tr class="bg">
        <td class="first"><strong>Name:</strong></td>
        <td colspan="3" class="last"><input type="text" class="text" name="role_name" id="role_name" value="<?php echo $role_name;?>"></td>
      </tr>
      <tr>
        <td class="first"><strong>Permissions</strong></td>
        <td colspan="3" class="last"><input type="radio" class="textarea" name="role_permission" value="C"<?php echo ($role_permission== 'C' ? ' checked' : '');?>>
          &nbsp;Counselor&nbsp;&nbsp;
          <input type="radio" class="textarea" name="role_permission" value="F"<?php echo ($role_permission== 'F' ? ' checked' : '');?>>
          &nbsp;Finance&nbsp;
          <input type="radio" class="textarea" name="role_permission" value="O"<?php echo ($role_permission== 'O' ? ' checked' : '');?>>
          &nbsp;Operational&nbsp;&nbsp;
          <input type="radio" class="textarea" name="role_permission" value="H"<?php echo ($role_permission== 'H' ? ' checked' : '');?>>
          &nbsp;HR&nbsp; </td>
      </tr>
      <tr class="bg">
        <td class="first"><strong>Status</strong></td>
        <td colspan="3" class="last"><input type="radio" class="textarea" name="role_status" value="A"<?php echo ($role_status== 'A' ? ' checked' : '');?>>
          &nbsp;Active&nbsp;&nbsp;
          <input type="radio" class="textarea" name="role_status" value="D"<?php echo ($role_status== 'D' ? ' checked' : '');?>>
          &nbsp;De-Active&nbsp; </td>
      </tr>
    </tbody>
  </table>
  <p class="buttons">
    <input type="hidden" value="<?php echo $op;?>" name="op">
    <input type="hidden" value="<?php echo $id;?>" name="id" id="id">
    <input type="reset" value="Cancel" name="Cancel" onclick="document.location.href='manage_role.php'">
    &nbsp; &nbsp;
    <input type="submit" value="Submit" name="Add">
  </p>
</form>
