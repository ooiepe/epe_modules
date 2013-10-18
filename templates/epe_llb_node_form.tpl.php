<?php angularjs_init_application('app'); ?>

<div class="tabbable">
<ul id="llbnav" class="nav nav-tabs">
  <li class="active"><a href="#instruction" data-toggle="tab" style="background-color:#ddddcc">Instructions</a></li>
  <li><a href="#goal" data-toggle="tab" style="background-color:#ddddcc">Content Goals</a></li>
  <li><a href="#intro" data-toggle="tab">Introduction</a></li>
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
      $dom = new domDocument;
      $dom->loadHTML($content);
      $images = $dom->getElementsByTagName('img');
      foreach($images as $img) {
        $content = str_replace($img->getAttribute('src'), base_path() . drupal_get_path('module','epe_llb') . '/contents/instruction/' . basename($img->getAttribute('src')), $content);
      }
      echo $content;
    }
  ?>

  <div class="clearfix"></div>
  <button type="button" class="btn btn-success" onclick="jQuery('#llbnav li:eq(1) a').tab('show');">Next <i class="icon-chevron-right icon-white"></i></button>
</div> <!-- /#instruction -->

<div class="tab-pane" id="goal">
  <h3>Establish your Content Goals</h3>
  <p>Let's get started. Before we delve into creating your investigation, take a moment to think about the science concepts you would like your students to investigate in this activity</p>

  <div class="row-fluid">
    <div class="span7">
      <p>Come up with between 1 to 3 science content goals that address what ideas or processes would you like students to learn about and how those ideas relate to larger ideas.</p>
      <div class="control-group"><?php echo render($form['field_content_goals']); ?></div>

      <p>Establishing science content goals up front will help you keep focus as you develop your activity. The datasets you include and the questions you ask students to think about should support the goals you identified. If you find that you have additional content you wish students to review that go beyond these goals, you might consider creating a separate activity to keep the investigations focused.</p>
      <p>Don't worry about perfecting this right away, you can always come back and adjust them later.</p>
      <p>If you have any specific learning objectives you wish to cover, you can enter them here for your reference.</p>
      <div class="control-group"><?php echo render($form['field_student_objectives']); ?></div>
    </div>

    <div class="span5 well">
    <?php
      if( file_exists(drupal_get_path('module','epe_llb') . '/contents/goals/goals-example.html') ) {
        echo file_get_contents(drupal_get_path('module','epe_llb') . '/contents/goals/goals-example.html');
      }
    ?>
    </div>
  </div>

  <button type="button" class="btn btn-success" onclick="jQuery('#llbnav li:eq(2) a').tab('show');">Next <i class="icon-chevron-right icon-white"></i></button>
</div> <!-- /#goal -->

<div class="tab-pane" id="intro">
  <?php echo render($form['block_introduction_info']); ?>
  <div class="row-fluid">
    <div class="span6">
      <div class="control-group">
        <label class="control-label" for="inputTitle"><strong>Enter the text you would like to appear on this page.</strong></label>
        <div class="controls">
          <?php echo render($form['field_introductory_content']); ?>
        </div>
      </div>
    </div>

    <div class="span6">
      <p><strong>Introductory Slideshow</strong></p>
      <?php echo render($form['field_introductory_slideshow']); ?>
    </div>
  </div>

  <button type="button" class="btn btn-success" onclick="jQuery('#llbnav li:eq(3) a').tab('show');">Next <i class="icon-chevron-right icon-white"></i></button>
</div> <!-- /#intro -->

<div class="tab-pane" id="background">
  <?php echo render($form['block_background_info']); ?>
  <div class="row-fluid">
    <div class="span6">
      <div class="control-group">
        <label class="control-label" for="inputTitle"><strong>Enter the text you would like to appear on this page.</strong></label>
        <div class="controls">
          <?php echo render($form['field_background_content']); ?>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="inputTitle"><strong>Question(s)</strong></label>
        <?php echo render($form['field_background_question']); ?>
      </div>
    </div>

    <div class="span6">
      <p><strong>Slideshow (or single image?)</strong></p>
      <?php echo render($form['field_background_slideshow']); ?>
    </div>
  </div>

  <button type="button" class="btn btn-success" onclick="jQuery('#llbnav li:eq(4) a').tab('show');">Next <i class="icon-chevron-right icon-white"></i></button>
</div> <!-- /#background -->

<div class="tab-pane" id="challenge">
  <?php echo render($form['block_challenge_info']); ?>
  <div class="row-fluid">
    <div class="span6">
      <p class="text-success">In this activity you will investigate the following challenge:</p>
      <div class="control-group">
        <?php echo render($form['field_challenge_content']); ?>
      </div>
    </div>

    <div class="span6">
      <p><strong>Image</strong></p>
      <?php echo render($form['field_challenge_thumbnail']); ?>
    </div>
  </div>

  <button type="button" class="btn btn-success" onclick="jQuery('#llbnav li:eq(5) a').tab('show');">Next <i class="icon-chevron-right icon-white"></i></button>
</div> <!-- /#challenge -->

<div class="tab-pane" id="exploration">
  <?php echo render($form['block_exploration_info']); ?>
  <div class="field-container control-group">
    <?php echo render($form['field_exploration_dataset']); ?>

    <table class="table table-condensed">
      <tr>
        <th width="20%">Dataset</th>
        <th width="40%">Dataset Description</th>
        <th width="40%">Investigation Questions</th>
      </tr>
      <tr ng-repeat="item in items">
        <td>
          <img ng-src="{{item.thumbnail}}">
          <div ng-show="fn.inItemEditArray(item.nid)">
            <input type="text" name="title" ng-model="currentCopies.items[item.nid].title" size="30">
            <br/>
            <button type="button" class="btn btn-small" ng-click="fn.cancelItemEdit(item.nid);">Cancel</button>
            <button type="button" class="btn btn-small btn-primary" ng-click="fn.saveEditItem(item.nid);">Save</button>
          </div>
          <div ng-show="!fn.inItemEditArray(item.nid)">
            <p>{{item.title}}</p>
            <div><a ng-click="fn.editItem($index);"><i class="icon-edit"></i>&nbsp;Edit</a><i class="icon-trash" ng-click="removeDataSet($index);"></i></div>
          </div>
        </td>
        <td>
          <div ng-show="fn.inItemEditArray(item.nid)">
            <textarea name="body" cols="70" rows="10" ng-model="currentCopies.items[item.nid].body"></textarea>
          </div>
          <div ng-show="!fn.inItemEditArray(item.nid)">
            <div ng-bind-html="item.body" class="item body"></div>
          </div>
        </td>
        <td>
          <ul>
            <div ng-show="!fn.inItemEditArray(item.nid)">
            <li ng-repeat="question in item.questions">
              {{question.text}}
            </li>
            </div>
            <div ng-show="fn.inItemEditArray(item.nid)">
              <li ng-repeat="question in currentCopies.items[item.nid].questions">
                <textarea name="question" rows="2" cols="40" ng-model="question.text"></textarea><span><i class="icon-trash" ng-click="fn.removeItemQuestion(item.nid, $index);"></i></span>
              </li>
            </div>
          </ul>
          <div ng-show="fn.inItemEditArray(item.nid)">
          <button type="button" class="btn btn-small btn-primary" ng-click="fn.addQuestion(item.nid);">Add Question</button>
          </div>
        </td>
      </tr>
    </table>

    <p><strong>Add another Dataset:</strong></p>
    <?php echo render($form['resource_browser']); ?>
  </div>

  <div class="control-group">
  <label class="control-label" for="inputTitle"><strong>Guidance Text</strong></label>
  <?php echo render($form['field_guidance_content']); ?>
  </div>

  <div class="control-group">
  <?php
    if(file_exists(drupal_get_path('module','epe_llb') . '/contents/exploration/guidance-text.html')) {
      echo file_get_contents(drupal_get_path('module','epe_llb') . '/contents/exploration/guidance-text.html');
    }
  ?>
  </div>

  <button type="button" class="btn btn-success" onclick="jQuery('#llbnav li:eq(6) a').tab('show');">Next <i class="icon-chevron-right icon-white"></i></button>
</div> <!-- /#exploration -->

<div class="tab-pane" id="explanation">
  <?php echo render($form['block_explanation_info']); ?>
  <div class="field-container control-group row-fluid">
  <div class="span8">

    <p>Recall that the research question you are trying to address is:</p>
    <p>Analyze data from observations and models to identify possible relationships between hurricanes and the ocean.</p>
    <p>As you take into account the data you just viewed, consider the following Inference Questions.</p>
    <p>Add one or more summary questions that requires students to make inferences from the data.</p>

    <?php echo render($form['field_inference_question']); ?>
  </div>
  <div class="span4">
    <?php
      if(file_exists(drupal_get_path('module','epe_llb') . '/contents/explanation/inference-questions-example.html')) {
        echo file_get_contents(drupal_get_path('module','epe_llb') . '/contents/explanation/inference-questions-example.html');
      }
    ?>
  </div>
  </div>

  <div class="field-container control-group row-fluid">
  <div class="span8">

    <p>Thinking deeper, consider the following Extrapolation Questions.</p>
    <p>Add one or more extrapolation questions that suggest generalization or implications based on the investigated data.</p>

    <?php echo render($form['field_extrapolation_question']); ?>
  </div>

  <div class="span4">
    <?php
      if( file_exists(drupal_get_path('module','epe_llb') . '/contents/explanation/extrapolation-questions-example.html') ) {
        echo file_get_contents(drupal_get_path('module','epe_llb') . '/contents/explanation/extrapolation-questions-example.html');
      }
    ?>
  </div>
  </div>

  <div class="clearfix"></div>
  <button type="button" class="btn btn-success" onclick="jQuery('#llbnav li:eq(8) a').tab('show');">Next <i class="icon-chevron-right icon-white"></i></button>
</div> <!-- /#explanation -->

<div class="tab-pane" id="notes">
  <div class="control-group">
  <label class="control-label" for="inputTitle"><strong>Instructional Tips</strong></label>
  <?php echo render($form['field_instructional_content']); ?>
  </div>

  <div class="control-group">
  <label class="control-label" for="inputTitle"><strong>Preconceptions</strong></label>
  <?php echo render($form['field_preconception_content']); ?>
  </div>

  <div class="control-group">
  <label class="control-label" for="inputTitle"><strong>Resources</strong></label>
  <?php echo render($form['field_resources_content']); ?>
  </div>

  <button type="button" class="btn btn-success" onclick="jQuery('#llbnav li:eq(7) a').tab('show');">Next <i class="icon-chevron-right icon-white"></i></button>
</div> <!-- /#notes -->

<div class="tab-pane" id="setup">
  <div class="row-fluid">
  <div class="span8">
  <label class="control-label" for="inputTitle"><strong>Activity Title</strong></label>
  <?php echo render($form['title']); ?>
  </div>
  <div class="span4 well">
    <?php
      if( file_exists(drupal_get_path('module','epe_llb') . '/contents/setup/title-example.html') ) {
        echo file_get_contents(drupal_get_path('module','epe_llb') . '/contents/setup/title-example.html');
      }
    ?>
  </div>
  </div>

  <div class="row-fluid">
  <label class="control-label" for="inputTitle"><strong>Activity Description</strong></label>
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




<?php echo render($form['actions']); ?>

<?php
  /* form identifier */
  echo render($form['form_build_id']);
  echo render($form['form_id']);
  echo render($form['form_token']);
?>
