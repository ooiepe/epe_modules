

<?php

$node = node_load($nid);


// print('<pre>');
// print_r($node);
// print('</pre>');

?>



<?php

//$field_public_status_items = field_get_items('node', $node, 'field_public_status');
//$field_public_status = field_view_value('node',$node,'field_public_status', $field_public_status_items[0]);

//print_r('field_public_status: *' . $field_public_status . '*<br>');
//print_r('hasAccess_ApprovePublish: *' . $hasAccess_ApprovePublish . '*<br>');

//print('<pre>');
//print_r($node);
//print('</pre>');



  drupal_add_js('http://cosee.umaine.edu/climb/raphael-stable/js/raphael.js', 'external');
  drupal_add_js('http://cosee.umaine.edu/climb/raphael-stable/js/jquery.js', 'external');
  drupal_add_js('http://cosee.umaine.edu/climb/raphael-stable/js/map.js', 'external');
  drupal_add_js('http://cosee.umaine.edu/climb/raphael-stable/js/xml.js', 'external');
  
  // drupal_add_js(drupal_get_path('module', 'epe_cm') . '/js/raphael.js');
  // drupal_add_js(drupal_get_path('module', 'epe_cm') . '/js/jquery.js');
  // drupal_add_js(drupal_get_path('module', 'epe_cm') . '/js/map.js');
  // drupal_add_js(drupal_get_path('module', 'epe_cm') . '/js/xml.js');
  drupal_add_js(drupal_get_path('module', 'epe_cm') . '/js/assets.js');

  drupal_add_js('jQuery(document).ready(function () { loadMap(); });', array('type' => 'inline', 'scope' => 'footer', 'weight' => 5));


  drupal_add_css(drupal_get_path('module', 'epe_cm') . '/css/cmjs.css');


$field_cm_data_items = field_get_items('node', $node, 'field_cm_data');
$field_cm_data = field_view_value('node',$node,'field_cm_data', $field_cm_data_items[0]);

$field_out = render($field_cm_data);


$cm_desc = '';
if (isset($node -> body['und'][0]['value']))
  $cm_desc = json_encode($node -> body['und'][0]['value']);

if (isset($nid))
  $embedPath = $GLOBALS['base_url'] . '/node/' . $nid . '/cmembed';
else
  $embedPath = '';
?>



<script type="text/javascript">

//var paper, $map, cmx, cmy, xoffset, yoffset;
var paper, blockPaper, $map, cmx, cmy, xoffset, yoffset;

var assetLookupUrl = '<?php echo base_path() ?>api/resource/lookup';

function loadMap() {
  console.log('load map called');


  //paper = Raphael("canvas", 880, 695);
  console.log('load map called 2');
  //parseXml($.parseXML(document.getElementById('conceptMapContents').value));
  console.log('load map called 3 ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~');

                initPaper();
                setButtonEvents();
                // loadxml();
                parseXml($.parseXML(document.getElementById('conceptMapContents').value));
                
                var p = $( "#frame" );
                var position = p.position();
                $("#buttons").css({top: (position.top), left: (position.left), position:'absolute'});
                $("#blocks").css({top: (position.top+50), left: (position.left+10), position:'absolute'});
                //position.left


  console.log($('#close'));

  $('#close').on('click', function() {
    closeAssets();
  });

  $('#toolbar .btn').on('click', function(e) {
    gotoList(e.currentTarget.id);
  });

  return;
}

            
            $(window).on("orientationchange",function(){
                //alert("The orientation has changed!");
                resizeWebGL();
            });

            $( window ).resize(function() {
                //console.log( "window w ="+$( window ).width() );
                resizeWebGL();
            });


            function resizeWebGL(){
                var p = $( "#frame" );
                var position = p.position();
                $("#buttons").css({top: (position.top), left: (position.left), position:'absolute'});
                $("#blocks").css({top: (position.top+50), left: (position.left+10), position:'absolute'});
            }


            var pct = 1;
            var oppPct = 1;
            var wnum = 1000;
            var hnum = 800;
            var vbx = 0;
            var vby = 0;
            
            function initPaper(){
                paper = Raphael("canvas", 1000, 800);
                blockPaper = Raphael("blocks", 40, 300);
            };
            
            function setButtonEvents() {
                
                // btn = document.getElementById("run");
                
                // btn.onclick = function () {
                //     //$( "#canvas" ).toggle( { effect: "scale", percent: "50" } );
                //     //$('#canvas').toggle ( "scale", { percent:50 }, 1000 );
                //     paper.clear();
                //     blockPaper.clear();
                //     //console.log( "docnum = "+(docnum+1) );
                //     docnum = (docnum+1) >= xmlDocs.length ? 0 : (docnum+1);
                //     //console.log( "docnum = "+docnum );
                //     loadxml();
                // };
                
                btn = document.getElementById("sizeup");
                
                btn.onclick = function () {
                    //increasePaperSize();
                    pct-=.1;
                    oppPct+=.1;
                    //console.log("wnum = "+wnum);
                    //console.log("hnum = "+hnum);
                    //paper.changeSize(wnum, hnum, true, true);
                    console.log("x offset = "+(((wnum*oppPct)-wnum)/2));
                    console.log("y offset = "+(((hnum*oppPct)-hnum)/2));
                    paper.setViewBox(vbx+(((wnum*oppPct)-wnum)/2),vby+(((hnum*oppPct)-hnum)/2),(wnum*pct),(hnum*pct));
                    //console.log("background.width = "+background.getBBox().width);
                };
                
                btn = document.getElementById("sizedown");
                
                btn.onclick = function () {
                    //decreasePaperSize();
                    pct+=.1;
                    oppPct-=.1;
                    //console.log("pct = "+pct);
                    //console.log("(1000*pct) = "+(1000*pct));
                    console.log("x offset = "+(((wnum*oppPct)-wnum)/2));
                    console.log("y offset = "+(((hnum*oppPct)-hnum)/2));
                    paper.setViewBox(vbx+(((wnum*oppPct)-wnum)/2),vby+(((hnum*oppPct)-hnum)/2),(wnum*pct),(hnum*pct));
                    //paper.changeSize((1000*pct), (800*pct), true, true);
                };
                
            };





function renderAssets(assets) {

console.log(assets);

  var str = '';
  for (var i = 0; i < assets.conceptmaps.length; i++) {
    str += '<div class="item clearfix" id="item_' + assets.conceptmaps[i].index + '"><div class="title">' + assets.conceptmaps[i].title + '</div><div class="thumb"><img src="' + assets.conceptmaps[i].img + '" width="133"></div><div class="desc"><div class="content">' + assets.conceptmaps[i].longDesc + '</div><div class="mask"></div></div><div class="readmore">Click to read more</div></div>';
  }
  $('#listCM').html(str);

  str = '';
  for (var i = 0; i < assets.visualizations.length; i++) {
    str += '<div class="item clearfix" id="item_' + assets.visualizations[i].index + '"><div class="title">' + assets.visualizations[i].title + '</div><div class="thumb"><img src="' + assets.visualizations[i].img + '" width="133"></div><div class="desc"><div class="content">' + assets.visualizations[i].longDesc + '</div><div class="mask"></div></div><div class="readmore">Click to read more</div></div>';
  }
  $('#listEV').html(str);

  str = '';
  for (var i = 0; i < assets.lessons.length; i++) {
    str += '<div class="item clearfix" id="item_' + assets.lessons[i].index + '"><div class="title">' + assets.lessons[i].title + '</div><div class="thumb"><img src="' + assets.lessons[i].img + '" width="133"></div><div class="desc"><div class="content">' + assets.lessons[i].longDesc + '</div><div class="mask"></div></div><div class="readmore">Click to read more</div></div>';
  }
  $('#listLLB').html(str);

  str = '';
  for (var i = 0; i < assets.images.length; i++) {
    str += '<div class="item clearfix" id="item_' + assets.images[i].index + '"><div class="title">' + assets.images[i].title + '</div><div class="thumb"><img src="' + assets.images[i].img + '" width="133"></div><div class="desc"><div class="content">' + assets.images[i].longDesc + '</div><div class="mask"></div></div><div class="readmore">Click to read more</div></div>';
  }
  $('#listIMG').html(str);

  str = '';
  for (var i = 0; i < assets.videos.length; i++) {
    str += '<div class="item clearfix" id="item_' + assets.videos[i].index + '"><div class="title">' + assets.videos[i].title + '</div><div class="thumb"><img src="' + assets.videos[i].img + '" width="133"></div><div class="desc"><div class="content">' + assets.videos[i].longDesc + '</div><div class="mask"></div></div><div class="readmore">Click to read more</div></div>';
  }
  $('#listMOV').html(str);

  str = '';
  for (var i = 0; i < assets.docs.length; i++) {
    str += '<div class="item clearfix" id="item_' + assets.docs[i].index + '"><div class="title">' + assets.docs[i].title + '</div><div class="thumb"><img src="' + assets.docs[i].img + '" width="133"></div><div class="desc"><div class="content">' + assets.docs[i].longDesc + '</div><div class="mask"></div></div><div class="readmore">Click to read more</div></div>';
  }
  $('#listDOC').html(str);


  $('#list .item').on('click', function(e) {
    console.log('clicked item: ' + e.currentTarget.id);
    loadDetails(e.currentTarget.id.split('_')[1]);
  });

  // update the buttons ion the toolbar
  updateToolbar(assets);
  selectDefault(assets);

}

function selectDefault(assets) {

  // turn off all the sections
  $('#toolbar .btn').removeClass('on');
  $('#list .resList').hide();

  // check each item in order and turn on or move to next
  if (assets.conceptmaps.length > 0) {
    $('#btnCM').addClass('on');
    $('#listCM').show();
  } else if (assets.visualizations.length > 0) {
    $('#btnEV').addClass('on');
    $('#listEV').show();
  } else if (assets.lessons.length > 0) {
    $('#btnLLB').addClass('on');
    $('#listLLB').show();
  } else if (assets.images.length > 0) {
    $('#btnIMG').addClass('on');
    $('#listIMG').show();
  } else if (assets.videos.length > 0) {
    $('#btnMOV').addClass('on');
    $('#listMOV').show();
  } else if (assets.docs.length > 0) {
    $('#btnDOC').addClass('on');
    $('#listDOC').show();
  }


}

function updateToolbar(assets) {

  if (assets.conceptmaps.length > 0) {
    $('#btnCM').show();
  } else {
    $('#btnCM').hide();
  }
  if (assets.visualizations.length > 0) {
    $('#btnEV').show();
  } else {
    $('#btnEV').hide();
  }
  if (assets.lessons.length > 0) {
    $('#btnLLB').show();
  } else {
    $('#btnLLB').hide();
  }
  if (assets.images.length > 0) {
    $('#btnIMG').show();
  } else {
    $('#btnIMG').hide();
  }
  if (assets.videos.length > 0) {
    $('#btnMOV').show();
  } else {
    $('#btnMOV').hide();
  }
  if (assets.docs.length > 0) {
    $('#btnDOC').show();
  } else {
    $('#btnDOC').hide();
  }

}


function gotoList(listID) {
  $('#toolbar .btn').removeClass('on');
  $('#list .resList').hide();


  $('#' + listID).addClass('on');
  $('#list' + listID.substring(3)).show();
  

}


function loadDetails(index) {

  console.log(currentAssets.allAssets[index]);

}
            

</script>




<style>

.clearfix:after { 
   content: "."; 
   visibility: hidden; 
   display: block; 
   height: 0; 
   clear: both;
}


#close {
  background-image: url(http://localhost:8888/ooiepe_34/sites/all/modules/epe_modules/epe_cm/images/close.png?s);
  width: 34px;
  height: 34px;
  position: absolute;
  right: 20px;
  top: 5px;
}

#toolbar {
  position: relative;
  float: left;
  width: 52px;
  height: 695px;
  padding-top:40px;
  background-image: url(http://localhost:8888/ooiepe_34/sites/all/modules/epe_modules/epe_cm/images/toolbar_bg.png);
}


#btnCM, #btnEV, #btnLLB, #btnIMG, #btnMOV, #btnDOC {
  width: 52px;
  margin-bottom: 10px;
  padding: 0;
}

#btnLLB, #btnIMG, #btnMOV {
  height: 28px;
}

#btnDOC {
  height: 29px;
}

#btnEV {
  height: 27px;
}

#btnCM {
  height: 31px;
}

#btnCM {
    background-image: url(http://localhost:8888/ooiepe_34/sites/all/modules/epe_modules/epe_cm/images/toolbar_cm_off.png);
}
#btnEV {
    background-image: url(http://localhost:8888/ooiepe_34/sites/all/modules/epe_modules/epe_cm/images/toolbar_ev_off.png);
}
#btnLLB {
    background-image: url(http://localhost:8888/ooiepe_34/sites/all/modules/epe_modules/epe_cm/images/toolbar_llb_off.png);
}
#btnIMG {
    background-image: url(http://localhost:8888/ooiepe_34/sites/all/modules/epe_modules/epe_cm/images/toolbar_img_off.png);
}
#btnMOV {
    background-image: url(http://localhost:8888/ooiepe_34/sites/all/modules/epe_modules/epe_cm/images/toolbar_mov_off.png);
}
#btnDOC {
    background-image: url(http://localhost:8888/ooiepe_34/sites/all/modules/epe_modules/epe_cm/images/toolbar_doc_off.png);
}
#btnCM.on {
    background-image: url(http://localhost:8888/ooiepe_34/sites/all/modules/epe_modules/epe_cm/images/toolbar_cm_on.png);
}
#btnEV.on {
    background-image: url(http://localhost:8888/ooiepe_34/sites/all/modules/epe_modules/epe_cm/images/toolbar_ev_on.png);
}
#btnLLB.on {
    background-image: url(http://localhost:8888/ooiepe_34/sites/all/modules/epe_modules/epe_cm/images/toolbar_llb_on.png);
}
#btnIMG.on {
    background-image: url(http://localhost:8888/ooiepe_34/sites/all/modules/epe_modules/epe_cm/images/toolbar_img_on.png);
}
#btnMOV.on {
    background-image: url(http://localhost:8888/ooiepe_34/sites/all/modules/epe_modules/epe_cm/images/toolbar_mov_on.png);
}
#btnDOC.on {
    background-image: url(http://localhost:8888/ooiepe_34/sites/all/modules/epe_modules/epe_cm/images/toolbar_doc_on.png);
}

.resList {
  height: 600px;
  overflow: auto;
}

#list {
  position: relative;
  height: 600px;
  overflow: hidden;
  text-align: left;
  margin: 50px 30px 20px 72px;
}

#list .item {
  margin: 0px 0px 10px 0px;
  padding: 10px;
  background-color:rgba(74, 118, 163, 0.90);
  overflow: hidden;
}

#list .item .title {
  color: #fff;
  font-weight: bold;
  font-size: 14px;
  text-shadow: 1px 1px #000000;
  margin-bottom: 10px;
}

#list .item .thumb {
  float: left;
  width: 133px;
  height: 99px;
  margin-right: 10px;
  border: 2px solid #0e4b8a;
}

#list .item .desc {
  float: left;
  width: 590px;
  position: relative;

}

#list .item .desc .content {
  color: #d1e8ff;
  font-size: 14px;
  text-shadow: 1px 1px #000000;
  height: 80px;
  overflow: hidden;
}

#list .item .desc .mask { 
  position: absolute; 
  bottom: 0; 
  left: 0;
  width: 100%; 
  text-align: center; 
  margin: 0; padding: 10px 0; 
  background-image: linear-gradient(to bottom, transparent, rgba(74, 118, 163, 0.90));
}

#list .item .readmore {
  color: #efd0ba;
  font-size: 12px;
  float: left;
  margin-top: 5px;
}


#list .item .desc p {
  margin: 0;
  padding: 0;
}

#assetList {
  height: 650px; 
  overflow: hidden;
}

</style>


<div id="mapcontainer">
  <div id="frame">
    <div id="canvas"></div>
    <div id="blocks"></div>
    <div id="buttons">
      <!-- <button id="run" type="button">New Map</button> -->
      <button id="sizeup" type="button">+</button>
      <button id="sizedown" type="button">-</button>
    </div>
  </div>
  <div id="assetList" style="display: none;">
    <div id="toolbar">
      <div id="btnCM" class="btn on"></div>
      <div id="btnEV" class="btn"></div>
      <div id="btnLLB" class="btn"></div>
      <div id="btnIMG" class="btn"></div>
      <div id="btnMOV" class="btn"></div>
      <div id="btnDOC" class="btn"></div>
    </div>
    <div id="close"></div>
    <div id="list">
      <div id="listCM" class="resList"></div>
      <div id="listEV" class="resList"></div>
      <div id="listLLB" class="resList"></div>
      <div id="listIMG" class="resList"></div>
      <div id="listMOV" class="resList"></div>
      <div id="listDOC" class="resList"></div>
    </div>
    <div id="details">
    </div>

  </div>
</div>

<textarea id="conceptMapContents" name="conceptMapContents" style="display: none; width:500px; height:100px;"><?php echo $field_out ?></textarea>




