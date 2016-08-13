<div class="content-warp">
    <div class="table">
        <form method="post" name="testForm" id="testForm" action="../admin/logic/college_logic.php?op=<?php echo $op; ?>" enctype="multipart/form-data">
            <table cellspacing="0" cellpadding="0" class="listing form">
                <tbody>
                    <tr>
                        <th colspan="4" class="full">Colleges</th>
                    </tr>
                   <?php
                   if(isset($op) && $op == 'A')
				   {
				   	?>
                    <tr class="bg">
                        <td class="first"><strong>College File:</strong><span class="complsory">*</span></td>
                        <td colspan="3" class="last">
                            <input type="file" class="text" name="college_file" styid="college_file">&nbsp;&nbsp;&nbsp;
                            <?php
                            if(isset($test_orgfile) && $test_orgfile != ''){
                            ?>
                            <a href="./downloadfile.php?path=papers&amp;&amp;filename=<?php echo $test_orgfile; ?>"><?php echo $test_orgfile; ?></a>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
				   }
                     if(isset($op) && $op == 'E')
				   {
                    ?>
               <tr class="bg">

                        <td class="first"><strong>Branch Name:</strong><span class="complsory">*</span></td>
                        <td colspan="3" class="last">
  <input type="text" class="text" name="college_name" id="college_name" value="<?php  echo $college_name; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="first"><strong>Status</strong></td>
                        <td colspan="3" class="last">
                            <input type="radio" class="textarea" name="college_status" value="A"<?php echo ($college_status == 'A' ? ' checked' : ''); ?>>&nbsp;Active&nbsp;&nbsp; 
                            <input type="radio" class="textarea" name="college_status" value="D"<?php echo ($college_status == 'D' ? ' checked' : ''); ?>>&nbsp;De-Active&nbsp;
                        </td>
                    </tr>
                    <?php
				   }
				   ?>
                </tbody></table>

            <p class="buttons">
                <input type="hidden" value="<?php echo $op; ?>" name="op">
                <input type="hidden" value="<?php echo $id; ?>" name="id">
                <input type="reset" value="Cancel" name="Cancel" onclick="document.location.href='manage_colleges.php'">
                &nbsp; &nbsp;
                <input type="submit" value="Submit" name="Add">
            </p>
        </form>