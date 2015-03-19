/**
 * @author Julian
 */
var currid = "";
var currid2 = "";
var togg = true;
$(document).ready(function(){
       
       refresh()
       loadOptions()
       loadTable()
           
     $('#udtodate').datepicker();
	 $('#udfromdate').datepicker();
	 $('#vrtodate').datepicker();
	 $('#vrfromdate').datepicker(); 
            
	$('.nav-list li').live('click', function(){
	    $('.nav-list li.active').removeClass('active')
	    $(this).addClass('active')	
	})
	
	$('.nav-tabs li').live('click', function(){
	    $('.nav-tabs li.active').removeClass('active')
	    $(this).addClass('active')	
	})
	
	
		
	$("#fgpassword").live('click', function(){
		$('#login').fadeOut(200, function(){
     		$('#login').css('display', 'none');	
		    $('#fpassword').css({ 'display':'hidden'}).fadeIn(200);
		});
	});
	
	$("#gotologin").live('click', function(){
		$('#fpassword').fadeOut(200, function(){
     		$('#fpassword').css('display', 'none');	
		    $('#login').css({ 'display':'hidden'}).fadeIn(200);
		});
	});

    $("#macc").live('click', function(){
	  currid = $("#pagedata").children().filter(function(){
	   	 return $(this).css('display') != 'none';
	   }).attr('id')
	   
	  $('#'+currid).fadeOut(200, function(){
	       $('#'+currid).css('display', 'none');
     	   $('#useraccount').css({ 'display':'hidden'}).fadeIn(200);
	  });
	});
	
	$("#eacc").live('click', function(){
	   currid = $("#pagedata").children().filter(function(){
	   	 return $(this).css('display') != 'none';
	   }).attr('id')
	   
	   
	   $('#'+currid).fadeOut(200, function(){
	      	 $('#'+currid).css('display', 'none');
		     $('#editaccount').css({ 'display':'hidden'}).fadeIn(200);
	    });
	});
	
	$("#logout").live('click', function(){
	   $('#hometab').click();
	   $('#macc').click();
	   
	   currid = $("#pagedata").children().filter(function(){
	   	 return $(this).css('display') != 'none';
	   }).attr('id')
	   
	   // $("nav-tabs li.active").removeClass('active');
	   // $(this).addClass('active');
		   	    
		  $('#maindashboard').fadeOut(200, function(){
		  	    $('#'+currid).css('display', 'none');
	     		$('#maindashboard').css('display', 'none');	
			    $('#login').css({ 'display':'hidden'}).fadeIn(200);
			    $('#useraccount').css('display', 'block');
			    //$('#macc').addClass('active')
			    $('#logout').removeClass('active')     
			    
			    refresh()
			    
			    
			    $(function() {
					$.session.clear();					   
				});
		  });
	});
	
	$("#acenter").live('click', function(){
	   currid = $("#pagedata").children().filter(function(){
	   	 return $(this).css('display') != 'none';
	   }).attr('id')
	   
	   $('#'+currid).fadeOut(200, function(){
     		$('#'+currid).css('display', 'none');	
		    $('#admincenter').css({ 'display':'hidden'}).fadeIn(200);
	  });
	});
		
	$("#gensettab").live('click', function(){
	   currid = $("#tabjazz").children().filter(function(){
	   	 return $(this).css('display') != 'none';
	   }).attr('id')
	   
	   $('#'+currid).fadeOut(200, function(){
     		$('#'+currid).css('display', 'none')
		    $('#general_settings').css({ 'display':'hidden'}).fadeIn(200);
	  });
	});
	
	$("#usettab").live('click', function(){
	  currid = $("#tabjazz").children().filter(function(){
	   	 return $(this).css('display') != 'none';
	   }).attr('id')
	   
	   $('#'+currid).fadeOut(200, function(){
     		$('#'+currid).css('display', 'none');	
		    $('#user_settings').css({ 'display':'hidden'}).fadeIn(200);
	  });
	});
	
	$("#vptab").live('click', function(){
	  currid = $("#tabjazz").children().filter(function(){
	   	 return $(this).css('display') != 'none';
	   }).attr('id')
	   
	   $('#'+currid).fadeOut(200, function(){
     		$('#'+currid).css('display', 'none');	
		    $('#viewreport').css({ 'display':'hidden'}).fadeIn(200);
	  });
	});
	
	$("#udatatab").live('click', function(){
	  currid = $("#tabjazz").children().filter(function(){
	   	 return $(this).css('display') != 'none';
	   }).attr('id')
	   
	   $('#'+currid).fadeOut(200, function(){
     		$('#'+currid).css('display', 'none');	
		    $('#userdata').css({ 'display':'hidden'}).fadeIn(200);
	  });
	});
	
	$("#updatetab").live('click', function(){
	  currid = $("#tabjazz").children().filter(function(){
	   	 return $(this).css('display') != 'none';
	   }).attr('id')
	   
	   $('#'+currid).fadeOut(200, function(){
     		$('#'+currid).css('display', 'none');	
		    $('#updates').css({ 'display':'hidden'}).fadeIn(200);
	  });
	});
	
	$("#maptab").live('click', function(){
	  currid = $("#tabjazz").children().filter(function(){
	   	 return $(this).css('display') != 'none';
	   }).attr('id')
	   
	   $('#'+currid).fadeOut(200, function(){
     		$('#'+currid).css('display', 'none');	
		    $('#map_canvas').css({ 'display':'hidden'}).fadeIn(200);
	  });
	});
	
	$("#hometab").live('click', function(){
	  currid = $("#tabjazz").children().filter(function(){
	   	 return $(this).css('display') != 'none';
	   }).attr('id')
	   
	   $('#'+currid).fadeOut(200, function(){
     		$('#'+currid).css('display', 'none');	
		    $('#home_view').css({ 'display':'hidden'}).fadeIn(200);
	  });
	});
	
	$("#actall").live('click', function(){
	   $(this).attr('checked', togg)
	   $(this).parents('table').find('input:checkbox').each(function(){
	   	     $(this).attr('checked', togg);
	   })
	   togg = !togg;
	});
	
	$("#reply").live('click', function(){
		var $this = $(this);
        var row = $this.closest("tr");
        row.find('td:eq(1)');
        var acc_no = row.find('td:first').text();
		$('#accnumber').val(acc_no); 
				  
		  $('.fancybox').fancybox();
		  $.fancybox.open({
					href : '#replybox',
					type : 'inline',
					padding : 5,
				    openEffect : 'elastic',
					openSpeed : 150,
			
					closeEffect : 'elastic',
					closeSpeed : 150,
			
					closeClick : false,
				   helpers : {
			        overlay : null
		           }  
		  });  	   
	});
	
	$("#ss").live('click', function(){
	  
	});
	
	$("#rs").live('click', function(){
	  
	});
	
	$("#sess").live('click', function(){
	  
	});
	
	$("#aduser").live('click', function(){
	  
	});
	
	$("#regusr").live('click', function(){
	  
	});
	
	$("#accact").live('click', function(){
	  
	});
	
	$("#bannusr").live('click', function(){
	  
	});
	
	$("#oou").live('click', function(){
	  
	});
	
	$("#refreshinfo").live('click', function(){
	  refresh()
	});	
		
})

function refresh()
{
	 $(function() {
         var currsess = $.session.get("username");
         if(currsess != null){
         	
         	$('#login').css({ 'display':'none'});
         	$('#maindashboard').css('display', 'hidden').fadeIn(200);	
		    $.get('php/getcurruserdata.php', {u:currsess}, function(data){
				$('#myacc').html(data)		
		    },'text')
		    
         }else{
         	
         	$('#maindashboard').css('display', 'none');	
		    $('#login').css({ 'display':'hidden'}).fadeIn(200);
		    
         }
     });
         
	 $.get('php/getlocations.php', null, function(data){
          
         $('#udlocation').typeahead({
           source: data
          });
          
         $('#vrlocation').typeahead({ 
	         source: data
	     });
	     
	     $('#updatelocation').typeahead({ 
	         source: data
	     }); 
     },'json')
          
     $.get('php/getphones.php', null, function(data){
     	
		$('#vrphone_number').typeahead({ 
			source: data
		});
		
		$('#udphone_number').typeahead({ 
		   source: data
		});
     },'json')
           
}

function loadOptions(){
	$.get('php/deptoptions.php', null, function(data){
		$('#vrdepartment').html(data)
		$('#uddepartment').html(data)
		$('#repdept').html(data)
     },'text')
     
     $.get('php/statusoptions.php', null, function(data){
		$('#vrstatus').html(data)
		$('#udstatus').html(data)
		$('#repstatus').html(data)
     },'text')
     
     $.get('php/typeoptions.php', null, function(data){
		$('#vrtype').html(data)
		$('#udtype').html(data)
		$('#reptype').html(data)
     },'text')
}

function loadTable(){
	$.get('php/getreports.php', null, function(data){
		$('#vrtable').html(data)		
     },'text')
     
     $.get('php/getuserdata.php', null, function(data){
		$('#usdtable').html(data)		
     },'text')
     
     $.get('php/getregusers.php', null, function(data){
		$('#reg_users').html(data)		
     },'text')
     
     $.get('php/getupdates2.php', null, function(data){
		$('#uptable').html(data)		
     },'text')
     
     $.get('php/getinertusers.php', null, function(data){
		$('#aaa').html(data)		
     },'text')
     
     $.get('php/getbannedusers.php', null, function(data){
		$('#bannedusers').html(data)		
     },'text')
     
     $.get('php/getadmins.php', null, function(data){
		$('#admincontacts').html(data)		
     },'text')
}
