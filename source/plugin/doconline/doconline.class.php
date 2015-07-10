<?php
/*
 * 		http://www.docswf.com
 *      QQ:50245077  (C)
 */
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_doconline {	
}

class plugin_doconline_forum extends plugin_doconline {
	function post_attach_tab_extra_output(){
		global $_G;
		$doconline = $_G['cache']['plugin']['doconline'];
		$use_fids = unserialize($doconline[use_fids]);
		if(!in_array($_G[fid], $use_fids)) return "";
		$doc_download = $_G['cache']['plugin']['doconline']['doc_download']; 
		$message="";
		if($doc_download){
			$message=lang('plugin/doconline', 'lang_doconline_download_YES');
		}else{
			$message=lang('plugin/doconline', 'lang_doconline_download_NO');
		}
		return "<div style='margin:-10px 0px 10px 15px;color:red'>".$message."</div>";		
	}	
	function viewthread_posttop_output(){
		global $_G, $postlist;
		$doconline = $_G['cache']['plugin']['doconline'];
		$doc_on = $doconline['doc_on'];  
		$ppt_on = $doconline['ppt_on']; 
		$xls_on = $doconline['xls_on'];  
		$txt_on = $doconline['txt_on'];  		
		$pdf_on = $doconline['pdf_on'];
		$doc_download = $doconline['doc_download'];
		$_doc_loscon = $doconline['doc_loscon'];
		$use_fids = unserialize($doconline[use_fids]);
		$groupids = unserialize($doconline[use_groups]);
		$doc_width=$doconline['doc_width'];
		$doc_height=$doconline['doc_height'];
		if(!in_array($_G[fid], $use_fids)) return array();
		if(!in_array($_G[groupid], $groupids)) return array();
		foreach($postlist as $id => $post)   
		{
			$message = $postlist[$id]['message'];
			preg_match_all('/<ignore_js_op>(.|\n|\r)*?<\/ignore_js_op>/',$message,$matches);  //插入附件
			foreach($post[attachments] as $aid => $attachment) 
			{
				if($attachment!=0)
				{
					$_url=$attachment['url'];
					$_attachment=$attachment['attachment'];
					$_filename=$attachment['filename'];
					$_ext=strtolower($attachment['ext']);
					$_doc=$_G['siteurl']."source/plugin/doconline/doconline.php?doc=".$_url.$_attachment."&filename=".$_filename."&ext=".$_ext;	
					$_doc=urlencode($_doc);				
					$html = "<table><tr><td><h1>".$_filename."</h1></td></tr><tr><td><iframe name='doconline' width='".$doc_width."px' height='".$doc_height."px' marginwidth='0' marginheight='0'  frameborder='no' scrolling='no' src='https://docs.google.com/viewer?url=".$_doc."&embedded=true'></iframe></td></tr><tr>&nbsp;</tr></table>";
					if(($doc_on&&$_ext=='doc')||($doc_on&&$_ext=='docx')||($ppt_on&&$_ext=='ppt')||($ppt_on&&$_ext=='pptx')||($xls_on&&$_ext=='xls')||($xls_on&&$_ext=='xlsx')||($pdf_on&&$_ext=='pdf')||($txt_on&&$_ext=='txt')){
						if($doc_download=='1')
						{
							if(stripos($message,"<ignore_js_op>"))  //插入附件
							{
								foreach ($matches[0] as $mid => $matche) 
								{
									if(stripos($matche,$_filename))
									{
										$message=str_replace($matches[0][$mid],$html.$matches[0][$mid],$message);
										break;
									}
								}
							}
							else
							{
								$message.=$html;
							}
						}
						else
						{
							if(stripos($message,"<ignore_js_op>"))  //插入附件
							{
								foreach ($matches[0] as $mid => $matche) 
								{
									if(stripos($matche,$_filename))
									{
										$message=str_replace($matches[0][$mid],$html,$message);
										break;
									}
								}	
							}
							else
							{
							    $message .=$html;
								$postlist[$id]['attachments'][$aid]= array();									
							}	
						}
					}
				}
			}
			$postlist[$id]['message']=$message;
		}
		return array();
	}
}	
?>