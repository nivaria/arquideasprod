/*
* To change this template, choose Tools | Templates
* and open the template in the editor.
*/
$(function(){
    //Node form position
    /*var jqNodeForm = $("body.page-node #node-form div.node-form");
if(jqNodeForm.length>0){
var jqStand = $("body.page-node #node-form div.node-form > .standard");
var jqRel = $("body.page-node #node-form div.node-form > .relations");
if(jqStand.length>0 && jqRel.length>0){
$("<div class='node-form-cols'></div>").prependTo(jqNodeForm);
jqStand.appendTo(jqNodeForm.find("div.node-form-cols")).css("width","73%").css("float","left");
jqRel.appendTo(jqNodeForm.find("div.node-form-cols")).css("width","25%").css("float","right");
}
}*/
    //Mi actividad hack
    $("body.profile-me #header-group ul.menu li a[href$='/user']").addClass("active");
    //Add Mark all in group page Subscriptions block
    if($("body.node-type-group div.node #node-bottom #block-notifications_ui-0 .content .form-checkboxes .form-item input[type='checkbox']:not(:checked)").length>0){
        $("body.node-type-group div.node #node-bottom #block-notifications_ui-0 .content .form-checkboxes").prepend("<a href='#' title='Marcar todos' class='mark-all'>Marcar todos</a>");
    } else {
        $("body.node-type-group div.node #node-bottom #block-notifications_ui-0 .content .form-checkboxes").prepend("<a href='#' title='Desmarcar todos' class='unmark-all'>Desmarcar todos</a>");
    }
    $("body.node-type-group div.node #node-bottom #block-notifications_ui-0 .content .form-checkboxes a.mark-all").live("click",function(ev){
        ev.preventDefault();
        $(this).parents(".form-checkboxes").find(".form-item input[type='checkbox']").attr("checked","checked").end().end().removeClass("mark-all").addClass("unmark-all").attr("title","Desmarcar todos").html("Desmarcar todos");
        return false;
    });
    $("body.node-type-group div.node #node-bottom #block-notifications_ui-0 .content .form-checkboxes a.unmark-all").live("click",function(ev){
        ev.preventDefault();
        $(this).parents(".form-checkboxes").find(".form-item input[type='checkbox']").removeAttr("checked").end().end().removeClass("unmark-all").addClass("mark-all").attr("title","Marcar todos").html("Marcar todos");
        return false;
    });
    $("body.node-type-group div.node #node-bottom #block-notifications_ui-0 .content .form-checkboxes .form-item input[type='checkbox']").live("click",function(ev){
        if($("body.node-type-group div.node #node-bottom #block-notifications_ui-0 .content .form-checkboxes .form-item input[type='checkbox']:not(:checked)").length>0){
            $("body.node-type-group div.node #node-bottom #block-notifications_ui-0 .content .form-checkboxes a").removeClass("unmark-all").addClass("mark-all").attr("title","Marcar todos").html("Marcar todos");
        } else {
            $("body.node-type-group div.node #node-bottom #block-notifications_ui-0 .content .form-checkboxes a").removeClass("mark-all").addClass("unmark-all").attr("title","Desmarcar todos").html("Desmarcar todos");
        }
    });
    //Comment block Title
    if(Drupal.settings.user && Drupal.settings.user.profile_name){
        $("#comments .box h2.title").html(Drupal.settings.user.profile_name+", deja tu comentario");
    }
    //Answer block Title
    if(Drupal.settings.user && Drupal.settings.user.profile_name){
        $(".buildmode-full .node-type-faq_question .field-gerencia-reply-form-widget > form > div").prepend("<h2 class='title'>"+Drupal.settings.user.profile_name+", comparte tu respuesta</h2>");
    }
    //Group details page. Taxonomy list styling.
    $(".page-ogdetails .view-group-selected-categories .item-list ul li a.active").parents("li.views-row").addClass("active");
    //Group details page. Move boton edit.
    $("body.page-ogdetails .edit-content-link").prependTo("#content-group").css({
        top: "28px",
        right: "16px"
    });
    //Fix Slideshow error
    if($("html").hasClass("activeSlide")){
        $("html").removeClass("activeSlide");
    }
    //Some improvements for dates
    $("span.date-display-start").each(function(index){
        var todate = $(this).parents(".field-content").find("span.date-display-end");
        if(todate.length>0){
            var from = $(this).html();
            var to = todate.html();

            var arr1 = from.split(" ");
            var arr2 = to.split(" ");
            for(var i=arr2.length-1;i>=0;i--){
                if(arr2[i]===arr1[i]){
                   arr1 = arr1.slice(0,i);
                } else {
                    break;
                }
            }
            if(arr1.length==2){
               arr1 = arr1.slice(0,1);
            }

            $(this).html(arr1.join(" "));
        }
    });

    // Switch top menu based on scoll position
    if ($('body').is('.admin-menu')) {
      var adminHeight = 20;
    } else {
      var adminHeight = 0;
    }

    adminHeight = adminHeight + 140;

    $(window).scroll(function () {
        if ($(this).scrollTop() > adminHeight) {
            $('#header-large-inner').hide(200);
            $('#header-small-wrapper').show(200);
            $('#header-region-following').addClass('fixed-menu');
            $('#main-wrapper').addClass('fixed-menu-page');
        } else {
            $('#header-large-inner').show(200);
            $('#header-small-wrapper').hide(200);
            $('#header-region-following').removeClass('fixed-menu');
            $('#main-wrapper').removeClass('fixed-menu-page');
        }
    });
	
	/*-------------------------------------------------------
	Adaptación para el área de usuario en edicion de cuentas.
	DLTC 1-1-12
	--------------------------------------------------------*/
	if($('.header .tabs.primary').find('li:last').children('a').text()=="My account"||
		$('.header .tabs.primary').find('li:last').children('a').text()=="Mi cuenta"){
			$('.header .tabs.primary').find('li:last').addClass('account');	
		}
	
	if($('.area-social').length&&$('body[id^="pid-user"]').length&&!$('.account-edit').length&&$('body[id$="-projects"]').length){
		$('#sidebar-last').remove();
	}else if($('.area-social').length&&$('body[id^="pid-user"]').length&&!$('body[id$="-projects"]').length){
	$('.views-field-field-address-acp-value,.views-field-field-company-acp-value,.views-field-phpcode-1,.views-field-field-small-description-acp-value,.views-field-phpcode,.views-field-field-facebook-acp-url,.views-field-field-google-acp-url,.views-field-field-linkedin-acp-url,.views-field-field-pinterest-acp-url,.views-field-field-twitter-acp-url').remove()
	}
	$('#content-content .view-arqnetwork-projects .view-content .item-list ul li.views-row').find('img').attr('height','95')
	$('#main-content .view-user-directory .views-exposed-wrapper').find('.views-exposed-submit').appendTo('.views-exposed-widgets')
});