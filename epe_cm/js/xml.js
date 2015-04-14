function loadxml() {
    $.ajax({
        type: "GET",
        url: xmlDocs[docnum],
        dataType: "xml",
        success: parseXml
      });
}

function parseXml(xml) {

        $map = $(xml);

        console.log( "mapContents = "+$map.find("conceptMap").length );
    
        //           x y w h;
        mapcoords = [0,0,0,0];

        // map coordinates are derived from the xml for concepts;
        var inc=0;

        $map.find('concept').each(function() {
            x = parseInt($(this).attr('x'));
            y = parseInt($(this).attr('y'));
            w = parseInt($(this).attr('w'));
            h = parseInt($(this).attr('h'));
            if ( inc == 0 ){
                mapcoords[0] = x;
                mapcoords[1] = y;
                mapcoords[2] = (x+w);
                mapcoords[3] = (y+h);
            } else {
                mapcoords[0] = x < mapcoords[0] ? x : mapcoords[0];
                mapcoords[1] = y < mapcoords[1] ? y : mapcoords[1];
                mapcoords[2] = (x+w) > mapcoords[2] ? (x+w) : mapcoords[2];
                mapcoords[3] = (y+h) > mapcoords[3] ? (y+h) : mapcoords[3];
            };

            inc++;
            
        });

        //I know the map x,y,w,h;
        console.log( "mapcoords : x="+mapcoords[0]+", y="+mapcoords[1]+", w="+mapcoords[2]+", h="+mapcoords[3] );
        //I know the canvas width : $("#canvas").innerWidth()
        console.log( "canvas width = "+$("#canvas").innerWidth() );

        // So I can (($("#canvas").innerWidth()-mapcoords[2])/2)-(mapcoords[0]/2);
        //    ...to arrive at an x offset to center the elements of the map...
        xoffset = (($("#canvas").innerWidth()-mapcoords[2])/2)-(mapcoords[0]/2);
        yoffset = (($("#canvas").innerHeight()-mapcoords[3])/2)-(mapcoords[1]/2);
        //console.log( "xoffset = "+xoffset );

        // I should then also be able to size the div and paper to accommodate the map size;

        // THEN go off to createMap();
        createMap();
}