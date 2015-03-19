/**
 * @author Julian
 */  
    
$(document).ready(function(){	
	 
	populateGraph()
	populateMap()
	
	$(".btn").live('click', function(e){
	      e.preventDefault();
	      
	      var id = $(this).attr('id');
	     
	      switch(id){
	      	case 'loginbtn':
	      	   var valname = $(this).parents('form').find('input[name="username"]').val();
	      	   var valpass = $(this).parents('form').find('input[name="password"]').val();
	      	   $.post('php/authenticate.php', {u:valname, p:valpass}, function(data){
	      	   	var resString = JSON.stringify(data);
	      	   	var resParse = JSON.parse(resString);
	      	   	var check = resParse.success; 
	      	   	
	      	   	if(check == 1){
	      	   		$(function() {
						    $.session.set("username", valname);						   
					});
					
		      	   $('#login').fadeOut(200, function(){
			     		$('#login').css('display', 'none');
			     		$('.alert').css('display', 'none');		
					    $('#maindashboard').css({ 'display':'hidden'}).fadeIn(200);
					    $('#hometab').addClass('active')
					    
					    refresh()
					    
					});		
	      	   	}else{
	      	   		 var msg = "<div class=\"alert alert-error\" style=\"width: 50%; margin-left: 120px;\"><span >Wrong Username or Password</span></div>";
	      	   	     $('#loginerr').html(msg);
	      	   	}
	      	   	
	      	   }, 'json');
	      	   
	      	break;
	      	
	      	case 'eaccbtn':
	      	   var currpass = $(this).parents('form').find('input[name="currpass"]').val();
	      	   var newpass = $(this).parents('form').find('input[name="newpass"]').val();
	      	   var conpass = $(this).parents('form').find('input[name="con_newpass"]').val();
	      	   var e_email = $(this).parents('form').find('input[name="e_email"]').val();
	      	   
	      	   if(newpass == conpass){
		      	   	  $.post('php/editaccount.php', {np:newpass, cp:currpass, e:e_email}, function(data){
			      	   	var resString = JSON.stringify(data);
			      	   	var resParse = JSON.parse(resString);
			      	   	var check = resParse.success; 
			      	   	
			      	   	if(check == 1){
				      	   	    var msg = "<div class=\"alert alert-success\" style=\"margin-top: 10px; width: 50%; margin-left: 50px;\"><span >Account Editted</span></div>";
	      	   	                $('#editaccmsg').html(msg);
			      	   	}else{
			      	   	        var msg2 = "<div class=\"alert alert-error\" style=\"margin-top: 10px; width: 50%; margin-left: 50px;\"><span >Account Failed To Be Editted</span></div>";
	      	   	                $('#editaccmsg').html(msg2);	
			      	   	}
			      	   	
			      	  }, 'json');
			      	  
	      	   }else{
	      	          var msg2 = "<div class=\"alert alert-error\" style=\"margin-top: 10px; width: 50%; margin-left: 50px;\"><span >Password Mismatch</span></div>";
	      	   	      $('#editaccmsg').html(msg2);	
	      	   }
	      	   
	      	break;
	      		      		    	      	
	      	case 'banuserbtn':
	      	   var user = $(this).parents('form').find('input[name="bann_username"]').val();
	      	   $.post('php/banuser.php', {u:user}, function(data){
				      	   	var resString = JSON.stringify(data);
				      	   	var resParse = JSON.parse(resString);
				      	   	var check = resParse.success;
				      	   	
				      	   	if(check == 1){
				      	   		var msg = "<div class=\"alert alert-success\" style=\"margin-top: 50px; width: 50%; margin-left: 50px;\"><span >User Banned</span></div>";
	      	   	                $('#useropsmsg').html(msg);
				      	   	}else{
				      	   		var msg = "<div class=\"alert alert-error\" style=\"margin-top: 50px; width: 50%; margin-left: 50px;\"><span >User Not Banned</span></div>";
	      	   	                $('#useropsmsg').html(msg);
				      	   		
				      	   	} 
				      	   	
				      	   	$.get('php/getregusers.php', null, function(data){
								$('#reg_users').html(data)		
						     },'text')
						     
						     $.get('php/getinertusers.php', null, function(data){
								$('#aaa').html(data)		
						     },'text')
						     
						     $.get('php/getbannedusers.php', null, function(data){
								$('#bannedusers').html(data)		
						     },'text')
				            
				}, 'json');
	      	   
	      	break;
	      	
	      	case 'send_upd':
	      	   var uploc = $(this).parents('form').find('input[name="updatelocation"]').val();
	      	   var upmsg = $(this).parents('form').find('textarea[name="updatemessage"]').val();
	      	   
	      	   $.post('php/addupdate.php', {l:uploc, m:upmsg}, function(data){
				      	   	var resString = JSON.stringify(data);
				      	   	var resParse = JSON.parse(resString);
				      	   	var check = resParse.success; 
				      	   //	alert(resParse);
				      	   	if(check == 1){
				      	   		 var msg = "<div class=\"alert alert-success\" style=\"margin-top: 50px; width: 50%; margin-left: 50px;\"><span >Update Sent</span></div>";
	      	   	                 $('#update_err').html(msg);						     		
				      	   	}else{
				      	   		 var msg = "<div class=\"alert alert-error\" style=\"margin-top: 50px; width: 50%; margin-left: 50px;\"><span >Update Not Sent</span></div>";
	      	   	                 $('#update_err').html(msg);	
				      	   	}
				      	   	
				}, 'json');
	      	break;
	      	
	      	case 'usearchnow':
	           var phone = $(this).parents('form').find('input[name="uphone_number"]').val();
	      	   var dept = $(this).parents('form').find('select[name="uddepartment"]').val();
	      	   var loc = $(this).parents('form').find('input[name="ulocation"]').val();
	      	   var status = $(this).parents('form').find('select[name="udstatus"]').val();
	      	   var type = $(this).parents('form').find('select[name="udtype"]').val();
	      	   var datef = $(this).parents('form').find('input[name="ufromdate"]').val();
	      	   var datet = $(this).parents('form').find('input[name="utodate"]').val();
	
	           if(datef == null || datet == null){
	               	 alert("date and time are required") 	
	           }else{
	           	   	$.post('php/getuserdata.php', {up:phone, udf:datef, udt:datet, ul:loc, ud:dept, us:status, ut:type}, function(data){
				      	   	$('#usdtable').html(data)
				      }, 'text');
	           }
	      	
	      	break;
	      	
	      	case 'vsearchnow':
	      	       var phone = $(this).parents('form').find('input[name="vrphone_number"]').val();
		      	   var dept = $(this).parents('form').find('select[name="vrdepartment"]').val();
		      	   var loc = $(this).parents('form').find('input[name="vrlocation"]').val();
		      	   var status = $(this).parents('form').find('select[name="vrstatus"]').val();
		      	   var type = $(this).parents('form').find('select[name="vrtype"]').val();
		      	   var datef = $(this).parents('form').find('input[name="vrfromdate"]').val();
		      	   var datet = $(this).parents('form').find('input[name="vrtodate"]').val();
	      	
	      	
		      	   if(datef == null || datet == null){
		                 alert("date and time are required")  	
		           }else{
		           	   	$.post('php/getreports.php', {up:phone, udf:datef, udt:datet, ul:loc, ud:dept, us:status, ut:type}, function(data){
					      	   	$('#vrtable').html(data) 
					      }, 'text');
		           }
	      	break;
	      	
	      	//addu
	      	case 'addu':
	      	   //alert("Add user");
	      	   var user = $(this).parents('form').find('input[name="add_username"]').val();
	      	   var pass = $(this).parents('form').find('input[name="add_userpass"]').val();
	      	   var pass2 = $(this).parents('form').find('input[name="add_userpass2"]').val();
	      	   var level = $(this).parents('form').find('input[name="add_userlevel"]').val();
	      	   var email = $(this).parents('form').find('input[name="add_useremail"]').val();
     	   
	      	   if(pass == pass2){
		      	   	$.post('php/adduser.php', {u:user, p:pass, e:email, l:level}, function(data){
				      	   	var resString = JSON.stringify(data);
				      	   	var resParse = JSON.parse(resString);
				      	   	var check = resParse.success; 
				      	   //	alert(resParse);
				      	   	if(check == 1){
				      	   		var msg = "<div class=\"alert alert-success\" style=\"margin-top: 50px; width: 50%; margin-left: 50px;\"><span >User Added</span></div>";
	      	   	                 $('#add_user').html(msg);
	      	   	                 						     		
				      	   	}else{
				      	   		 var msg = "<div class=\"alert alert-error\" style=\"margin-top: 50px; width: 50%; margin-left: 50px;\"><span >User Not Added</span></div>";
	      	   	                 $('#add_user').html(msg);	
				      	   	}
				      	   	
				      	   	$.get('php/getinertusers.php', null, function(data){
								$('#aaa').html(data)		
						    },'text')
				      	   	
				      }, 'json');
	      	   	   
	      	   }else{
	      	   	  alert('Passwords are not equal');
	      	   }
	      	break;
	      	
	      	case 'actusrs':
	      	       var ids = [];
	      	      $('#aaa').find('input:checked').each(function(){
	      	      	ids.push($(this).parents('tr').children().first().html())	
	      	      	      	      	
	      	      });
	      	      
	      	      var idarr = JSON.stringify(ids)
	      	      //alert(idarr);
	      	      $post('php/activateusers.php', {ids:idarr}, function(data){
				      	        var res = JSON.stringify(data)
				      	        var parsestr = JSON.parse(res)
				      	        var msg = parsestr.message;
				   
				      	        alert(msg);
				   
							   // $.get('php/getinertusers.php', null, function(data){
									// $('#aaa').html(data)		
							   // },'text');
				   }, 'json');
				   
				   
	      	      
	      	break;
	      	
	      	case 'save_genset':
	      	var uit = $(this).parents('form').find('input[name="uit"]').val();
	      	var gtime = $(this).parents('form').find('input[name="gtimeout"]').val();
	      	var cexp = $(this).parents('form').find('input[name="cexpiry"]').val();
	      	var cpath = $(this).parents('form').find('input[name="cpath"]').val();
	      	var captcha = $(this).parents('form').find('select[name="e_captcha"]').val();
	      	var ulow = $(this).parents('form').find('select[name="u_lowercas"]').val();
	      	var sendwel = $(this).parents('form').find('select[name="swm"]').val();
	      	var pmin = $(this).parents('form').find('input[name="p_min"]').val();
	      	var pmax = $(this).parents('form').find('input[name="p_max"]').val();
	      	var umin = $(this).parents('form').find('input[name="u_min"]').val();
	      	var umax = $(this).parents('form').find('input[name="u_max"]').val();
	      	var byad = $(this).parents('form').find('input[name="byadmin"]').val();
	      	var byu = $(this).parents('form').find('input[name="byuser"]').val();
	      	var noact = $(this).parents('form').find('input[name="noactivation"]').val();
	      	var disreg = $(this).parents('form').find('input[name="disreg"]').val();
	      	var shome = $(this).parents('form').find('input[name="site_home"]').val();
	      	var sroot = $(this).parents('form').find('input[name="site_root"]').val();
	      	var e_admin = $(this).parents('form').find('input[name="admin_email"]').val();
	      	var e_title = $(this).parents('form').find('input[name="email_title"]').val();
	      	var sdesc = $(this).parents('form').find('input[name="desc"]').val();
	      	var sname = $(this).parents('form').find('input[name="sitename"]').val();
	   
	      	          $.post('php/addregset.php', {ulm:umin, ulmx:umax, plm:pmin, plmx:pmax, aact:noact, sw:sendwel, ec:captcha, unl:ulow}, function(data){
				      	         var resString = JSON.stringify(data);
				      	   	     var resParse = JSON.parse(resString);
				      	   	     var check = resParse.message; 
				      	         var msg = "<div class=\"alert alert-warning\" style=\"margin-top: 10px; width: 50%; margin-left: 50px;\"><span >"+check+"</span></div>";
	      	   	                 $('#gensettres').html(msg);
				      }, 'text');
				 
				      $.post('php/addsiteset.php', {sn:sname, sd:sdesc, hp:shome, sr:sroot, en:e_title, ea:e_admin}, function(data){
				      	   	     var resString = JSON.stringify(data);
				      	   	     var resParse = JSON.parse(resString);
				      	   	     var check = resParse.message; 
				      	   	     var msg = "<div class=\"alert alert-warning\" style=\"margin-top: 10px; width: 50%; margin-left: 50px;\"><span >"+check+"</span></div>";
	      	   	                 $('#gensettres').html(msg);
				      }, 'text');
				      			      
				      $.post('php/addsessionset.php', {ut:uit, cp:cpath, ce:cexp, gt:gtime}, function(data){
				      	   	     var resString = JSON.stringify(data);
				      	   	     var resParse = JSON.parse(resString);
				      	   	     var check = resParse.message; 
				      	   	     var msg = "<div class=\"alert alert-warning\" style=\"margin-top: 10px; width: 50%; margin-left: 50px;\"><span >"+check+"</span></div>";
	      	   	                 $('#gensettres').html(msg);
				      }, 'text');
	      	   
	      	break;
	      	
	      	case 'send_reply':
		      	var an = $(this).parents('form').find('input[name="accnumber"]').val();
		      	var dep = $(this).parents('form').find('select[name="repdept"]').val();
		      	var st = $(this).parents('form').find('select[name="repstatus"]').val();
		      	var ty = $(this).parents('form').find('select[name="reptype"]').val();
			    var msg = $(this).parents('form').find('textarea[name="replymsg"]').val();
			    
			    $.post('php/addreply.php', {an:an, msg:msg, dep:dep, st:st, ty:ty}, function(data){
			    	var repstr = JSON.stringify(data);
			    	var parsedstr = JSON.parse(repstr)
			    	var msgback = parsedstr.message 
			    	$.fancybox.close();
			    	alert(msgback);
			    	
			    	refresh()
			    
			    }, 'json');
	      	break;
	      	
	      	
	      	
	      } 
	});
	
	$("#expxls").live('click', function(){
	               var phone = $(this).parents('form').find('input[name="vrphone_number"]').val();
		      	   var dept = $(this).parents('form').find('select[name="vrdepartment"]').val();
		      	   var loc = $(this).parents('form').find('input[name="vrlocation"]').val();
		      	   var status = $(this).parents('form').find('select[name="vrstatus"]').val();
		      	   var type = $(this).parents('form').find('select[name="vrtype"]').val();
		      	   var datef = $(this).parents('form').find('input[name="vrfromdate"]').val();
		      	   var datet = $(this).parents('form').find('input[name="vrtodate"]').val();
	      	
	      	
		      	   if(datef == null || datet == null){
		                 alert("date and time are required")  	
		           }else{
		           	   	$.post('php/export_xls.php', {up:phone, udf:datef, udt:datet, ul:loc, ud:dept, us:status}, function(data){
					      	   	$('#vrtable').html(data) 
					      }, 'text');
		           }
	});
	
	$("#expcsv").live('click', function(){
	               var phone = $(this).parents('form').find('input[name="vrphone_number"]').val();
		      	   var dept = $(this).parents('form').find('select[name="vrdepartment"]').val();
		      	   var loc = $(this).parents('form').find('input[name="vrlocation"]').val();
		      	   var status = $(this).parents('form').find('select[name="vrstatus"]').val();
		      	   var type = $(this).parents('form').find('select[name="vrtype"]').val();
		      	   var datef = $(this).parents('form').find('input[name="vrfromdate"]').val();
		      	   var datet = $(this).parents('form').find('input[name="vrtodate"]').val();
	      	
	      	
		      	   if(datef == null || datet == null){
		                 alert("date and time are required")  	
		           }else{
		           	    
		           	   	// $.post('php/export_to_csv.php', {up:phone, udf:datef, udt:datet, ul:loc, ud:dept, us:status, ut:type}, function(data){
					      	   // $('#vrtable').html("<span><font color = '#00ff00'> Check /home/julian/export.csv </font></span>") 	
					      // }, 'text');
					       exportTableToCSV.apply(this, [$('#dvData>table'), 'export.csv']);
		           }
	});
	
	
});

function populateGraph(){
	$.get('php/getgraphdata.php', null, function(data){
		var chart = new AmCharts.AmSerialChart();
        chart.dataProvider = data;
        chart.categoryField = "location";
        
        var graph = new AmCharts.AmGraph();
		graph.valueField = "frequency"
		graph.type = "column";
		graph.balloonText = "[[location]]: [[value]]";
		graph.lineAlpha = 0;
        graph.fillAlphas = 0.5;
        
		chart.angle = 60;
        chart.depth3D = 15;
		chart.addGraph(graph);
		chart.write('chartContainer');
	}, 'json')
}

function populateMap(){
	
	$.get('php/getmapdata.php', null, function(data){
		var mapinfo = JSON.stringify(data)
		var results = JSON.parse(mapinfo)
		load(results)
		
	}, 'json')
}

function loadResults(){
        var items, markers_data = [];
		
		 if (data.length > 0) {
         items = data;

        for (var i = 0; i < items.length; i++) {
          var item = items[i];

          if (item.latitude != undefined && item.longitude != undefined) {
            var icon = 'images/poweroutage.png';
            markers_data.push({
              lat : item.lat,
              lng : item.lng,
              user : item.user,
              icon : {
                size : new google.maps.Size(32, 32),
                url : icon
              },
              infoWindow: {
                  content: '<p>'+item.complaint+'</p>'
              }
            });
          }
        }
      }

      map.addMarkers(markers_data);	
}


function load(mapdata) {
	
	    var icon = 'images/poweroutage.png';
        var shadow ='http://labs.google.com/ridefinder/images/mm_20_shadow.png';
        
      var map = new google.maps.Map(document.getElementById("mapdiv"), {
		center: new google.maps.LatLng(0.313611100000000000,32.581111100000044000),
        zoom: 12,
        mapTypeId: 'roadmap'
      });
      var infoWindow = new google.maps.InfoWindow;

      // Change this depending on the name of your PHP file
     // downloadUrl("umeme_db.php", function(data) {
	  
      //  var xml = data.responseXML;
      //  var markers = xml.documentElement.getElementsByTagName("marker");
		
        for (var i = 0; i < mapdata.length; i++) {
		
		   //if( map.getBounds().contains(markers[i].getPosition()) ){
		   
          var name = mapdata.user;
          var address = mapdata.location;
		  var complaint = mapdata.complaint;
		  
          var point = new google.maps.LatLng(
              parseFloat(mapdata.latitude),
              parseFloat(mapdata.longitude));
			  
          var content = "<b>" + name + "</b> <br/>" + complaint +"<br/>"+ address;
         
		  
          var marker = new google.maps.Marker({
            map: map,
            position: point,
            icon: icon,
            shadow: shadow
          });
          bindInfoWindow(marker, map, infoWindow, content);
		  
		  //}
        }
     // });
	  
    }

function bindInfoWindow(marker, map, infoWindow, content) {
	
  google.maps.event.addListener(marker, 'click', function() {	  
    infoWindow.setContent(content);
    infoWindow.open(map, marker);		
  });
}

function downloadUrl(url, callback) {
	
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

      request.onreadystatechange = function() {
	  
        if (request.readyState == 4) {
		
          request.onreadystatechange = doNothing;
          callback(request, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }
    
function detectBrowser() {
	
	var useragent = navigator.userAgent;
	var mapdiv = document.getElementById("map-canvas");

	if (useragent.indexOf('iPhone') != -1 || useragent.indexOf('Android') != -1 ) {	
		mapdiv.style.width = '100%';
		mapdiv.style.height = '100%';		
	} else {	
		mapdiv.style.width = '600px';
		mapdiv.style.height = '800px';		
	}
}

function exportTableToCSV($table, filename) {

        var $rows = $table.find('tr:has(td)'),

            // Temporary delimiter characters unlikely to be typed by keyboard
            // This is to avoid accidentally splitting the actual contents
            tmpColDelim = String.fromCharCode(11), // vertical tab character
            tmpRowDelim = String.fromCharCode(0), // null character

            // actual delimiter characters for CSV format
            colDelim = '","',
            rowDelim = '"\r\n"',

            // Grab text from table into CSV formatted string
            csv = '"' + $rows.map(function (i, row) {
                var $row = $(row),
                    $cols = $row.find('td');

                return $cols.map(function (j, col) {
                    var $col = $(col),
                        text = $col.text();

                    return text.replace('"', '""'); // escape double quotes

                }).get().join(tmpColDelim);

            }).get().join(tmpRowDelim)
                .split(tmpRowDelim).join(rowDelim)
                .split(tmpColDelim).join(colDelim) + '"',

            // Data URI
            csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);

        $(this)
            .attr({
            'download': filename,
                'href': csvData,
                'target': '_blank'
           });
           
}
