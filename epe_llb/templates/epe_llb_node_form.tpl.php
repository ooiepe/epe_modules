<?php angularjs_init_application('app'); ?>

<?php
  /* a hack to deal with existing LLB's unassign text format selector field */
  //drupal_add_css('.form-type-select { display: none; }','inline');
  $alter_fields = array('body','field_resource_file_note','field_background_content','field_challenge_content','field_explanation_content','field_guidance_content','field_instructional_content','field_introductory_content','field_preconception_content','field_resources_content','field_student_objectives');
  foreach($alter_fields as $field) {
    $form[$field]['und'][0]['format']['format']['#options'] = array('llb_textfield_filter'=>'Investigation Textfield Filter');
  }
?>



<script>
    jQuery(document).ready(function() {
      jQuery('.llb-bb').each(function() {
        var height = Math.max(jQuery(this).find('.llb-bb-this').actual('height'), jQuery(this).find('.llb-bb-next').actual('height'), jQuery(this).find('.llb-bb-previous').actual('height'))
        jQuery(this).find('.llb-bb-this').height(height);
        jQuery(this).find('.llb-bb-next').height(height);
        jQuery(this).find('.llb-bb-previous').height(height);
      });

    });
</script>

<style>
.nav-tabs > li > a, .nav-pills > li > a {

  padding-right: 8px;
  padding-left: 8px;
  font-weight: bold;
}

.nav-tabs > li > a {
  line-height: 16px;
  background-color: #e1edf1;
  color: #06698e;
  font-size: 13px;
  border-bottom: 1px solid #2094bf;
}

.nav-tabs {
  border-bottom: 1px solid #2094bf;
}

.nav-tabs > .active > a, .nav-tabs > .active > a:hover, .nav-tabs > .active > a:focus {
  color: #06698e;
  background-color: #fff;
  border-color: #2094bf #2094bf transparent #2094bf;
}

.nav-tabs .pull-right {
  margin-left: 5px;
}


.top .form-actions {
    float: right;
    padding: 0;
    margin-top: 0px;
    margin-bottom: 10px;
    background-color: none;
    border-top: none;
}


</style>


<div class="form-help"><a href="<?php echo base_path() . "node/214" ?>" target="_blank">Help with this form</a></div>

<div class="top">
<?php echo render($form['actions']); ?>
</div><br clear="all">

<div class="tabbable">
<ul id="llbnav" class="nav nav-tabs">
  <li class="active"><a href="#instruction" data-toggle="tab" style="background-color:#ececec;color:#606060;">Instructions</a></li>
  <li><a href="#objectives" data-toggle="tab" style="background-color:#ececec;color:#606060;">Learning Objective</a></li>
  <li><a href="#motivation" data-toggle="tab">Introduction</a></li>
  <li><a href="#background" data-toggle="tab">Background</a></li>
  <li><a href="#challenge" data-toggle="tab">Challenge</a></li>
  <li><a href="#exploration" data-toggle="tab">Exploration</a></li>
  <li><a href="#explanation" data-toggle="tab">Explanation</a></li>
  <li class="pull-right"><a href="#setup" data-toggle="tab" style="background-color:#ececec;color:#606060;">Cover</a></li>
  <li class="pull-right"><a href="#notes" data-toggle="tab" style="background-color:#ececec;color:#606060;">Instructor Notes</a></li>
</ul>

<div class="tab-content">

<div class="tab-pane active" id="instruction">
  <?php
    if(file_exists(drupal_get_path('module','epe_llb') . '/contents/instruction/instruction.html')) {
      $content = file_get_contents(drupal_get_path('module','epe_llb') . '/contents/instruction/instruction.html');
      if($content) {
        $dom = new domDocument;
        @$dom->loadHTML($content);
        $images = $dom->getElementsByTagName('img');
        foreach($images as $img) {
          $content = str_replace($img->getAttribute('src'), base_path() . drupal_get_path('module','epe_llb') . '/contents/instruction/' . basename($img->getAttribute('src')), $content);
        }
        echo $content;
      }
    }
  ?>

  <div class="clearfix"></div>
  <!--<button type="button" class="btn btn-success" data-toggle="tab" data-target="objectives" onclick="jQuery('#llbnav li:eq(1) a').tab('show');">Next <i class="icon-chevron-right icon-white"></i></button>-->
</div> <!-- /#instruction -->
<div class="tab-pane" id="objectives">
  <h3>Establish your Learning Objective</h3>
  <div class="row-fluid">
    <div class="span7">
      <p>The first step to creating an effective investigation is to develop a student learning objective or SLO. The learning objective is essentially the goal of your activity, and typically answers the following questions:</p>
      <ul>
        <li>What science concept do you want your students to learn about?</li>
        <li>What content, context, and/or dataset will they use to study this concept?</li>
        <li>What outcome do you hope they will accomplish, that is, how will you assess their learning?</li>
      </ul>

      <p>By specifying your learning objective up front, you will be able to focus your investigation on those elements that students need to accomplish your specific goal.</p>

      <p><em>Identify a learning objective you would like your students to investigate in this investigation.</em></p>
      <div class="control-group"><?php echo render($form['field_student_objectives']); ?></div>

      <p>Don't worry about perfecting this right away, you can always come back and adjust it later.</p>

      <p>As you develop your investigation, the datasets and questions you include should support the objective you identified.  If they don't, you probably shouldn't include them in this activity (otherwise, you should rewrite your objective).  If you find that you have additional content you would like students to investigate that goes beyond your specified goal, you can consider creating additional investigations with another objective.</p>
    </div>

    <?php
      if( file_exists(drupal_get_path('module','epe_llb') . '/contents/objectives/examples.html') ) {
        $content = file_get_contents(drupal_get_path('module','epe_llb') . '/contents/objectives/examples.html');
        if($content):
    ?>
    <div class="span5 well">
    <?php echo $content; ?>
    </div>
    <?php endif; } ?>
  </div>
  <?php echo render($form['block_objectives_info']); ?>

<!--   <button type="button" class="btn btn-success" data-toggle="tab" data-target="motivation" onclick="jQuery('#llbnav li:eq(2) a').tab('show');">Next <i class="icon-chevron-right icon-white"></i></button> -->
</div> <!-- /#goal -->

<div class="tab-pane" id="motivation">
  <h3>Introduction: Provide a Motivating Context</h3>
  <div class="row-fluid">
    <div class="span6">
      <p>Why should students care about this investigation?  Why is this topic important?  How is this investigation relevant to students' lives?</p>
      <p>Students learn best when they are engaged in a topic.  It's important to start your activity with a motivating context or story that spurs their interest in the content and helps them understand its relevance.  You can use the slideshow and text on this page to tell the &quot;story&quot; behind the investigation.</p>
      <div class="control-group">
        <label class="control-label" for="inputTitle"><strong>Enter the text you would like to appear on this page.</strong></label>
        <div class="controls">
          <?php echo render($form['field_introductory_content']); ?>
        </div>
      </div>
      <div class="well">
        <p>Possible ideas for an introductory story:</p>
        <ul>
          <li>If students are studying an event, detail the impacts the event had (e.g. damage from coastal flooding during a Hurricane)</li>
          <li>If students will be investigating data from a specific cruise or project, provide an overview of the expedition or program's science goals.</li>
          <li>If students will be investigating a specific location, describe the importance of the location to humans or the ecosystem.</li>
          <li>If students will investigate a specific process, describe how understanding the process is important to science and/or society.</li>
        </ul>
      </div>
    </div>

    <div class="span6 intro-slideshow">
      <p><strong>Introductory Slideshow</strong></p>
      <p>Choose one or more resources that help explain the story behind this investigation.  You should provide a caption for each image.</p>
      <?php echo render($form['field_introductory_slideshow']); ?>

      <div ng-show="currentCopies.keys.length > 0" class="control-group text-warning">
        <table class="table">
          <tr class="warning"><td>All changes are temporary.</td></tr>
        </table>
      </div>

      <table class="table table-condensed">
        <tbody ng-model="items">
        <tr ng-repeat="item in items">
          <td>
            <img ng-src="{{item.thumbnail}}" style="cursor: move;" width="133">
            <div ng-show="fn.inItemEditArray(item.key)">
              <textarea name="title" ng-model="currentCopies.items[item.key].title" cols="35" rows="2"></textarea>
              <br/>
              <button type="button" class="btn btn-small" ng-click="fn.cancelItemEdit(item.key);">Cancel</button>
              <button type="button" class="btn btn-small btn-primary" ng-click="fn.saveEditItem(item.key);">Save</button>
            </div>
            <div ng-show="!fn.inItemEditArray(item.key)">
              <p>{{item.title}}</p>
              <div><a ng-click="fn.editItem($index);" style="cursor:pointer;"><i class="icon-edit"></i>&nbsp;Edit</a>
                   <a ng-click="removeDataSet($index);" style="cursor:pointer;"><i class="icon-trash"></i>&nbsp;Delete</div>
              <div ng-show="currentCopies.items.length < 1"><br/>
              <a ng-show="$index < items.length-1" ng-click="fn.rearrangeItems($index, $index+1);" style="cursor:pointer;"><i class="icon-arrow-down"></i>&nbsp;Move down</a>
              <a ng-show="$index > 0" ng-click="fn.rearrangeItems($index, $index-1);" style="cursor:pointer;"><i class="icon-arrow-up"></i>&nbsp;Move up</a>
              </div>
            </div>
          </td>
        </tr>
        </tbody>
      </table>

      <?php echo render($form['intro_slideshow_button']); ?>
    </div>
  </div>
  <?php echo render($form['block_introduction_info']); ?>

<!--   <button type="button" class="btn btn-success" data-toggle="tab" data-target="background" onclick="jQuery('#llbnav li:eq(3) a').tab('show');">Next <i class="icon-chevron-right icon-white"></i></button> -->
</div> <!-- /#intro -->

<div class="tab-pane" id="background">
  <h3>Add Background Content</h3>
  <div class="row-fluid">
    <div class="span6">
      <p>What information should students know about or review before they start analyzing data?  Use this page to provide any background information you would like students to review before diving into the data.
      <div class="control-group">
        <label class="control-label" for="inputTitle">Background Information</label>
        <div class="controls">
          <?php echo render($form['field_background_content']); ?>
        </div>
      </div>

      <p>You may include links to other sites if you wish to provide students with supplementary information.</p>
      <p>Possible ideas to include in the background text:</p>
      <ul>
        <li>Facts about a scientific concept or process</li>
        <li>Details on where or how a dataset was collected </li>
        <li>How an instrument collects and processes data</li>
        <li>Background information about the event, study area, or phenomena students will investigate</li>
      </ul>
    </div>

    <div class="span6 background-slideshow">
      <p><strong>Background Slideshow</strong></p>
      <p>Choose one or more resources that help provide background information or context on this investigation.  You should provide a caption for each image.</p>
      <?php echo render($form['field_background_slideshow']); ?>
      <table class="table table-condensed">
        <tbody ng-model="items">
        <tr ng-repeat="item in items">
          <td>
            <img ng-src="{{item.thumbnail}}" style="cursor: move;">
            <div ng-show="fn.inItemEditArray(item.key)">
              <textarea name="title" ng-model="currentCopies.items[item.key].title" cols="35" rows="2"></textarea>
              <br/>
              <button type="button" class="btn btn-small" ng-click="fn.cancelItemEdit(item.key);">Cancel</button>
              <button type="button" class="btn btn-small btn-primary" ng-click="fn.saveEditItem(item.key);">Save</button>
            </div>
            <div ng-show="!fn.inItemEditArray(item.key)">
              <p>{{item.title}}</p>
              <div><a ng-click="fn.editItem($index);" style="cursor:pointer;"><i class="icon-edit"></i>&nbsp;Edit</a>
                   <a ng-click="removeDataSet($index);" style="cursor:pointer;"><i class="icon-trash"></i>&nbsp;Delete</div>
              <div ng-show="currentCopies.items.length < 1"><br/>
              <a ng-show="$index < items.length-1" ng-click="fn.rearrangeItems($index, $index+1);" style="cursor:pointer;"><i class="icon-arrow-down"></i>&nbsp;Move down</a>
              <a ng-show="$index > 0" ng-click="fn.rearrangeItems($index, $index-1);" style="cursor:pointer;"><i class="icon-arrow-up"></i>&nbsp;Move up</a>
              </div>
            </div>
          </td>
        </tr>
        </tbody>
      </table>
      <?php echo render($form['background_slideshow_button']); ?>
    </div>
  </div>
  <hr>
  <div class="row-fluid">
    <div class="span7">
      <p><strong>Background Questions</strong></p>
      <p>On this page, you can include one or more questions to check that students have read through the background materials, or to have students reflect on their current knowledge.</p>

      <p>Enter one or more questions you would like students to think about before starting the investigation.</p>
      <div class="control-group">
        <?php echo render($form['field_background_question']); ?>
      </div>
    </div>
    <div class="span5 well">
    <p><strong>Instructional Tips</strong></p>
    <p>Generally, information that students need to know to complete an investigation should be reviewed during prior activities or lectures.  It can also be included in the investigation itself.  Information should be included in the Background step if it provides basic contextual information.  Otherwise, if the information is crucial to students' understanding of the investigation, it can be included as a piece of evidence in the Exploration step.</p>
    <!--<p>The view in contemporary learning theory is that people construct new knowledge and understanding based on what they already know and believe.  This is why it is helpful to ask students up front about content they should already know about to check their knowledge level.  These questions can also be used to establish the current thought processes students use, which can then be compared with any gains or changes in their knowledge after they complete an investigation.  Identifying changes in student thought processes can help you distinguish between the concepts they understand and those they need more guidance on.</p>-->
    </div>
  </div>
  <?php echo render($form['block_background_info']); ?>

<!--   <button type="button" class="btn btn-success" data-toggle="tab" data-target="challenge" onclick="jQuery('#llbnav li:eq(4) a').tab('show');">Next <i class="icon-chevron-right icon-white"></i></button> -->
</div> <!-- /#background -->

<div class="tab-pane" id="challenge">
  <h3>Create a Challenge</h3>
  <div class="row-fluid">
    <div class="span6">
      <p>Before this step, you should draft your learning objective and identify some key datasets you would like students to use in this investigation.  With those ideas in mind, you can now identify the research challenge you wish your students to pursue.</p>
      <p>First, choose one of the following scientific practices you would like students to work on in this investigation:</p>
      <div class="control-group">
        <?php echo render($form['field_desired_assessment']); ?>
      </div>
    </div>
    <div class="span6">
      <p><strong>Challenge Image</strong></p>
      <p>Choose an image that you feel represents this investigation.  This image will also be used as the thumbnail for your investigation.</p>

      <?php echo render($form['field_challenge_thumbnail']); ?>
      <table class="table table-condensed">
        <tbody ng-model="items">
        <tr ng-repeat="item in items">
          <td>
            <img ng-src="{{item.thumbnail}}" style="cursor: move;">
            <div>
              <a ng-click="removeDataSet($index);" style="cursor:pointer;"><i class="icon-trash"></i>&nbsp;Delete</div>
            </div>
          </td>
        </tr>
        </tbody>
      </table>
      <?php echo render($form['challenge_thumbnail_button']); ?>
    </div>
  </div>
  <hr>
  <div class="row-fluid">
    <div class="span7">
      <!--<p><strong>Challenge Question</strong></p>-->
      <p>Second, based on your selection above, construct a research challenge or question that students should investigate in this activity.</p>
      <div class="control-group">
        <?php echo render($form['field_challenge_content']); ?>
      </div>
      <p>The challenge should encourage students to analyze the provided datasets following the practice you selected above.  For a more straightforward task, the challenge could be a specific research question.  For a more complex task, the challenge could ask students to develop and investigate their own question or identify and explain a relationship they see in the data.</p>
      <p>The challenge should connect your learning objective with the applied scientific practices you wish your students to develop.</p>
    </div>
    <div class="span5 well">
      <p><strong>Example Challenge Questions</strong></p>
      <p>We suggest constructing your challenge based on one of the following templates.  These are based on common scientific practices.</p>
      <ul>
        <li>Develop a conceptual model to explain...</li>
        <li>Analyze data from... to identify or explain...</li>
        <li>Construct an explanation using the data provided that describes...</li>
        <li>Investigate the data from... and develop your own question about the dataset, and explain it as best you can.</li>
      </ul>
    </div>
  </div>
  <?php echo render($form['block_challenge_info']); ?>

<!--   <button type="button" class="btn btn-success" data-toggle="tab" data-target="exploration" onclick="jQuery('#llbnav li:eq(5) a').tab('show');">Next <i class="icon-chevron-right icon-white"></i></button> -->
</div> <!-- /#challenge -->

<div class="tab-pane" id="exploration">
  <h3>Identify Datasets to Explore</h3>
  <div class="row-fluid">
    <div class="span6">
      <p>In this section, you can add one or more datasets, or pieces of evidence, to your investigation.  Datasets can include visualizations, concept maps, images, videos or documents like papers or spreadsheets.</p>
      <p>For each dataset, add a short description and a few questions that will spur students to investigate important details in the data.  The description might include background information on the dataset, where it came from, or how to understand what is being shown.  The questions should guide students in analyzing and interpreting what is shown.  Each dataset should assist students in addressing the larger research challenge, and individually they can each be considered as one step in a larger investigative process. </p>
    </div>
    <div class="span6 well">
      <p><strong>How do I prepare each dataset?</strong></p>
      <p>The Investigation Builder is designed to create investigations that are inquiry driven.  Students are presented with a research challenge and a number of datasets or other pieces of evidence to investigate.  In this way, students can be guided through the scientific process, in which they can practice building their science skills.  This can include building models, analyzing and interpreting data, constructing explanations, or developing new questions.</p>
      <p>Students will use the provided datasets to help them investigate the larger challenge you pose to them.  Each dataset can be considered a piece of evidence that can be pieced together to address the larger challenge question they are researching.</p>
    </div>
  </div>

  <div class="field-container control-group">
    <?php echo render($form['field_exploration_dataset']); ?>

    <div ng-show="currentCopies.keys.length > 0" class="control-group text-warning">
      <table class="table">
        <tr class="warning"><td>All changes are temporary.</td></tr>
      </table>
    </div>

    <div ng-show="failed_messages != ''" class="control-group text-error">
      <table class="table">
        <tr class="warning"><td>{{failed_messages}}</td></tr>
      </table>
    </div>

    <div ng-></div>

    <table class="table table-condensed">
      <tr>
        <th width="25%">Dataset</th>
        <th width="40%">Dataset Description</th>
        <th width="35%">Investigation Questions</th>
      </tr>
      <tbody ng-model="items">
      <tr ng-show="items.length < 1" class="text-warning">
        <td colspan="3" class="warning" style="text-align:center;padding:10px;">
          This investigation does not yet include any datasets. Choose an option below to add your first dataset.
        </td>
      </tr>
      <tr ng-repeat="item in items">
        <td>
          <img ng-src="{{item.thumbnail}}">
          <div ng-show="fn.inItemEditArray(item.key)">
            <textarea name="title" ng-model="currentCopies.items[item.key].title" cols="35" rows="2"></textarea>
            <br/>
            <button type="button" class="btn btn-small" ng-click="fn.cancelItemEdit(item.key);">Cancel</button>
            <button type="button" class="btn btn-small btn-primary" ng-click="fn.saveEditItem(item.key);">Save</button>
          </div>
          <div ng-show="!fn.inItemEditArray(item.key)">
            <p>{{item.title}}</p>
            <div>
              <a ng-click="fn.editItem($index);" style="cursor:pointer;"><i class="icon-edit"></i>&nbsp;Edit</a>
              <a ng-click="removeDataSet($index);" style="cursor:pointer;"><i class="icon-trash"></i>&nbsp;Delete</a>
              <a ng-show="item.type == 'cm_resource' || item.type == 'llb_resource' || item.type == 'ev_tool_instance'" ng-click="copyDataSet($index);" style="cursor:pointer;"><i class="icon-share"></i>&nbsp;Copy</a>
              <div ng-show="currentCopies.items.length < 1"><br/>
              <a ng-show="$index < items.length-1" ng-click="fn.rearrangeItems($index, $index+1);" style="cursor:pointer;"><i class="icon-arrow-down"></i>&nbsp;Move down</a>
              <a ng-show="$index > 0" ng-click="fn.rearrangeItems($index, $index-1);" style="cursor:pointer;"><i class="icon-arrow-up"></i>&nbsp;Move up</a>
              </div>
            </div>
          </div>
        </td>
        <td>
          <div ng-show="fn.inItemEditArray(item.key)">
            <textarea ckeditor id="body_{{item.key}}" name="body_{{item.key}}" cols="70" rows="10" ng-model="currentCopies.items[item.key].body"></textarea>
          </div>
          <div ng-show="!fn.inItemEditArray(item.key)">
            <div ng-bind-html="item.body" class="item body"></div>
          </div>
        </td>
        <td>
          <ul class="list">
            <div ng-show="!fn.inItemEditArray(item.key)">
            <li ng-repeat="question in item.questions">
              {{question.text}}
            </li>
            </div>
            <div ng-show="fn.inItemEditArray(item.key)">
              <li ng-repeat="question in currentCopies.items[item.key].questions">
                <textarea name="question" rows="3" cols="35" ng-model="question.text"></textarea><span>&nbsp;<i class="icon-trash" ng-click="fn.removeItemQuestion(item.key, $index);"></i></span>
              </li>
            </div>
          </ul>
          <div ng-show="fn.inItemEditArray(item.key)">
          <button type="button" class="btn btn-small btn-primary" ng-click="fn.addQuestion(item.key);">Add Question</button>
          </div>
        </td>
      </tr>
      </tbody>
    </table>

    <p><strong>Add another Dataset:</strong></p>
    <?php //echo render($form['resource_browser']); ?>

    <?php echo render($form['resource_browser_buttons']); ?>
  </div>

  <hr>
  <div class="row-fluid">
    <div class="span7">
      <h4>Exploration Instructions</h4>
      <p>As students investigate each of the above datasets, you will want to provide them with additional instructions or questions that will help them focus their research of each piece of data on the overall research challenge.  Keep in mind that students may view the datasets in the order of their choosing.  The instructions you provide may encourage this non-linear approach to conducting an investigation, and may also warn them to be wary of red herrings or ancillary details.</p>
      <p>Enter your instructions in the following box.</p>

      <div class="control-group">
<!--       <label class="control-label" for="inputTitle"><strong>Guidance Text</strong></label> -->
      <?php echo render($form['field_guidance_content']); ?>
      </div>

    </div>
    <?php
      if( file_exists(drupal_get_path('module','epe_llb') . '/contents/exploration/dataset-tips.html') ) {
        $content = file_get_contents(drupal_get_path('module','epe_llb') . '/contents/exploration/dataset-tips.html');
        if($content):
    ?>
    <div class="span5 well">
    <?php echo $content; ?>
    </div>
    <?php endif; } ?>
  </div>


  <?php echo render($form['block_exploration_info']); ?>

<!--   <button type="button" class="btn btn-success" data-toggle="tab" data-target="explanation" onclick="jQuery('#llbnav li:eq(6) a').tab('show');">Next <i class="icon-chevron-right icon-white"></i></button> -->
</div> <!-- /#exploration -->

<div class="tab-pane" id="explanation">
  <h3>Guide Students Towards an Explanation</h3>
  <div class="row-fluid">
    <div class="span7">
      <p>This page is where the entire investigation comes together.  Students are asked to answer the research challnege by summarizing or synthesizing the datasets they have investigated.</p>
      <p>Note, your challenge will automatically be displayed on this page, so you do not need to include it again.</p>

      <p><strong>Summary Questions</strong></p>
      <p>Add one or more summary questions to guide students towards answering the challenge question using the datasets provided.</p>
      <div class="control-group">
        <?php echo render($form['field_inference_question']); ?>
      </div>

      <!--
      <p><strong>Extrapolation Questions</strong></p>
      <div class="control-group">
        <?php echo render($form['field_extrapolation_question']); ?>
      </div> -->

      <hr>
      <p><strong>Explanation Instructions</strong></p>
      <p>Add any additional instructions here to help students complete their assignment.</p>
      <div class="control-group">
        <?php echo render($form['field_explanation_content']); ?>
      </div>
    </div>

    <?php
      if( file_exists(drupal_get_path('module','epe_llb') . '/contents/explanation/scientific-practices.html') ) {
        $content = file_get_contents(drupal_get_path('module','epe_llb') . '/contents/explanation/scientific-practices.html');
        if($content):
    ?>
    <div class="span5 well">
    <?php echo $content; ?>
    </div>
    <?php endif; } ?>
  </div>

  <div class="clearfix"></div>
  <?php echo render($form['block_explanation_info']); ?>
<!--   <button type="button" class="btn btn-success" data-toggle="tab" data-target="notes" onclick="jQuery('#llbnav li:eq(8) a').tab('show');">Next <i class="icon-chevron-right icon-white"></i></button> -->
</div> <!-- /#explanation -->

<div class="tab-pane" id="notes">
  <h3>Instructor Notes</h3>
  <p>The fields on this page will become part of the Instructor Notes page.  If you do not intend to publish or share your investigation with other instructors than this page is optional.  However, if you do intend to share this investigation, completing this page will greatly assist others as they implement the investigation in their classroom.</p>

  <div class="control-group">
  <label class="control-label"><strong>Investigation Level</strong></label>
  <?php echo render($form['field_investigation_level']); ?>
  </div>

  <div class="control-group">
  <label class="control-label"><strong>Teaching Mode</strong></label>
  <?php echo render($form['field_teaching_mode']); ?>
  </div>

  <div class="control-group">
  <label class="control-label"><strong>Instructional Tips</strong></label>
  <?php echo render($form['field_instructional_content']); ?>
  </div>

  <div class="control-group">
  <label class="control-label"><strong>Preconceptions and Lecture Questions</strong></label>
  <?php echo render($form['field_preconception_content']); ?>
  </div>

  <div class="control-group">
  <label class="control-label"><strong>Additional Resources</strong></label>
  <?php echo render($form['field_resources_content']); ?>
  </div>

  <div class="control-group">
  <label class="control-label"><strong>Supporting Documents</strong></label>
  <p>If you have any additional documents that would help other professors implement this investigation in their classroom, please add them here.  This might include worksheets, answer keys, or additional readings. </p>
  <?php echo render($form['field_resource_file']); ?>
  </div>

  <div class="control-group">
  <label class="control-label"><strong>Supporting Documents</strong></label>
  <p>Please choose which type of supporting document you are adding</p>
  <?php echo render($form['field_resource_file_type']); ?>
  </div>

  <div class="control-group">
  <p>Please include a short description that describes what's included in the supporting document.</p>
  <?php echo render($form['field_resource_file_note']); ?>
  </div>

<!--   <button type="button" class="btn btn-success" data-toggle="tab" data-target="setup" onclick="jQuery('#llbnav li:eq(7) a').tab('show');">Next <i class="icon-chevron-right icon-white"></i></button> -->
</div> <!-- /#notes -->

<div class="tab-pane" id="setup">
  <h3>Cover Page</h3>
  <div class="row-fluid">
  <div class="span8">
    <label class="control-label" for="inputTitle"><strong>Investigation Title</strong></label>
    <p>Provide a descriptive and unique title for your investigation.</p>
    <?php echo render($form['title']); ?>
  </div>
  <?php
    if( file_exists(drupal_get_path('module','epe_llb') . '/contents/setup/title-example.html') ) {
      $content = file_get_contents(drupal_get_path('module','epe_llb') . '/contents/setup/title-example.html');
      if($content) {
        echo '<div class="span4 well">' . $content . '</div>';
      }
    }
  ?>
  </div>

  <div class="row-fluid">
    <label class="control-label"><strong>Investigation Description</strong></label>
    <p>Please provide a description of your investigation that includes the science concepts it covers and the goal you have for students who complete it.  If you publish your investigation to the public database, this description will help other educators find your investigation.</p>
    <?php echo render($form['body']); ?>
  </div>
  <hr>
  <div class="row-fluid">
    <label class="control-label"><strong>Investigation Keywords</strong></label>
    <?php echo render($form['field_resource_keywords']); ?>
  </div>
</div> <!-- /#setup -->

</div> <!-- /.tab-content -->
</div> <!-- /.tabbable -->

<!-- joe: adding hidden field for cancel -->
<?php if (empty($form['nid']['#value'])): ?>
  <input type="hidden" name="destination" value="llb/">
<?php else: ?>
  <input type="hidden" name="destination" value="node/<?php print $form['nid']['#value'] ?>">
<?php endif; ?>

<?php echo render($form['resource_browser_modal']); ?>

<?php echo render($form['options']['status']); ?>

<?php
  /* form identifier */
  echo render($form['form_build_id']);
  echo render($form['form_id']);
  echo render($form['form_token']);
  echo render($form['revision']);
  echo render($form['fragment']);
  echo render($form['field_source_nid']);
?>
