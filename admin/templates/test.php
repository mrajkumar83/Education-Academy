<div class="content-warp">
    <div class="table">
        <form method="post" name="testForm" id="testForm" action="../admin/logic/test_logic.php?op=<?php echo $op; ?>" enctype="multipart/form-data">
            <table cellspacing="0" cellpadding="0" class="listing form">
                <tbody>
                    <tr>
                        <th colspan="4" class="full">TEST</th>
                    </tr>
                    <tr class="bg">

                        <td class="first"><strong>Test Name:</strong><span class="complsory">*</span></td>
                        <td class="last">
                            <input type="text" class="text" name="test_name" id="test_name" value="<?php echo $test_name; ?>">
                        </td>
                        <td class="first"><strong>Total Marks:</strong><span class="complsory">*</span></td>
                        <td class="last">
                            <input type="text" class="text required" name="test_marks" id="test_marks" value="<?php echo $test_name; ?>" title=" Required">
                        </td>
                    </tr>
                    <tr>

                        <td class="first"><strong>Start Date:</strong><span class="complsory">*</span></td>
                        <td  class="last">
                            <input type="text" class="text required" title=" Required" name="test_sdate" id="test_sdate" value="<?php echo ((isset($test_sdate) && $test_sdate != '' && $test_sdate != '0000-00-00') ? date("m/d/Y", strtotime($test_sdate)) : ''); ?>">
                        </td>
                        <td class="first"><strong>Test Time:</strong><span class="complsory">*</span></td>
                        <td colspan="3" class="last">
                            <select name="hr1" id="hr1">
                                <option value="">Hr</option>
                                <?php
                                for ($i = 0; $i <= 24; $i++) {
                                    if ($i < 10) {
                                        $k = "0" . $i;
                                    } else {
                                        $k = $i;
                                    }
                                    echo '<option value="', $k, '"' . (($hr1 == $i) ? ' selected="selected"' : '') . '>', $k, '</option>';
                                }
                                ?>
                            </select>&nbsp;&nbsp;
                            <select name="min1" id="min1" required="required">
                                <option value="">Min</option>
                                <?php
                                for ($i = 0; $i <= 59; $i++) {
                                    if ($i < 10) {
                                        $k = "0" . $i;
                                    } else {
                                        $k = $i;
                                    }
                                    echo '<option value="', $k, '"' . (($min1 == $k) ? ' selected="selected"' : '') . '>', $k, '</option>';
                                }
                                ?>
                            </select>&nbsp;&nbsp;
                        </td>
                    </tr>

                    <tr class="bg">
                        <td class="first"><strong>Time Allocated:</strong><span class="complsory">*</span></td>
                        <td colspan="3" class="last">
                            <select name="hr" id="hr">
                                <option value="">Hr</option>
                            <?php
                            for ($i = 0; $i <= 6; $i++) {
                                if ($i < 10) {
                                    $k = "0" . $i;
                                } else {
                                    $k = $i;
                                }
                                echo '<option value="', $i, '"' . (($hr == $i) ? ' selected="selected"' : '') . '>', $k, '</option>';
                            }
                            ?>
                            </select>&nbsp;&nbsp;
                            <select name="min" id="min" required="required" tabindex="1">
                                <option value="">Min</option>
                                <?php
                                for ($i = 0; $i <= 59; $i++) {
                                    if ($i < 10) {
                                        $k = "0" . $i;
                                    } else {
                                        $k = $i;
                                    }
                                    echo '<option value="', $k, '"' . (($min == $k) ? ' selected="selected"' : '') . '>', $k, '</option>';
                                }
                                ?>
                            </select>&nbsp;&nbsp;
                        </td>
                    </tr>

                    <tr>
                        <td class="first"><strong>Allocated to:</strong></td>
                        <td colspan="3" class="last">
                            <select name="allocated_to" id="allocated_to" required="required" onchange="javascript:get_amount(this.value)">
                                <option value="">-- Select --</option>
                            <?php
                            while ($batch_rec = mysql_fetch_object($batch)) {
                                $val = $batch_rec->batch_id . "::" . $batch_rec->branch_id;
                                $opt = $batch_rec->batch_name . "[" . $batch_rec->branch_name . "]";
                                echo '<option value="', $val, '"', (($val == $allocated_to) ? ' selected="selected"' : ''), '>', $opt, '</option>';
                            }
                            ?>
                            </select>
                        </td>
                    </tr>
                    <tr class="bg">

                        <td class="first"><strong>Test File:</strong><span class="complsory">*</span></td>
                        <td colspan="3" class="last">
                            <input type="file" class="text" name="test_file" id="test_file">&nbsp;&nbsp;&nbsp;
                            <?php
                            if($test_orgfile != ''){
                            ?>
                            <a href="./downloadfile.php?path=papers&amp;&amp;filename=<?php echo $test_orgfile; ?>"><?php echo $test_orgfile; ?></a>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>

                </tbody></table>

            <p class="buttons">
                <input type="hidden" value="<?php echo $op; ?>" name="op">
                <input type="hidden" value="<?php echo $id; ?>" name="id">
                <input type="reset" value="Cancel" name="Cancel" onclick="document.location.href='manage_test.php'">
                &nbsp; &nbsp;
                <input type="submit" value="Submit" name="Add">
            </p>
        </form>