<?php
/*
 * 		http://www.docswf.com
 *      QQ:50245077  (C)
 */
//��ȡ����
$doc=$_GET['doc'];
$doc="../../../".$doc;
$filename=$_GET['filename'];	
$ext=$_GET['ext'];
//�����ļ�����
if($ext=='doc')  {$_ext="application/msword";}
if($ext=='xls')  {$_ext="application/vnd.ms-excel";}
if($ext=='ppt')  {$_ext="application/vnd.ms-powerpoint";}
if($ext=='docx') {$_ext="application/vnd.openxmlformats-officedocument.wordprocessingml.document";}
if($ext=='xlsx') {$_ext="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";}
if($ext=='pptx') {$_ext="application/vnd.openxmlformats-officedocument.presentationml.presentation";}
if($ext=='pdf')  {$_ext="application/pdf";}
if($ext=='txt')  {$_ext="application/plain";}
//�����ļ�ͷ
header('Content-Disposition: attachment; filename='.$filename);
header('Content-Type:'.$_ext);
header('Content-Length:'.filesize($doc));
//��ȡ�ļ�
readfile($doc);
?>