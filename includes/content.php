<?php
    /**
     * USED TO CREATED CONTENT TABLES
     * */
    
    
    /**
     * @data is content html or plain text
     * */
    function content($content_header,$data,$isNews){
        global $qualityColor, $site;
        // SETUP UP SOME MINI SCRIPTING
        for($i = 1; $i <= 6; $i++)
            $data = str_ireplace("@c$i","<font color='".$qualityColor[$i]."'>",$data);
        $data   = str_ireplace("@cc","</font>",$data);
        $data   = str_ireplace("@sn",$site['name'],$data);
        
        $content = '
        <center>
           <p/>
        <table width="300" cellpadding="0" cellspacing="0">
            <tr>
                <td width="4"><img src="images/ul_hdr.jpg" width="4"/></td>
                <td background="images/top_hdr.jpg" style="vertical-align:middle;">
                    '.$content_header.'
                </td>
                <td width="4"><img src="images/ur_hdr.jpg" width="4"/></td>
            </tr><tr>
                <td width="4" background="images/left_content.jpg"></td>
                <td background="images/content_bg.jpg">
                   ';
                   if($isNews == 1){ $content .=$data; } else { $content .= '<?php include("'.$data.'");?>'; }
                   $content .= '
                </td>
                 <td width="4" background="images/right_content.jpg"></td>
            </tr><tr>
                <td><img src="images/ll_content.jpg"/></td>
                <td><img src="images/bot_content.jpg"/></td>
                <td><img src="images/lr_content.jpg"/></td>
            </tr>
        </table>
        </center>
        ';
        return $content;
    }
?>