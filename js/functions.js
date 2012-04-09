/*
 *
 * MUSHOQ JS AND JQUERY FUNCTIONS
 * 
 */

function loadPageAjax(form,destination,div){
      var param = $("#"+ form).serialize();
    
           
      $("#"+ div).html('<div  id="loading"><img src="/ERPScanFull/images/ajax-loader.gif"></div>');
      $.ajax({
      type: "POST",
      url: destination+'/format/html',
      data: param,
      success: function(newPage) {
       //alert(newPage);
       $("#"+ div).html(newPage)
      }
      });
}


function sendPage(form,destination,div){

 //alert(form);
 if(form != 'null'){
     var param = $("#"+ form).serialize();

     //serializar a objeto
     var campos = param.split("&");
     var data = "{";
     for (var i=0;i<campos.length;i++){
     temp = campos[i].split("=");
     data= data + temp[0]+': "'+temp[1]+'"';
     if(i<campos.length-1){
     data = data + ",";
     }
     }
     data = data + "}";
     //
     var parametros = eval("("+data+")");
 }else{
     var parametros = eval("({data: 0})");
 }
 $("#"+ div).addClass('msgInfo');
 $("#"+ div).html('<div  id="loading" style="margin:0 auto;"><img src="/ERPScanFull/images/ajax-loader.gif"></div>');
 $("#"+ div).removeClass('msgInfo');
 
 $("#"+ div).load(destination,parametros,function(){
 //alert('se supone que ya hice');
 });
}

function popUp(url,title,width,height){
    newWindow = window.open(url, title, "location=1,status=1,scrollbars=0,width="+width+",height="+height);
    newWindow.moveTo(0, 0);
}