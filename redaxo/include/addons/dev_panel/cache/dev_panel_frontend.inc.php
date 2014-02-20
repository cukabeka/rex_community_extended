<?php
$langswitch = $sep = '';
foreach($REX['CLANG'] as $cid => $cname)
{
  if($cid == $REX['CUR_CLANG']){
    $langswitch .= $sep.'[<em>'.$cid.'</em>] ('.$cname.')';
  }else{
    $langswitch .= $sep.'<a href="'.rex_getUrl($REX['ARTICLE_ID'],$cid).'">['.$cid.'] ('.$cname.')</a>';
  }
  $sep = ' , ';
}
echo '<h2 style="padding-bottom:4px;">ARTICLE_ID: [<em>'.$REX['ARTICLE_ID'].'</em>] CLANG: '.$langswitch.'</h2>';
?>
<div class="panel-wrapper-1">
  <h2><span class="edit-var"></span><span class="save-var" style="display:none;"></span><input type="text" class="toggler" id="panel-var-1" size="10" readonly="readonly" value="$_REQUEST" /></h2>
  <div id="panel-1" class="toggle-block">
  <?php
  if(isset($_REQUEST)) {
  echo "<pre>".var_export($_REQUEST, true)."</pre>";
  }else{
  echo "undefinded";
  }
  ?>
  </div><!-- #panel-1 -->
</div><!-- .panel-wrapper-1 -->

<div class="panel-wrapper-2">
  <h2><span class="edit-var"></span><span class="save-var" style="display:none;"></span><input type="text" class="toggler" id="panel-var-2" size="7" readonly="readonly" value="$_POST" /></h2>
  <div id="panel-2" class="toggle-block">
  <?php
  if(isset($_POST)) {
  echo "<pre>".var_export($_POST, true)."</pre>";
  }else{
  echo "undefinded";
  }
  ?>
  </div><!-- #panel-2 -->
</div><!-- .panel-wrapper-2 -->

<div class="panel-wrapper-3">
  <h2><span class="edit-var"></span><span class="save-var" style="display:none;"></span><input type="text" class="toggler" id="panel-var-3" size="6" readonly="readonly" value="$_GET" /></h2>
  <div id="panel-3" class="toggle-block">
  <?php
  if(isset($_GET)) {
  echo "<pre>".var_export($_GET, true)."</pre>";
  }else{
  echo "undefinded";
  }
  ?>
  </div><!-- #panel-3 -->
</div><!-- .panel-wrapper-3 -->

<div class="panel-wrapper-4">
  <h2><span class="edit-var"></span><span class="save-var" style="display:none;"></span><input type="text" class="toggler" id="panel-var-4" size="10" readonly="readonly" value="$_SESSION" /></h2>
  <div id="panel-4" class="toggle-block">
  <?php
  if(isset($_SESSION)) {
  echo "<pre>".var_export($_SESSION, true)."</pre>";
  }else{
  echo "undefinded";
  }
  ?>
  </div><!-- #panel-4 -->
</div><!-- .panel-wrapper-4 -->

<div class="panel-wrapper-5">
  <h2><span class="edit-var"></span><span class="save-var" style="display:none;"></span><input type="text" class="toggler" id="panel-var-5" size="8" readonly="readonly" value="$_FILES" /></h2>
  <div id="panel-5" class="toggle-block">
  <?php
  if(isset($_FILES)) {
  echo "<pre>".var_export($_FILES, true)."</pre>";
  }else{
  echo "undefinded";
  }
  ?>
  </div><!-- #panel-5 -->
</div><!-- .panel-wrapper-5 -->

<div class="panel-wrapper-6">
  <h2><span class="edit-var"></span><span class="save-var" style="display:none;"></span><input type="text" class="toggler" id="panel-var-6" size="9" readonly="readonly" value="$_COOKIE" /></h2>
  <div id="panel-6" class="toggle-block">
  <?php
  if(isset($_COOKIE)) {
  echo "<pre>".var_export($_COOKIE, true)."</pre>";
  }else{
  echo "undefinded";
  }
  ?>
  </div><!-- #panel-6 -->
</div><!-- .panel-wrapper-6 -->

<div class="panel-wrapper-7">
  <h2><span class="edit-var"></span><span class="save-var" style="display:none;"></span><input type="text" class="toggler" id="panel-var-7" size="9" readonly="readonly" value="$_SERVER" /></h2>
  <div id="panel-7" class="toggle-block">
  <?php
  if(isset($_SERVER)) {
  echo "<pre>".var_export($_SERVER, true)."</pre>";
  }else{
  echo "undefinded";
  }
  ?>
  </div><!-- #panel-7 -->
</div><!-- .panel-wrapper-7 -->
