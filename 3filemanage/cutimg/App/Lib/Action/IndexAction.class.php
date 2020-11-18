<?php
/*
* cutting images example 
* author: xinqiyang
* blog: http://scotoma.cnblogs.om/
*/
class IndexAction extends Action
{
 public function index()
 {
  $this->display();
 }

 public function cutimg()
 {
  $result = $this->upload('temp');
  if (!is_array($result))
  {
   $this->redirect('index');
  }
  else
  {
   $this->assign('imgurl', '__ROOT__/' . C('ATTACHDIR') . '/temp/' . $result[0]['savename']);
   $this->assign('imgname', $result[0]['savename']);
   $this->display();
  }
 } 
 // cutting images
 public function setavatar()
 {
  if (!empty($_REQUEST['cut_pos']))
  {
  // import('ORG.Util.ImageResize');
   require('ImageResize.class.php');
   $imgresize = new ImageResize(); 
   // use the full path
   $url = C('ATTACHDIR') . '/temp/' . trim($_POST['imgname']);
   $imgresize->load($url);
   dump($url);
   $posary = explode(',', $_REQUEST['cut_pos']);
   foreach($posary as $k => $v)

   $posary[$k] = intval($v);

   if ($posary[2] > 0 && $posary[3] > 0) $imgresize->resize($posary[2], $posary[3]);

   dump($posary); 
   // create filename rule
   $uico = time() . '.jpg';
   dump($uico);
   $path = C('AVATAR'); 
   // save 120*120 image
   $imgresize->cut(120, 120, intval($posary[0]), intval($posary[1]));
   $large = 'l_' . $uico;
   $imgresize->save($path . $large);

   echo '<img src="'.__ROOT__.'/' . $path . $large . '" />'; 
   // update database
  }
  else
  { 
   // error reporting
  }
 }

 public function upload($module = '', $path = '', $thumb = '', $width = '', $height = '')
 {
  $module = $module = ""?'temp':$module;
  switch ($module)
  {
   case 'temp':$path = C(ATTACHDIR) . '/temp/' . $path;
    break;
   case 'storehouse':$path = C(ATTACHDIR) . '/storehouse/' . $path;
    break;
   case 'shop':$path = C(ATTACHDIR) . '/shop/' . $path;
    break;
   case 'trader': $path = C(ATTACHDIR) . '/trader/' . $path;
    break;
   case 'group': $path = C(ATTACHDIR) . '/group/' . $path;
    break;
   case 'my': $path = C(ATTACHDIR) . '/avatar/' . $path;
    break;
   default:$path = C(ATTACHDIR) . '/file/' . $path;
  }
  if (!is_dir($path)) @mk_dir($path);
  import("ORG.Net.UploadFile");
  $upload = new UploadFile();
  $upload->maxSize = C(ATTACHSIZE);
  $upload->allowExts = explode(',', strtolower(C(ATTACHEXT)));
  $upload->savePath = $path;
  $upload->saveRule = 'uniqid';
  empty($thumb)?$upload->thumb = C(ATTACH):$upload->thumb = $thumb;
  empty($width)?$upload->thumbMaxWidth = C(THUMBMAXWIDTH):$upload->thumbMaxWidth = $width;
  empty($height)?$upload->thumbMaxHeight = C(THUMBMAXHEIGHT):$upload->thumbMaxHeight = $height;

  if (!$upload->upload())
  {
   return $this->error($upload->getErrorMsg());
  }
  else
  {
   return $upload->getUploadFileInfo();
  }
 }
}

?>