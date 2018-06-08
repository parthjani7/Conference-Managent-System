function checkRadioReview(){
	if(!jQuery('[name="innovative_concept"]').is(':checked')){
		alert("Please Select Scale from \"Innovative Concept\"");
	}else if(!jQuery('[name="content_origionality"]').is(':checked')){
		alert("Please Select Scale from \"Content content_origionality\"");
	}else if(!jQuery('[name="technicality"]').is(':checked')){
		alert("Please Select Scale from \"Technicality\"");
	}else if(!jQuery('[name="structure"]').is(':checked')){
		alert("Please Select Scale from \"Structured Organization of Paper\"");
	}else if(!jQuery('[name="reference"]').is(':checked')){
		alert("Please Select Scale from \"References\"");
	}else if(!jQuery('[name="lang_grammer"]').is(':checked')){
		alert("Please Select Scale from \"lang_grammer & Grammer\"");
	}else if(!jQuery('[name="status"]').is(':checked')){
		alert("Please Select Choice from  \"Accept\"  or \"Accept with Modificaton\"  or  \"Reject\"");
	}else{return true};
     return false;
}
$(document).ready(function(){
	var row='';
	  $('.review').click(function(e){
	       var assignment_id=$(this).attr('href');
	       row=$(this).closest('tr');
	       var paper_title=row.find('td.paper_title').html();
	       $('#review .modal-title').html(paper_title);
	       $('#review #assignment_id').val(assignment_id);
	       $('#review').modal('show');
	       e.preventDefault();
	 });
	$('#paperReviewForm').submit(function(e){
          if(!checkRadioReview()){return false;}else{$('#submit_review').attr('disabled','');}
          $.ajax({
               data:$(this).serialize(),
               type:'post',
               url:$(this).attr('action'),
               success:function(response){
                    var response=jQuery.parseJSON(response);
                    if(response.status=='1'){
                         row.hide();
                         alert("Review has been Submitted Successfully.");
                    }else
                         alert("Review already Exists.");
                    $('#review').modal('hide');
                    $('#paperReviewForm')[0].reset()
                    $('#submit_review').removeAttr('disabled');
               }
          })
          e.preventDefault();
    });
});
