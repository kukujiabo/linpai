var xmlHttpRequest;
 
$(function(){
  
  if(window.XMLHttpRequest){
     
    xmlHttpRequest=new XMLHttpRequest();
     
  }else{
     
    xmlHttpRequest=new ActiveXObject("Microsoft.XMLHTTP");
     
  }
   
  xmlHttpRequest.open("GET","AjaxServlet",true);
  xmlHttpRequest.open("POST","AjaxServlet",true);

  if (typeof xmlHttpRequest == 'undefined') {
  
    alert('XMLHttpRequest 对象没有生成！');
  
  }
   
});
