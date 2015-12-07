/* find anchors:

n createMap()
n createConcepts()
n createPhrases()
n createTitle
n conceptClick
n createForks()
n createLines()
n calculateDegree
n convertHex

UTILITIES
n hexToR
n hexToG
n hexToB
function cutHex
*/


var background, green;
var allconcepts = [];
var mousexy = [0,0];
var vbxTemp = 0;
var vbyTemp = 0;
var greenxy = [0,0];

var set;
var current_position = [0,0];
var arrows = [];

function createMap() {
    //mapcoords[0]
    console.log( "width mapcoords[2] = "+mapcoords[2] );
    console.log( "height mapcoords[3] = "+mapcoords[3] );
    background = paper.rect(xoffset+mapcoords[0]-(600), yoffset+mapcoords[1]-(600), mapcoords[2]-(mapcoords[0])+(1200), mapcoords[3]-(mapcoords[1])+(1200), 10).attr({fill: "#fff", stroke: "none"});
    
    green = paper.rect(xoffset+mapcoords[0]-(600), yoffset+mapcoords[1]-(600), mapcoords[2]-(mapcoords[0])+(1200), mapcoords[3]-(mapcoords[1])+(1200)).attr({fill: "#fff", stroke: "none"});
    
    green.drag(
        function(dx, dy, x, y, e) {
            this.data('myset').transform("T" + (this.data("position")[0] + dx) + "," + (this.data("position")[1] + dy));
            current_position = [dx,dy];
            
            for ( var a = 0; a < arrows.length; a++ ){
                arrows[a].transform("T"+(arrows[a].data("position")[0] + dx)+","+(arrows[a].data("position")[1] + dy)+"r"+(arrows[a].data("position")[2]));
            };
            
        },
        function(x, y, e) {
            console.log( "green x = "+green.attr("x") );
        },
        function(e) {
            this.data('myset').data("position", [
                this.data("position")[0] += current_position[0],
                this.data("position")[1] += current_position[1]
            ]);
            
            for ( var a = 0; a < arrows.length; a++ ){
                arrows[a].data("position")[0] += current_position[0];
                arrows[a].data("position")[1] += current_position[1];
            };
        }
        
    );
    
    cmx = parseInt($map.find('conceptMap').attr('cmx'));
    cmy = parseInt($map.find('conceptMap').attr('cmy'));
    
    set = paper.set();
    arrows = [];
    blockLineArray = [];
    blockTitleArray = [];
    hasTitles = 0;
    
    createConcepts();
    createLines();
    createForks();
    createPhrases();
    
    set.push(green);
    set.push(allconcepts);
    set.data("myset", set);
    set.data("position", [0,0]);
    
    createColorBlocks();
    //createArrows();

};

function blockTitles(blockid){
    //console.log("blockid = "+blockid);
    if ( blockid == "hide"){
        
        if ( hasTitles ){
            
            blockLineArray[0].attr("x", 15);
            blockLineArray[1].attr("x", 15);
            blockLineArray[2].attr("x", 15);
            blockLineArray[3].show();
            blockLineArray[4].show();
            blockLineArray[5].show();
            
            hideTitlesButton.node.id = "show";
            
        };
        
        blockPaper.setSize(50,blocksHeight);
        blockbackground.attr("width", 38);
        
        for (i=0; i<blockTitleArray.length; i++){
            blockTitleArray[i].hide();
        };
        
        
        blockTitlesState = "show";
        
    } else if ( blockid == "show"){
        
        if ( hasTitles ){
            
            blockLineArray[0].attr("x", 19);
            blockLineArray[1].attr("x", 19);
            blockLineArray[2].attr("x", 19);
            blockLineArray[3].hide();
            blockLineArray[4].hide();
            blockLineArray[5].hide();
            
            hideTitlesButton.node.id = "hide";
            
        };
        
        blockPaper.setSize(200,blocksHeight);
        blockbackground.attr("width", 198);
        
        for (i=0; i<blockTitleArray.length; i++){
            blockTitleArray[i].show();
        };
        
        blockTitlesState = "hide";
        
    } else {
        console.log( "blockid not properly set:" );
        console.log( "blockid = "+blockid );
    };
};

var blocksHeight = 0;
var blockbackground;
var blockLineArray = [];
var blockTitleArray = [];
var hideTitlesButton;
var blockTitlesState = "show";
var hasTitles = 0;

function createColorBlocks() {
    var y,h,btnh;
    
    blockbackground = blockPaper.rect(1, 1, 38, 300);
    
    gradient = '90-#dfdfdf-#fff';
    
    // baseline gradient fill;
    blockbackground.attr("fill",  gradient);
    
    hasTitles = 0;
    
    $map.find('colorIndex').find('color').each(function() {
        var hasTitleNode = $(this).find('title').length > 0 ? true : false;
        
        if ( hasTitleNode ){
            if ( $(this).find('title').text() != "" ){
                hasTitles++;
            };
        };
    });
    
    // remains 10 unless there are titles;
    // used below to determine the y position of the color blocks.
    btnh = 10;
    
    if ( hasTitles ){
        // titles exist, so add 40 to the h for the y position of the color blocks to accommodate a button;
        btnh = 40;

        topbkgd = blockPaper.rect(10, 10, 20, 10);
        topbkgd.attr("stroke-opacity", 0);
        topbkgd.attr("fill",  "#f4f4f4");
        botbkgd = blockPaper.rect(10, 20, 20, 10);
        botbkgd.attr("stroke-opacity", 0);
        botbkgd.attr("fill",  "#dfdfdf");

        //999999 line
        //f4f4f4 top background
        //dfdfdf bottom background
        //00cc00 green
        //ff0000 red
        //0066ff blue

        blockLineArray.push(blockPaper.rect((blockTitlesState == "show" ? 15 : 19), 14, 2, 2));
        blockLineArray.push(blockPaper.rect((blockTitlesState == "show" ? 15 : 19), 19, 2, 2));
        blockLineArray.push(blockPaper.rect((blockTitlesState == "show" ? 15 : 19), 24, 2, 2));

        blockLineArray[0].attr("stroke",  "#00cc00");
        blockLineArray[1].attr("stroke",  "#ff0000");
        blockLineArray[2].attr("stroke",  "#0066ff");

        blockLineArray.push(blockPaper.path(['M', 20, 15, 26, 15]));
        blockLineArray.push(blockPaper.path(['M', 20, 20, 26, 20]));
        blockLineArray.push(blockPaper.path(['M', 20, 25, 26, 25]));

        if ( blockTitlesState == "hide" ) {
            blockLineArray[3].hide();
            blockLineArray[4].hide();
            blockLineArray[5].hide();
        };

        hideTitlesButton = blockPaper.rect(10, 10, 20, 20);
        hideTitlesButton.attr("fill",  "#CCCCCC");
        hideTitlesButton.attr("stroke",  "#999999");
        hideTitlesButton.attr("stroke-width", 2);
        hideTitlesButton.attr("fill-opacity", .1);
        hideTitlesButton.node.id = blockTitlesState;
        hideTitlesButton.node.onclick = function() {
            blockTitles(hideTitlesButton.node.id);
        };
        
    } else {
        
        blockTitlesState = "show";
        
    };
    
    
    inc = 0;
    
    console.log("colors: "+$map.find('colorIndex').find('color').length);
    
    $map.find('colorIndex').find('color').each(function() {

        //console.log( inc );
        
        $color = $(this);

        // ********************* ;
        // SET THE VARIABLES TO BE USED FOR THE POSITION AND SIZE;
        // ********************* ;
        h = 20;
        w = 20;
        
        x = 10;
        // btnh comes from above, where we're checking if there are any block titles;
        // if there are none, we eliminate the button since it's useless.
        // that then would mean the color blocks would move up;
        y = btnh+(Math.floor(h+(h/2))*inc);
        
        // ********************* ;
        // PARSE OUT TEXT PARAMETERS;
        // ********************* ;
        //txtstring = $(this).find('content').find('title').text();
        //txtfont = $(this).find('content').find('font').text();
        //txtcolorhex = $(this).find('content').find('hex').text();
        //txtsize = parseInt($(this).find('content').find('size').text());

        // ********************* ;
        // PARSE OUT BACKGROUND PARAMETERS;
        // ********************* ;
        bgcolorhex = convertHex( $(this).find('hex').text() );
        
        // ********************* ;
        // PARSE OUT LINE PARAMETERS;
        // ********************* ;
        lncolorhex = "#000000";
        
        var colorButton;
        //                       x  y  w  h;
        colorButton = blockPaper.rect(x, y, w, h);
        
        // put this on top of the stack as the button;
        colorButton.attr("fill",  bgcolorhex);
        colorButton.attr("fill-opacity", 1);
        colorButton.attr("stroke-width", 2);
        colorButton.attr("stroke-opacity", 1);
        colorButton.attr("stroke", "#000000");
        colorButton.node.id = bgcolorhex;
        colorButton.node.onclick = function() {
            colorClick(colorButton.node.id);
        }
        colorButton.node.onmouseover = function() {
            //console.log( "over" );
            //btnOverlay.attr("stroke-width", 4);

        }
        colorButton.node.onmouseout = function() {
            //console.log( "out" );
            //btnOverlay.attr("stroke-width", 1);

        }
        
        var hasTitleNode = $(this).find('title').length > 0 ? true : false;
        
        if ( hasTitleNode ){
            if ( $(this).find('title').text() != "" ){
                text = blockPaper.text( (x + w + 10) , (y + 12) , ($(this).find('title').text()) ).
                attr({
                    "text-anchor": "start",
                    "font-family": "Arial",
                    "font-size": (size+"px"), 
                    "font-weight": font.indexOf("bold") <= 0 ? "bold" : "normal",
                    "font-style": font.indexOf("italic") <= 0 ? "italic" : "normal",
                    fill: hex
                    //stroke:"brown",
                    //"stroke-width": "3px"
                });
                
                blockTitleArray.push(text);
            };
        };
        
        //createTitle((x+(isCircle ? 0 : (w/2))),(y+(isCircle ? 0 : (h/2))),w,h,txtstring,txtfont,txtcolorhex,txtsize);
        //console.log( "x = "+x+", y ="+y );
        colorButton.toFront();
        
        inc++;
    });
    
    blocksHeight = (y+h+10);
    blockbackground.attr("height", blocksHeight-2);
    
    blockTitles(blockTitlesState == "show" ? "hide" : "show");
    
    
    //blockbackground.attr("width", (blockTitlesState == "show" ? 38 : 198));
    //blockPaper.setSize(300,blocksHeight);
};

function createConcepts() {
    //inc = 0;
    $map.find('concept').each(function() {

        //console.log( inc );
        //inc++;

        $concept = $(this);



        // ********************* ;
        // SET THE VARIABLES TO BE USED FOR THE POSITION AND SIZE;
        // ********************* ;
        h = parseInt($(this).attr('h'));
        w = parseInt($(this).attr('w'));

        shape = $(this).find('params').find('shape').text();
        isCircle = false;
        if (shape == "circle" && h == w){
            isCircle = true;
        }

        x = xoffset+parseInt($(this).attr('x'))+(isCircle ? (w/2) : 0);
        y = yoffset+parseInt($(this).attr('y'))+(isCircle ? (h/2) : 0);


        // ********************* ;
        // PARSE OUT TEXT PARAMETERS;
        // ********************* ;
        txtstring = $(this).find('content').find('title').text();
        txtfont = $(this).find('content').find('font').text();
        txtcolorhex = $(this).find('content').find('hex').text();
        txtsize = parseInt($(this).find('content').find('size').text());

        // ********************* ;
        // PARSE OUT BACKGROUND PARAMETERS;
        // ********************* ;
        bgalpha = ($(this).find('bkgd').find('opacity').text());
        
        bgcolorhex = convertHex( $(this).find('bkgd').find('hex').text() );
        
        //bgcolor = $(this).find('bkgd').find('hex').text();
        //bgcolorhex = bgcolor == "0" ? "#000000" : ("#" + parseInt(bgcolor).toString(16));
        //if ( bgcolorhex.length < 7 ){
        //    bgcolorhex = bgcolorhex.split("#").join("#0");
        //}

        //console.log( "bgcolorhex = "+bgcolorhex );

        //console.log( "bgalpha = "+(bgalpha*.01) );

        // ********************* ;
        // PARSE OUT LINE PARAMETERS;
        // ********************* ;
        lnalpha = (($(this).find('line').find('opacity').text())*01);
        lnthick = parseInt($(this).find('line').find('thick').text());
        
        lncolorhex = convertHex( $(this).find('line').find('hex').text() );
        //lncolor = $(this).find('line').find('hex').text();
        //lncolorhex = lncolor == "0" ? "#000000" : ("#" + parseInt(lncolor).toString(16));
        //if ( lncolorhex.length < 7 ){
        //    lncolorhex = lncolorhex.split("#").join("#0");
        //}

        //console.log( "lncolorhex = "+lncolorhex );

        // ********************* ;
        // CONVERSION TO R G B -- NOT USED YET, BUT IT WORKSâ€¦;
        // ********************* ;
        R = hexToR(bgcolorhex);
        G = hexToG(bgcolorhex);
        B = hexToB(bgcolorhex);

        var thisConcept, filloverlay, btnOverlay;

        if ( shape == "circle" && h == w ) {
            thisConcept = paper.circle(x, y, (h/2));
            filloverlay = paper.circle(x, y, (h/2));
            btnOverlay = paper.circle(x, y, (h/2));
        } else if ( shape == "circle" && h != w ) {
            // rectangle with rounded corners;
            //                       x  y  w  h   r;
            thisConcept = paper.rect(x, y, w, h, (h/2));
            filloverlay = paper.rect(x, y, w, h, (h/2));
            btnOverlay = paper.rect(x, y, w, h, (h/2));
         } else if ( shape == "square" ) {
            // rectangle;
            //                       x  y  w  h;
            thisConcept = paper.rect(x, y, w, h);
            filloverlay = paper.rect(x, y, w, h);
            btnOverlay = paper.rect(x, y, w, h);
         }
        // circle is height/width the same, square is rect, pill is rect h/w different;
        
        set.push(thisConcept,filloverlay,btnOverlay);
        
        // Sets the fill attribute of the circle to red (#f00);
        //gradient = '90-'+bgcolorhex+':'+bgalpha+'-#fff:'+bgalpha+'-'+bgcolorhex+':'+bgalpha;
        gradient = '90-'+bgcolorhex+'-#fff-'+bgcolorhex;

        // baseline gradient fill;
        thisConcept.attr("fill",  gradient);
        thisConcept.attr("stroke-opacity", 0);

        // apply the opacity to a white fill;
        filloverlay.attr("fill",  "#fff");
        filloverlay.attr("fill-opacity", (1-(bgalpha*.01)));
        filloverlay.attr("stroke-opacity", 0);

        // put this on top of the stack as the button;
        btnOverlay.attr("fill",  "#fff");
        btnOverlay.attr("fill-opacity", .1);
        btnOverlay.attr("stroke-width", lnthick);
        btnOverlay.attr("stroke-opacity", lnalpha);
        btnOverlay.attr("stroke", lncolorhex);
        btnOverlay.node.id = $(this).find('params').find('uid').text();
        btnOverlay.node.onclick = function() {
            conceptClick(btnOverlay.node.id);
        }
        btnOverlay.node.onmouseover = function() {
            //console.log( "over" );
            //btnOverlay.attr("stroke-width", 4);

        }
        btnOverlay.node.onmouseout = function() {
            //console.log( "out" );
            //btnOverlay.attr("stroke-width", 1);

        }
        createTitle((x+(isCircle ? 0 : (w/2))),(y+(isCircle ? 0 : (h/2))),w,h,txtstring,txtfont,txtcolorhex,txtsize);
        //console.log( "x = "+x+", y ="+y );
        btnOverlay.toFront();
    });
};

function createPhrases() {
    console.log( "phrase ? "+$map.find('phrase').length );

    $map.find('phrase').each(function() {

        $phrase = $(this);

        x = xoffset+parseInt($(this).attr('x'));
        y = yoffset+parseInt($(this).attr('y'));

        //console.log('phrase x = '+x);
        //console.log('phrase y = '+y);

        str = $(this).find('content').find('title').text();

        //console.log('x isNaN ? '+isNaN(x));

        if ( str != 'new' && isNaN(x) != true ) {
            font = $(this).find('content').find('font').text();
            hex = convertHex( $(this).find('content').find('hex').text() );
            //hex = $(this).find('content').find('hex').text();
            size = parseInt($(this).find('content').find('size').text());

            var text = paper.text(x,y,str).
               attr({
                    "font-family": "Arial",
                    "font-size": (size+"px"), 
                    "font-weight": font.indexOf("bold") >= 0 ? "bold" : "normal",
                    "font-style": font.indexOf("italic") >= 0 ? "italic" : "normal",
                    fill: hex
                    //stroke:"brown",
                    //"stroke-width": "3px"
                }
            );
            
            addxy = text.getBBox().width
            text.attr({x: (text.attr("x")+(text.getBBox().width/2))});
            text.attr({y: (text.attr("y")+(text.getBBox().height/2))});
            //text.transform('T'+(text.getBBox().x+(text.getBBox().width/2))+','+(text.getBBox().y+(text.getBBox().height/2)));
            // background //

            /*linehex = $(this).find('line').find('hex').text().split('0x').join('#');
            lineopacity = parseInt($(this).find('line').find('opacity').text());
            linethick = parseInt($(this).find('line').find('thick').text());
            bkgdhex = $(this).find('bkgd').find('hex').text().split('0x').join('#');
            bkgdopacity = parseInt($(this).find('bkgd').find('opacity').text());
            */

            var rectangle = paper.rect(x-3, y-3, (text.getBBox().width+6), (text.getBBox().height)+10);
            // Sets the fill attribute of the circle to red (#f00)
            rectangle.attr("fill", "#fff");
            // Sets the stroke attribute of the circle to white
            rectangle.attr("stroke", "#000");
            rectangle.attr("stroke-width", 1);

            text.toFront();
            
            set.push(rectangle,text);
            
            //console.log(linehex);
            //console.log(lineopacity);
            //console.log(linethick);
            //console.log(bkgdhex);
            //console.log(bkgdopacity);

            //strokePresent = linethick == 0 ? false : true;

        }
    });
}

function createTitle(x,y,w,h,str,font,hex,size) {

    //console.log( "str = "+str );
    //console.log( "font = "+font );
    //console.log( "hex = "+hex );
    //console.log( "size = "+size );


    var text = paper.text(x,y,str).
       attr({
            "font-family": "Arial",
            "font-size": (size+"px"), 
            "font-weight": font.indexOf("bold") <= 0 ? "bold" : "normal",
            "font-style": font.indexOf("italic") <= 0 ? "italic" : "normal",
            fill: hex
            //stroke:"brown",
            //"stroke-width": "3px"
        }
    );
    
    set.push(text);
    
    startString = str.split("-").join("- ");
    words = startString.split(" ");
    var tempText = "";
    for (var i=0; i<words.length; i++) {
      text.attr("text", tempText + " " + words[i]);
      if (text.getBBox().width > w) {
        tempText += "\n" + words[i];
      } else {
        tempText += " " + words[i];
        tempText.split("- ").join("-");
      }
    }

    text.attr("text", tempText.substring(1));

};

function conceptClick(ID) {
    $map.find('concept').each(function() {
        if ( ID == $(this).find('params').find('uid').text() ){
            console.log( "found it" );
            oSerializer = new XMLSerializer();
            //console.log( oSerializer.serializeToString( $(this).find('assets')[0] ));

            cxml = $(this).find('assets')[0];
            $($.parseXML("<description><![CDATA["+$(this).find('content').find('desc').text()+"]]></description>")).find("description").appendTo(cxml);
            //console.log( oSerializer.serializeToString( cxml ));

            showAssets(oSerializer.serializeToString( cxml ));
            
            return false;
        } else {
            console.log( "nope" );
        }
    });
}

function createArrowEnd(hx,hy,ctlx,ctly) {
    var triangle = paper.path("M0,-5L5,5L-5,5Z")
    triangle.attr({fill: "#000"});
    dg = calculateDegree(hx, hy, ctlx, ctly);
    
    //triangle.attr({x: hx});
    //triangle.attr({y: hy});
    //triangle.transform("r"+dg);
    
    triangle.transform("T"+(hx)+","+(hy)+"r"+dg);
    
    triangle.data("position", [0,0,0]);
    triangle.data("position")[0] = hx;
    triangle.data("position")[1] = hy;
    triangle.data("position")[2] = dg;
    
    arrows.push(triangle);
};

function createForks() {
    //var line = paper.path(['M0,31L229.2,31L100,100M75,50L75,100M50,50L50,100']);
    
    //fork = paper.path(['M0,31L229,31M138,31L138,0M0,31L0,94M229,31L229,92']);
    //generated:          M0,31L229,31M138,31L138,0M0,31L0,94M229,31L229,92
    //fork.transform("T"+(xoffset+21)+","+(yoffset+652));
    
    $map.find('fork').each(function() {
        
        // FORK X,Y //
        forkx = xoffset+parseInt($(this).attr('x'));
        forky = yoffset+parseInt($(this).attr('y'));
        
        // FORK ATTRIBUTES //
        thick = parseInt($(this).find('params').find('thick').text());
        //console.log('THICK : '+thick);
        opacity = (parseInt($(this).find('params').find('opacity').text())*01);
        //console.log('OPACITY : '+opacity);
        
        hex = convertHex( $(this).find('params').find('hex').text() );
        //c = $(this).find('params').find('hex').text();
        //hex = parseInt(parseInt(  )).toString(16);
        //hex = c == "0" ? "#000000" : ("#" + parseInt(c).toString(16));
        //if ( hex.length < 7 ){
            //hex = hex.split("#").join("#0");
        //}
        //console.log('HEX : '+hex);
        
        forkOrientation = $(this).find('params').find('orient').text();
        cType = $(this).find('params').find('root').attr('coordType');
        cNum = parseInt($(this).find('params').find('root').text());
        
        if ( cType == "y" ){
            cNum += forky;
        } else if ( cType == "x" ){
            cNum += forkx;
        }
        
        //            x y w h
        pathCoords = [0,0,0,0];
        
        //pathSequence = ["M"+()];
        
        // if cType = "y" then all paths include the cNum as y of 'M' to create a horizontal line vertical axis.
        // For root, where cNum is 31 and the pathCoords are [0,0,229,94] that would look like:
        // 'M'+pathCoords[0]+','+cNum+'L'+pathCoords[2]+','+cNum;
        // or: 'M0,31L229,31'
        // would make a horizontal line.
        
        // For tines then, with an x of 138 and y of 0:
        // 'M'+tx+','+cNum+'L'+tx+','+ty
        // or: M138,31L138,0
        
        // so if cType = "x" then it's a vertical line horizontal axis.
        // 'M'+cNum+','+pathCoords[1]+'L'+cNum+','+pathCoords[3];
        // or: 'M31,0L31,94' -- based on the variables outlined above
        
        // For tines then, with an x of 138 and y of 0:
        // 'M'+cNum+','+ty+'L'+tx+','+ty
        // or: M31,0L138,0
        
        inc = 0;
        //console.log("tines ? "+$(this).find('tine').length);
        $(this).find('tine').each(function() {
            
            tx = forkx+parseInt($(this).attr('x'));
            ty = forky+parseInt($(this).attr('y'));
            
            if ( inc == 0 ){
                pathCoords[0] = tx;
                pathCoords[1] = ty;
                pathCoords[2] = tx;
                pathCoords[3] = ty;
            } else {
                pathCoords[0] = tx < pathCoords[0] ? tx : pathCoords[0];
                pathCoords[1] = ty < pathCoords[1] ? ty : pathCoords[1];
                pathCoords[2] = tx > pathCoords[2] ? tx : pathCoords[2];
                pathCoords[3] = ty > pathCoords[3] ? ty : pathCoords[3];
            }
            inc++;
        });
        
        if ( cType == "y" ){
            // horizontal line on a vertical axis;
            // 'M'+pathCoords[0]+','+cNum+'L'+pathCoords[2]+','+cNum;
            pathSequence = 'M'+pathCoords[0]+','+cNum+'L'+pathCoords[2]+','+cNum;
        } else if ( cType == "x" ) {
            // vertical line on a horizontal axis;
            // 'M'+cNum+','+pathCoords[1]+'L'+cNum+','+pathCoords[3];
            pathSequence = 'M'+cNum+','+pathCoords[1]+'L'+cNum+','+pathCoords[3];
        } else {
            console.log("!error! Fork root pathSequence coordType not set to 'x' or 'y'");
        };
        
        $(this).find('tine').each(function() {
            
            tx = forkx+parseInt($(this).attr('x'));
            ty = forky+parseInt($(this).attr('y')); 
            
            if ( cType == "y" ) {
                // horizontal line on a vertical axis;
                // 'M'+tx+','+cNum+'L'+tx+','+ty;
                pathSequence += 'M'+tx+','+cNum+'L'+tx+','+ty;
            } else if ( cType == "x" ) {
                // vertical line on a horizontal axis;
                // 'M'+cNum+','+ty+'L'+tx+','+ty;
                pathSequence += 'M'+cNum+','+ty+'L'+tx+','+ty;
            } else {
                console.log("!error! Fork root pathSequence coordType not set to 'x' or 'y'");
            };
            /*
            if ( $(this).find('h1').attr('arrow') == "true" ){
                createArrowEnd(h1x,h1y,ctlx,ctly);
                //curve.attr({ "arrow-end": "block-wide-long" });
            };

            if ( $(this).find('h2').attr('arrow') == "true" ){
                createArrowEnd(h2x,h2y,ctlx,ctly);
                //curve.attr({ "arrow-end": "block-wide-long" });
            };
            */
                            
        });
        
        //console.log( "pathCoords : x="+pathCoords[0]+", y="+pathCoords[1]+", w="+pathCoords[2]+", h="+pathCoords[3] );
        //console.log( "pathSequence = "+pathSequence );
        
        fork = paper.path([pathSequence]);
        
        set.push(fork);
        
        fork.attr("stroke", hex);
        fork.attr("stroke-opacity", opacity);
        fork.attr({ "stroke-width": thick });
        //fork.attr({x: forkx});
        //fork.attr({y: forky});
        
        //fork.transform("T"+(forkx)+","+(forky));
        
        // APPLY FORK ATTRBUTES AND POSITION //
        //fork.transform("T"+(xoffset+forkx)+","+(yoffset+forky));
        //fork.attr({ "stroke-width": thick });
    });
    
    
    /*
    <fork x="21" y="652.8">
        <params>
          <thick>2</thick>
          <opacity>100</opacity>
          <hex>0x000000</hex>
          <uid>93663fork5</uid>
          <orient>down</orient>
          <root coordType="y">31.142857142857153</root>
        </params>
        <phrase id="93667phrase6">
          <thick>1</thick>
          <linehex>0x000000</linehex>
          <lineopacity>100</lineopacity>
          <bkgdhex>0xFFFFFF</bkgdhex>
          <bkgdopacity>100</bkgdopacity>
          <txt/>
          <txthex>0x000000</txthex>
        </phrase>
        <tine x="138.55" y="0">
          <id>tine_h1</id>
          <arrow>false</arrow>
          <snap/>
          <phrase id="">
            <thick>1</thick>
            <linehex>0x000000</linehex>
            <lineopacity>100</lineopacity>
            <bkgdhex>0xFFFFFF</bkgdhex>
            <bkgdopacity>100</bkgdopacity>
            <txt/>
            <txthex>0x000000</txthex>
          </phrase>
        </tine>
        <tine x="0" y="94.55000000000008">
          <id>tine_h2</id>
          <arrow>true</arrow>
          <snap/>
          <phrase id="">
            <thick>1</thick>
            <linehex>0x000000</linehex>
            <lineopacity>100</lineopacity>
            <bkgdhex>0xFFFFFF</bkgdhex>
            <bkgdopacity>100</bkgdopacity>
            <txt/>
            <txthex>0x000000</txthex>
          </phrase>
        </tine>
        <tine x="229.2" y="92.60000000000002">
          <id>tine_99721</id>
          <arrow>true</arrow>
          <snap/>
          <phrase id="" x="" y="" pct="">
            <thick/>
            <linehex/>
            <lineopacity/>
            <bkgdhex/>
            <bkgdopacity/>
            <txt/>
            <txthex/>
          </phrase>
        </tine>
    </fork>
    */
};

function createLines() {

    $map.find('line').each(function() {

        //var linelayer = new Kinetic.Layer();
        
        $line = $(this);

        if ( isNaN(parseInt($(this).attr('x'))+cmx) != true ) {

            linex = xoffset+parseInt($(this).attr('x'));
            liney = yoffset+parseInt($(this).attr('y'));

            //console.log('linex = '+linex);
            //console.log('liney = '+liney);

            ctlx = linex+parseInt($(this).find('ctl').attr('x'));
            ctly = liney+parseInt($(this).find('ctl').attr('y'));

            h1x = linex+parseInt($(this).find('h1').attr('x'));
            h1y = liney+parseInt($(this).find('h1').attr('y'));

            //console.log('h1x = '+h1x);
            //console.log('h1y = '+h1y);

            //ctlx = the line x + the ctl x;
            //ctly = the line y + the ctl y;


            drawType = $(this).find('params').find('type').text();

            //console.log('drawType = '+drawType);
            //console.log('ctlx = '+ctlx);
            //console.log('ctly = '+ctly);

            h2x = linex+parseInt($(this).find('h2').attr('x'));
            h2y = liney+parseInt($(this).find('h2').attr('y'));



            //console.log('h2x = '+h2x);
            //console.log('h2y = '+h2y);

            thick = parseInt($(this).find('params').find('thick').text());
            //console.log('THICK : '+thick);

            opacity = parseInt($(this).find('params').find('opacity').text());
            //console.log('OPACITY : '+opacity);
            
            hex = convertHex( $(this).find('params').find('hex').text() );
            //hex = parseInt(parseInt($(this).find('params').find('hex').text())).toString(16);
            //console.log('HEX : '+hex);

            if ( drawType == "curve" ){
                //                             start         q point    end  
                //                             x   y         x    y   x    y
                var curve = paper.path(['M', h1x, h1y, 'Q', ctlx, ctly, h2x, h2y]);
                curve.attr({ "stroke-width": thick });
                
                if ( $(this).find('h1').attr('arrow') == "true" ){
                    createArrowEnd(h1x,h1y,ctlx,ctly);
                    //curve.attr({ "arrow-end": "block-wide-long" });
                };
                
                if ( $(this).find('h2').attr('arrow') == "true" ){
                    createArrowEnd(h2x,h2y,ctlx,ctly);
                    //curve.attr({ "arrow-end": "block-wide-long" });
                };
                
                set.push(curve);
                
            } else if ( drawType == "straight" ){
                //
                var straight = paper.path(['M', h1x, h1y, h2x, h2y]);
                straight.attr({ "stroke-width": thick });
                if ( $(this).find('h1').attr('arrow') == "true" ){
                    createArrowEnd(h1x,h1y,h2x,h2y);
                };
                if ( $(this).find('h2').attr('arrow') == "true" ){
                    createArrowEnd(h2x,h2y,h1x,h1y);
                };
                
                set.push(straight);
                
            }

        }

    });
};

function colorClick(colorid){
    console.log('colorid = '+colorid);
};

/********************************/
/***** UTILITIES ****************/
/********************************/

function hexToR(h) {return parseInt((cutHex(h)).substring(0,2),16)};
function hexToG(h) {return parseInt((cutHex(h)).substring(2,4),16)};
function hexToB(h) {return parseInt((cutHex(h)).substring(4,6),16)};
function cutHex(h) {return (h.charAt(0)=="#") ? h.substring(1,7):h};

function calculateDegree(hdlX, hdlY, ctlx, ctly) {
    yLength = (hdlY-ctly);
    xLength = (hdlX-ctlx);
    radianAngle = Math.atan2(yLength,xLength);
    degree = (radianAngle/Math.PI)*180;
    //console.log('degree = '+degree);
    return (degree+90);
}

function convertHex( c ) {
    console.log("temphex start = "+c);
    if ( c.indexOf("0x") == 0 || c.indexOf("#") < 0 ){
        temphex = "#" + parseInt(c).toString(16);
        temphex = temphex == "#0" ? "#000000" : temphex;
    } else {
        temphex = c;
    }
    console.log("temphex 16 = "+temphex);
    if ( temphex.length < 7 ){
        temphex = temphex.split("#").join("#0");
    }
    console.log("final output = "+temphex);
    return temphex;
}