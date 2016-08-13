<div class="content-warp">
    <div class="table">
        <form method="post" name="mailForm" id="mailForm" action="./logic/bulkmail_logic.php" enctype="multipart/form-data">
            <table cellspacing="0" cellpadding="0" class="listing form">
				<thead>
					<tr>
                        <th colspan="2" class="full">Mail</th>
                    </tr>
				</thead>
                <tbody>                    
					<tr class="bg">
                        <td class="first"><strong><?php echo $td_name;?></strong><span class="complsory">*</span></td>
                        <td class="last">
							<?php
							if(isset($ty) && $ty === 'E'){
							?>
							<input type="file" required="required" name="stdlist" id="stdlist">                            
							<?php
							} else{
							?>
								<select name="batchbranch" id="batchbranch" required="required">
									<option value="">-- Select --</option>
									<?php
									if($UTYPE == 'SA'){
										echo '<option value="A">All Batches</option>';
									}
									while ($batch_rec = mysql_fetch_object($batch)) {
										$val = $batch_rec->batch_id;//. "::" . $batch_rec->branch_id
										$opt = $batch_rec->batch_name . "[" . $batch_rec->branch_name . "]";
										echo '<option value="', $val, '"', (($val == $batchbranch) ? ' selected="selected"' : ''), '>', $opt, '</option>';
									}
									?>
								</select>
							<?php
							}?>
                        </td>
					</tr>
					<tr>
                        <td class="first"><strong>Subject</strong><span class="complsory">*</span></td>
                        <td class="last"><input type="text" value="" id="subject" name="subject" class="text" size="39"></td>
                    </tr>
					<tr class="bg">
                        <td class="first"><strong>Message</strong><span class="complsory">*</span></td>
                        <td class="last"><textarea id="msg" name="msg" cols="30"></textarea>
						<script>
								var editor = new TINY.editor.edit('editor', {
												id: 'msg',
												width: 680,
												height: 175,
												cssclass: 'tinyeditor',
												controlclass: 'tinyeditor-control',
												rowclass: 'tinyeditor-header',
												dividerclass: 'tinyeditor-divider',
												controls: ['bold', 'italic', 'underline', 'strikethrough', '|', 'subscript', 'superscript', '|',
													'orderedlist', 'unorderedlist', '|', 'outdent', 'indent', '|', 'leftalign',
													'centeralign', 'rightalign', 'blockjustify', '|', 'unformat', '|', 'undo', 'redo', 'n',
													'font', 'size', 'style', '|', 'image', 'hr', 'link', 'unlink', '|', 'print'],
												footer: false,
												fonts: ['Verdana','Arial','Georgia','Trebuchet MS'],
												xhtml: true,
												cssfile: 'css/custom.css',
												bodyid: 'editor',
												footerclass: 'tinyeditor-footer',
												toggle: {text: 'source', activetext: 'wysiwyg', cssclass: 'toggle'},
												resize: {cssclass: 'resize'}
											});
						</script>
						</td>
                    </tr>
				</tbody>
			</table>
			<br/>
			<p>&nbsp;&nbsp;&nbsp;&nbsp;<input name="AddNew" type="submit" value="Submit" class="login gradient" /></p>
        </form>
    </div>
</div>