<?php angularjs_init_application('app'); ?>

<div class="form-help"><a href="<?php echo base_path() . "node/214" ?>" target="_blank">Help with this form</a></div>
<div class="tabbable">
<ul id="llbnav" class="nav nav-tabs">
  <li class="active"><a href="#instruction" data-toggle="tab" style="background-color:#ddddcc">Instructions</a></li>
  <li><a href="#objectives" data-toggle="tab" style="background-color:#ddddcc">Learning Objectives</a></li>
  <li><a href="#motivation" data-toggle="tab">Motivation</a></li>
  <li><a href="#background" data-toggle="tab">Background</a></li>
  <li><a href="#challenge" data-toggle="tab">Challenge</a></li>
  <li><a href="#exploration" data-toggle="tab">Exploration</a></li>
  <li><a href="#explanation" data-toggle="tab">Explanation</a></li>
  <li class="pull-right"><a href="#setup" data-toggle="tab">Setup</a></li>
  <li class="pull-right"><a href="#notes" data-toggle="tab">Instructor Notes</a></li>
</ul>

<div class="tab-content">

<div class="tab-pane active" id="instruction">
  <?php
    if(file_exists(drupal_get_path('module','epe_llb') . '/contents/instruction/instruction.html')) {
      $content = file_get_contents(drupal_get_path('module','epe_llb') . '/contents/instruction/instruction.html');
      if($content) {
        $dom = new domDocument;
        $dom->loadHTML($content);
        $images = $dom->getElementsByTagName('img');
        foreach($images as $img) {
          $content = str_replace($img->getAttribute('src'), base_path() . drupal_get_path('module','epe_llb') . '/contents/instruction/' . basename($img->getAttribute('src')), $content);
        }
        echo $content;
      }
    }
  ?>

  <div class="clearfix"></div>
  <button type="button" class="btn btn-success" onclick="jQuery('#llbnav li:eq(1) a').tab('show');">Next <i class="icon-chevron-right icon-white"></i></button>
</div> <!-- /#instruction -->

<div class="tab-pane" id="objectives">
  <?php echo render($form['block_objectives_info']); ?>
  <h3>Establish your Learning Objectives</h3>
  <div class="row-fluid">
    <div class="span7">
      <p>The first step to creating an effective investigation is to develop a Student Learning Objectives (SLO). The learning objective is essentially the goal of your activity.  SLOs typically answers the following questions:</p>
      <ul>
        <li>What science concept do you want your students to learn about?</li>
        <li>What content, context or dataset will they use to study this concept?</li>
        <li>What outcome do you hope they will achieve, that is, how will you assess their learning?</li>
      </ul>

      <p>By specifying your learning objective up front, you will be able to focus your investigation on those elements that students need to accomplish your specific goal.</p>

      <p><em>Identify a learning objective you would like your students to investigate in this investigation.</em></p>
      <div class="control-group"><?php echo render($form['field_student_objectives']); ?></div>

      <p>Don't worry about perfecting this right away, you can always come back and adjust it later.</p>

      <p>As you develop your investigation, the datasets and questions you include should support the goal(s) you identified.  If they don't, you probably don't need to include them in this exercise (otherwise, you should rewrite your objective).  If you find that you have additional content you would like students to investigate that goes beyond your specified goal, you could consider creating another activity with a more advanced objective.</p>
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

  <button type="button" class="btn btn-success" onclick="jQuery('#llbnav li:eq(2) a').tab('show');">Next <i class="icon-chevron-right icon-white"></i></button>
</div> <!-- /#goal -->

<div class="tab-pane" id="motivation">
  <?php echo render($form['block_introduction_info']); ?>
  <h3>Provide a Motivating Context</h3>
  <div class="row-fluid">
    <div class="span6">
      <p>Why should students care about this investigation?  Why is this topic important?  How is this investigation relevant to students' lives?</p>
      <p>Students learn best when they are engaged in a topic.  It's important to start your activity with a motivating context or story that spurs their interest in the content or helps them understand its relevance toward a larger societal goal.  You can use the slideshow and text on this page to tell a "story" behind the investigation.</p>
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
      <p>Choose one or more images that help explain the story behind this investigation.  You can provide a caption for each image.</p>
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
            </div>
          </td>
        </tr>
        </tbody>
      </table>

      <?php echo render($form['intro_slideshow_button']); ?>
    </div>
  </div>

  <button type="button" class="btn btn-success" onclick="jQuery('#llbnav li:eq(3) a').tab('show');">Next <i class="icon-chevron-right icon-white"></i></button>
</div> <!-- /#intro -->

<div class="tab-pane" id="background">
  <?php echo render($form['block_background_info']); ?>
  <h3>Provide Background Content</h3>
  <div class="row-fluid">
    <div class="span6">
      <p>Before beginning this investigation, what information should students know about or review?  Use the following box to provide any background information you would like students to know.
      <div class="control-group">
        <label class="control-label" for="inputTitle"><em>Enter the text you would like to appear on this page.</em></label>
        <div class="controls">
          <?php echo render($form['field_background_content']); ?>
        </div>
      </div>

      <p>You may include html links in your text, if you wish to provide students with supplementary information.</p>
      <p>Some suggested topics include:</p>
      <ul>
        <li>Information about a scientific concept or process</li>
        <li>Details on where or how a dataset was collected or how an instrument collects and processes data</li>
        <li>Background information about an event, study area or phenomena students will be studying</li>
      </ul>
    </div>

    <div class="span6 background-slideshow">
      <p><strong>Slideshow</strong></p>
      <p>Choose one or more images that will help provide background information on this investigation.  You can provide a caption for each image.</p>
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
      <p>Before beginning an investigation, students should reflect on their current knowledge.  Generally, information that students need to know to complete an investigation should be provided in the investigation or via prior activities or lectures.  The questions you ask here should &quot;wet their appetite&quot; for the subject at hand, helping them understand the relevance of the topic to other subjects they may have already studied or know about.</p>

      <p>Enter one or more questions you would like students to think about before starting the investigation.</p>
      <div class="control-group">
        <?php echo render($form['field_background_question']); ?>
      </div>
    </div>
    <div class="span5 well">
    <p><strong>Question Tips</strong></p>
    <p>The view in contemporary learning theory is that people construct new knowledge and understanding based on what they already know and believe.  This is why it is a good idea to ask students up front about content they should already know about to check their knowledge level.  These questions can also be used to establish the current thought processes students use, which can then be compared with any gains or changes in their knowledge after they complete an exercise.  Identifying changes in student thought processes can help you distinguish between the concepts they understand and those they need more guidance on.</p>
    </div>
  </div>

  <button type="button" class="btn btn-success" onclick="jQuery('#llbnav li:eq(4) a').tab('show');">Next <i class="icon-chevron-right icon-white"></i></button>
</div> <!-- /#background -->

<div class="tab-pane" id="challenge">
  <?php echo render($form['block_challenge_info']); ?>
  <h3>Create a Challenge</h3>
  <div class="row-fluid">
    <div class="span6">
      <p>Before this step, hopefully you drafted your learning objective and identified some key datasets you would like students to use in this investigation.  With those ideas in mind, you can now identify the research challenge you wish your students to pursue.</p>
      <p><em>Choose one of the following scientific practices you would like students to practice:</em></p>
      <div class="control-group">
        <?php echo render($form['field_desired_assessment']); ?>
      </div>
    </div>
    <div class="span6">
      <p><strong>Challenge Image</strong></p>
      <p>Choose an image that you feel represents this investigation.  Note, this image will also be used as the thumbnail for your investigation.</p>

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
      <p><strong>Challenge Question</strong></p>
      <p><em>Based on your selection above, construct a challenge question for students to investigate and enter it here:</em></p>
      <div class="control-group">
        <?php echo render($form['field_challenge_content']); ?>
      </div>
      <p>The challenge question should ask students to analyze the provided datasets to meet the goal you selected above.  For a more straightforward task, the challenge could be a specific research question.  Or for a more complex exercise, it could ask students to develop and investigate their own question or identify and explain a relationship they see in the data.</p>
      <p>The challenge question should connect your learning objective with the applied skills you hope wish your students to develop.</p>
    </div>
    <div class="span5 well">
      <p><strong>Example Challenge Questions</strong></p>
      <p>We suggest construction your question based on one of the following templates, which are based on typical science practices:</p>
      <ul>
        <li>Develop a conceptual model to explain...</li>
        <li>Analyze data from... to identify or explain...</li>
        <li>Construct an explanation using the data provided that describes...</li>
        <li>Investigate the data from... and develop your own question about the dataset, and explain it as best you can.</li>
      </ul>
    </div>
  </div>

  <button type="button" class="btn btn-success" onclick="jQuery('#llbnav li:eq(5) a').tab('show');">Next <i class="icon-chevron-right icon-white"></i></button>
</div> <!-- /#challenge -->

<div class="tab-pane" id="exploration">
  <?php echo render($form['block_exploration_info']); ?>
  <h3>Identify Datasets to Explore</h3>
  <div class="row-fluid">
    <div class="span6">
      <p>Use the interface below to add one or more datasets to your investigation.  Datasets can include visualizations, concept maps, images, videos or documents like PDF or Excel files.</p>
      <p>For each dataset, add a short description and a few questions that will spur students to investigate important details.  The description might include background information on the dataset, where it came from, or how to understand what is being shown.  The questions should guide students in interpreting what is shown, and how it is relevant to the larger question.  Each dataset should assist students in addressing the challenge question, and can be considered as one step in a larger investigative procedure. </p>
    </div>
    <div class="span6 well">
      <p><strong>How do I prepare each dataset?</strong></p>
      <p>This tool is designed to create exercises that are inquiry driven.  By presenting students with a challenge question and a number of datasets to investigate, they are in effect building their science skills by analyzing and interpreting data, constructing explanations or building models.</p>
      <p>Students will use the provided datasets to help them investigate the challenge question you pose to them.  Each dataset can be considered a piece of evidence that can be pieced together to address the larger challenge question they are researching.</p>
    </div>
  </div>

  <div class="field-container control-group">
    <?php echo render($form['field_exploration_dataset']); ?>

    <div ng-show="currentCopies.keys.length > 0" class="control-group text-warning">
      <table class="table">
        <tr class="warning"><td>All changes are temporary.</td></tr>
      </table>
    </div>

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
          </div>
        </td>
        <td>
          <div ng-show="fn.inItemEditArray(item.key)">
            <textarea name="body" cols="70" rows="10" ng-model="currentCopies.items[item.key].body"></textarea>
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



  <button type="button" class="btn btn-success" onclick="jQuery('#llbnav li:eq(6) a').tab('show');">Next <i class="icon-chevron-right icon-white"></i></button>
</div> <!-- /#exploration -->

<div class="tab-pane" id="explanation">
  <?php echo render($form['block_explanation_info']); ?>
  <h3>Explanation Guidance</h3>
  <div class="row-fluid">
    <div class="span7">
      <p>This page is where the entire investigation comes together.  Students are asked to answer the Challenge Question by summarizing or synthesizing the datasets they have investigated.</p>
      <p>Note, the challenge question will automatically be displayed on this page, so you do not need to include it again.</p>

      <p><strong>Summary Questions</strong></p>
      <p>Add one or more summary questions that guide students towards answering the challenge question using the datasets provided.</p>
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
  <button type="button" class="btn btn-success" onclick="jQuery('#llbnav li:eq(8) a').tab('show');">Next <i class="icon-chevron-right icon-white"></i></button>
</div> <!-- /#explanation -->

<div class="tab-pane" id="notes">
  <h3>Instructor Notes</h3>
  <p>The fields on this page will become part of the Instructor Notes page.  If you do not intend to publish or share your investigation with other instructors than this page is optional.  However, if you do intend to share this investigation, completing this page will greatly assist others in implementing the activity in their classroom.</p>

  <div class="control-group">
  <label class="control-label" for="inputTitle"><strong>Instructional Tips</strong></label>
  <?php echo render($form['field_instructional_content']); ?>
  </div>

  <div class="control-group">
  <label class="control-label" for="inputTitle"><strong>Preconceptions and Lecture Questions</strong></label>
  <?php echo render($form['field_preconception_content']); ?>
  </div>

  <div class="control-group">
  <label class="control-label" for="inputTitle"><strong>Resources</strong></label>
  <?php echo render($form['field_resources_content']); ?>
  </div>

  <button type="button" class="btn btn-success" onclick="jQuery('#llbnav li:eq(7) a').tab('show');">Next <i class="icon-chevron-right icon-white"></i></button>
</div> <!-- /#notes -->

<div class="tab-pane" id="setup">
  <h3>Setup</h3>
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
    <label class="control-label" for="inputTitle"><strong>Investigation Description</strong></label>
    <p>Please provide a description of your investigation that includes the science concepts it covers and the goal you have for students who complete it.  If you publish your investigation to the public database, this description will help other educators find your activity and determine if it is useful to them.</p>
    <?php echo render($form['body']); ?>
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

<?php echo render($form['actions']); ?>

<?php
  /* form identifier */
  echo render($form['form_build_id']);
  echo render($form['form_id']);
  echo render($form['form_token']);
?>
