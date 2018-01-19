
var forumEntries = function() {
  var obj = this;

 $(document).ready(function() {
	  obj.showEntries('community');

	  var com = $('#comEntries');
	  var anno = $('#annoEntries');
	
	  com.click(function() {
		  obj.showEntries('community');
	  });

	  anno.click(function() {
		  obj.showEntries('announcement');
	  });
  });

  this.showEntries = function(type) {
	  var contentAnno = $('#announcementContent');
	  var contentCommunity = $('#communityContent');
		console.log("Request");
		if(type === "announcement") {
			contentAnno.fadeIn();
			contentCommunity.hide();
		} else {
			contentCommunity.fadeIn();
			contentAnno.hide();
		}
  };

  this.showTopic = function(cat, id) {
	  location.href = "?category=" + cat + "&showthread="+id;
  };

  this.displayTopic = function() {
	var popup = $('#threadPopup');
    var overlay = $('#overlay');
    overlay.fadeIn();
	popup.fadeIn();
	  
	overlay.click(obj.hideTopic);
  };
  
  this.hideTopic = function() {
	var popup = $('#threadPopup');
    var overlay = $('#overlay');
    overlay.fadeOut();
	  popup.fadeOut();
  };
};

var forumConstruct = new forumEntries();
