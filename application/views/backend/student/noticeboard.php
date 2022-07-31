<div class="row">
	<div class="col-md-12">
    
    	
                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered">
                	<thead>
                		<tr>
                    		<th style="width:20%;font-weight:bold; background-color:#F37E3B;"><div><?php echo get_phrase('title');?></div></th>
                    		<th style="width:60%;font-weight:bold; background-color:#F37E3B;"><div><?php echo get_phrase('news');?></div></th>
                                
                    		<th style="width:20%;font-weight:bold; background-color:#F37E3B;"><div><?php echo get_phrase('date');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($notices as $row):?>
                        <tr>
							<td style="width:20%;color:#000;"><b><?php echo $row['notice_title'];?></b></td>
							<td class="span5" style="width:60%;font-size:15px;"><?php echo $row['notice'];?><br/>
                                                         <?php if($row['videofile']!=''){?>
                                                             <video width="200" height="200" controls>
                                                               <source src="https://crm.starbasketballacademy.com/uploads/notice_video/<?php echo $row['videofile']; ?>#t=2" type="video/mp4">
                                                            </video>
                                                          <?php }?><br/>
                                                           <?php if($row['imagefile']!=''){?>
<img src="https://crm.starbasketballacademy.com/uploads/notice_video/<?php echo $row['imagefile']; ?>" width="200" height="200"/>
                                                        <?php }?>
                                                        </td>
							<td style="width:20%;"><?php echo date('d M,Y', $row['create_timestamp']);?></td>
							
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			
	</div>
</div>