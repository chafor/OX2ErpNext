/*
  
  This example adds the "myPortalApp" to the OX AppSuite Portal.
  Please note that you have to click the "Add widget" button on the portal
  page and add the "Custom Portal Widget" in order to show it.
  
  More info:
  
  http://oxpedia.org/wiki/index.php?title=AppSuite:Writing_a_portal_plugin 
  
  and on 
  
  https://dev.ox.io
  
*/

define('myportalapp/register', ['io.ox/core/extensions'], function (ext) {

    'use strict';
	
    ext.point('io.ox/portal/widget').extend({
        id: 'myPortalApp'
    });

    ext.point('io.ox/portal/widget/myPortalApp').extend({
	
		title: 'Custom Portal Widget',
	
		preview: function () {
            		var content = $('<div class="content">').text('Server Call Example');
            		content.append($('<BR>'));

	    		$.getJSON( '/scripts/test2.php', function( data ) {
				var out = '<ul>';
                		$.each(data, function(i, field){
                			$.each(field, function(i, field2){
                        			$.each(field2, function(i, field3){
                                			out = out + "<li>" + field3 + "</li>";
                                		});
                        		});
                		});
				content.append(out + "</ul>");

            		});
//	    		content.append(out);
            /*var server_call_button = $('<input />', { type  : 'button', value : 'Call Server', id    : 'server_call_button',
              on    : {	click: function(id) { $.getJSON( '/scripts/test2.php', function( data ) { var out = '';
			$.each(data, function(i, field){ $.each(field, function(i, field2){ $.each(field2, function(i, field3){
						out = out + field3 + " "; }); }); 	});    
			alert(out); }); } }*/
            
            //content.append(server_call_button);
            this.append(content);
        },
        error: function (err) {
            console.log('error : '+err);
        }	
    });

    ext.point('io.ox/portal/widget/myPortalApp/settings').extend({
        title: 'Custom Portal Widget',
        type: 'myPortalApp',
		unique: true
    });

});
