<div class="content-warp">
<?php
 if($test_id == 0 && $msg != ''){
 echo $msg;
 echo '</div></body>
 </html>';
 exit;
 }
?>
    <div class="table">
        <form method="post" name="questionForm" id="questionForm" action="../admin/logic/question_logic.php?op=<?php echo $op; ?>">
            <table cellspacing="0" cellpadding="0" class="listing form">
                <tbody>
                    <?php
                    if (isset($questions) && $questions != '') {
                     ?>
                        <tr class="bg">
                            <th colspan="4" class="full">
                    <table width="100%">
                        <tr class="bg">
                            <td colspan="3"  width="100%" align="right"  style="float:right;padding-left:20px;"><strong>Exam&nbsp;Time&nbsp;:&nbsp;<?php echo $test->test_starttime; ?>&nbsp;--&nbsp;<?php echo $test->test_endtime; ?></strong></td>

                        </tr>
                        <tr class="bg">
                            <td width="20%" align="left" id="countdown">Duration&nbsp;:&nbsp;<?php echo $test_duration; ?></td>
                            <td width="50%" align="center"><?php echo $test->test_name; ?></td>

                            <td width="30%" align="right">Total Marks : <?php echo $test->test_marks; ?></td>
                        </tr></table>

                    </th>
                    </tr>
                    <?php
                    $slno = 1;
                    while ($question_all = mysql_fetch_object($questions)) {
                        ?>

                        <tr class="bg">				
                            <td class="first"><strong><?php echo $slno; ?>.</td>
                            <td colspan="3" class="last">
                                <p><?php echo $question_all->test_question; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="first">

                                <input type="radio" name="question_<?php echo $slno; ?>" value="A" />
                                <strong>a.</strong>&nbsp;&nbsp;<?php echo $question_all->test_option1; ?></td>
                            <td  class="first">
                                <input type="radio" name="question_<?php echo $slno; ?>" value="B" />
                                <strong>b.</strong>&nbsp;&nbsp;<?php echo $question_all->test_option2; ?></td>

                        </tr>
                        <tr >
                            <td></td>
                            <td class="first">
                                <input type="radio" name="question_<?php echo $slno; ?>" value="C" />
                                <strong>c.</strong>&nbsp;&nbsp;<?php echo $question_all->test_option3; ?></td>&nbsp&nbsp
                            <td  class="first">
                                <input type="radio" name="question_<?php echo $slno; ?>" value="D" />
                                <strong>d.</strong> &nbsp;&nbsp;<?php echo $question_all->test_option4; ?></td>
                            </td>
                        </tr>

                        <input type="hidden" name="answer_<?php echo $slno; ?>" value="<?php echo $question_all->test_answer; ?>" />
                        <input type="hidden" name="qust_id_<?php echo $slno; ?>" value="<?php echo $question_all->test_qust_id; ?>" />
                        <input type="hidden" name="qust_marks_<?php echo $slno; ?>" value="<?php echo $question_all->test_marks; ?>" />
                    <?php
                       $slno++;
                   }
                   ?>
                    <input type="hidden" name="test_id" value="<?php echo $test->test_id; ?>" />
                    <input type="hidden" name="total_qst" value="<?php echo $slno; ?>" />
                    </tbody></table>

                <p class="buttons">
                    <input type="hidden" value="<?php echo $op; ?>" name="op">
                    <input type="hidden" value="<?php echo $id; ?>" name="id">
                    &nbsp; &nbsp;
                    <input type="submit" value="Submit" name="Add">
                </p>
    <?php
    } else {

        echo "No test today.";
    }
?>
</form>
<?php
if($test_id != 0){
?>
<script>
    <!--
    timer = setInterval("auto_logout()", <?php echo $milliseconds; ?>);
    // set the date we're counting down to
    //var target_date = new Date("Dec 14, 2013").getTime();
    var timer = 0;
    var d1 = new Date (),
    d2 = new Date ( d1 );
    d2.setHours(d1.getHours()+<?php echo $test_dhr; ?>,d1.getMinutes() + <?php echo $test_dmin; ?>,d1.getSeconds()+<?php echo $test_dsec; ?>);

    target_date = new Date(d2);

    // variables for time units
    var days, hours, minutes, seconds;

    // get tag element
    var countdown = document.getElementById("countdown");

    // update the tag with id "countdown" every 1 second
    setInterval(function () {

        // find the amount of "seconds" between now and target
        var current_date = new Date().getTime();
        var seconds_left = (target_date - current_date) / 1000;

        // do some time calculations
        days = parseInt(seconds_left / 86400);
        seconds_left = seconds_left % 86400;

        hours = parseInt(seconds_left / 3600);
        seconds_left = seconds_left % 3600;

        minutes = parseInt(seconds_left / 60);
        seconds = parseInt(seconds_left % 60);
        if(seconds<10)
        {
            seconds = "0"+ seconds;
        }
        if(minutes<10)
        {
            minutes = "0"+ minutes;
        }

        // format countdown string + set tag value
        countdown.innerHTML = "Duration : " + hours + ":" + minutes + ":" + seconds ;  

    }, 100);

     function auto_logout() 
     {
        document.getElementById('questionForm').submit();
    }
    -->
</script>
<?php
}