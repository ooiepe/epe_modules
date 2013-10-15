/*  *  *  *  *  *  *  *
*
* TOOL TEMPLATE
*
*/

(function (eduVis) {

    "use strict";
    //var tool = EduVis.tool.template;

    //console.log("tool template", tool);

    var tool = {

        "name" : "Template",
        "description" : "A Tool Template.",
        "url" : "??__url_to_tool_help_file__?",

        "version" : "0.0.1",
        "authors" : [
            {
                "name" : "Michael Mills",
                "association" : "Rutgers University",
                "url" : "http://marine.rutgers.edu/~mmills"
            }
        ],
        
        "resources" : {

            "scripts_local" : [],

            "scripts_external" : [
            	{
                    "name" : "d3",
                    "url" : "http://d3js.org/d3.v3.min.js",
                    "global_reference" : "d3"
                }

            ],

            "stylesheets_local" : [],

            "stylesheets_external" : [
                {
                    "name" : "jquery-ui",
                    "src" : "http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css"
                }
            ],

            "datasets" : [] // in case we being to support additional local resource files
            
        },

        "configuration" : {
        	"alertMessage" : "this is an Alert Message."
        },

        "controls" : {

            "alertMessage" : {

                "type" : "textbox",
                "label" : "Testing the Text Box",
                "tooltip": "What is a tooltip?",
                "default_value" : "This is a test",
                "description" : "this control is for testing the text box of template.js"
            }
        },
        "data" : {},
        "target_div" : "Template",
        "tools" : {}

    };

    tool.Template = function( _target ){

      	//document.getElementById(_target_div).innerHTML = "TEMPLATE TOOL LOADED";

      	alert(tool.configuration.alertMessage);

        EduVis.tool.load_complete(this);

    };

    tool.init = function() {

        // todo: include instance in call
        //console.log(" ... template init..... ", this)
        this.Template(this.dom_target);

    };

    // extend base object with tool..
    EduVis.tool.tools[tool.name] = tool;

}(EduVis));

