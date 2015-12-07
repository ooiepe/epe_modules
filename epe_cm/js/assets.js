var currentAssets;

function showAssets(xml) {

	$('#assetList').show();

	// console.log($('#assetList'));

	// console.log('showAssets!!!!!!');
	// console.log(xml);

	$.ajax({
		type: "GET",
		url: assetLookupUrl,
		data: { xml: xml },
		success: function(data) {

			var xmlDoc = $.parseXML(data);
			var $xml = $(xmlDoc);
			var o = {};

			o.allAssets = Array();
			o.visualizations = Array();
			$xml.find("visualizations").each(function(){
				$(this).find("node").each(function(){
					var thisObject = {};
					thisObject.type = 'EV';
					thisObject.id = $(this).attr('id');
					thisObject.img = $(this).attr('img');
					thisObject.url = $(this).attr('url');
					thisObject.source = $(this).attr('source');
					thisObject.title = $(this).find('title').text();
					thisObject.longDesc = $(this).find('longDesc').text();
					thisObject.authorID = $(this).find('author').attr('id');
					thisObject.authorName = $(this).find('author').text();
					thisObject.index = o.allAssets.length;
					o.allAssets.push(thisObject);
					o.visualizations.push(thisObject);
			  	});
		  	});
			o.conceptmaps = Array();
			$xml.find("conceptmaps").each(function(){
				$(this).find("node").each(function(){
					var thisObject = {};
					thisObject.type = 'CM';
					thisObject.id = $(this).attr('id');
					thisObject.img = $(this).attr('img');
					thisObject.url = $(this).attr('url');
					thisObject.source = $(this).attr('source');
					thisObject.title = $(this).find('title').text();
					thisObject.longDesc = $(this).find('longDesc').text();
					thisObject.authorID = $(this).find('author').attr('id');
					thisObject.authorName = $(this).find('author').text();
					thisObject.index = o.allAssets.length;
					o.allAssets.push(thisObject);
					o.conceptmaps.push(thisObject);
			  	});
		  	});
			o.lessons = Array();
			$xml.find("lessons").each(function(){
				$(this).find("node").each(function(){
					var thisObject = {};
					thisObject.type = 'LLB';
					thisObject.id = $(this).attr('id');
					thisObject.img = $(this).attr('img');
					thisObject.url = $(this).attr('url');
					thisObject.source = $(this).attr('source');
					thisObject.title = $(this).find('title').text();
					thisObject.longDesc = $(this).find('longDesc').text();
					thisObject.authorID = $(this).find('author').attr('id');
					thisObject.authorName = $(this).find('author').text();
					thisObject.index = o.allAssets.length;
					o.allAssets.push(thisObject);
					o.lessons.push(thisObject);
			  	});
		  	});
			o.images = Array();
			$xml.find("images").each(function(){
				$(this).find("node").each(function(){
					var thisObject = {};
					thisObject.type = 'IMG';
					thisObject.id = $(this).attr('id');
					thisObject.img = $(this).attr('img');
					thisObject.url = $(this).attr('url');
					thisObject.source = $(this).attr('source');
					thisObject.title = $(this).find('title').text();
					thisObject.longDesc = $(this).find('longDesc').text();
					thisObject.authorID = $(this).find('author').attr('id');
					thisObject.authorName = $(this).find('author').text();
					thisObject.index = o.allAssets.length;
					o.allAssets.push(thisObject);
					o.images.push(thisObject);
			  	});
		  	});
			o.videos = Array();
			$xml.find("videos").each(function(){
				$(this).find("node").each(function(){
					var thisObject = {};
					thisObject.type = 'MOV';
					thisObject.id = $(this).attr('id');
					thisObject.img = $(this).attr('img');
					thisObject.url = $(this).attr('url');
					thisObject.source = $(this).attr('source');
					thisObject.title = $(this).find('title').text();
					thisObject.longDesc = $(this).find('longDesc').text();
					thisObject.authorID = $(this).find('author').attr('id');
					thisObject.authorName = $(this).find('author').text();
					thisObject.index = o.allAssets.length;
					o.allAssets.push(thisObject);
					o.videos.push(thisObject);
			  	});
		  	});
			o.docs = Array();
			$xml.find("docs").each(function(){
				$(this).find("node").each(function(){
					var thisObject = {};
					thisObject.type = 'DOC';
					thisObject.id = $(this).attr('id');
					thisObject.img = $(this).attr('img');
					thisObject.url = $(this).attr('url');
					thisObject.source = $(this).attr('source');
					thisObject.title = $(this).find('title').text();
					thisObject.longDesc = $(this).find('longDesc').text();
					thisObject.authorID = $(this).find('author').attr('id');
					thisObject.authorName = $(this).find('author').text();
					thisObject.index = o.allAssets.length;
					o.allAssets.push(thisObject);
					o.docs.push(thisObject);
			  	});
		  	});

		  	currentAssets = o;

			renderAssets(o);

			return;


		}
	});

	return;
}

function closeAssets() {

	$('#assetList').hide();

	$('#list .resList').empty();

	return;
}

