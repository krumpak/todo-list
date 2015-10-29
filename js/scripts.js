function add_new_task(){
  auto_close();
  var new_task = "new="+document.getElementById("add-new-task-input").value;
  document.getElementById("add-new-task-input").value='';
  
  if( (new_task.length-4)<1 && (new_task.length-4)>100){
    document.getElementById("message").innerHTML='<div id="hide" class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" onclick="close_alert()"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>Task was not added!</strong> Task name is required and must be up to 100 characters long!</div>';
  } else {
    var xmlhttp;
    if (window.XMLHttpRequest)
      {// code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
      }
    else
      {// code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
    xmlhttp.onreadystatechange=function()
      {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            var response = JSON.parse(xmlhttp.responseText);
            var view ='';
            for (var obj in response){
              if( response[obj].status == '1'){
                view += '<li id="task' + response[obj].id + '">' + 
                  '<a class="check-task" href="#" onclick="uncheck_task(' + response[obj].id + ');" title="Uncheck task"><span class="glyphicon glyphicon-check"></span> ' + response[obj].task_name + ' </a> '+
                  '<a class="remove-task" href="#" onclick="remove_task(' + response[obj].id + ');" title="Remove task"><small><span class="glyphicon glyphicon-remove-circle"></span></small></a>' +
                  '</li>';
                } else {
                view += '<li id="task' + response[obj].id + '">' + 
                  '<a class="check-task" href="#" onclick="check_task(' + response[obj].id + ');" title="Check task"><span class="glyphicon glyphicon-unchecked"></span> ' + response[obj].task_name + ' </a> '+
                  '<a class="remove-task" href="#" onclick="remove_task(' + response[obj].id + ');" title="Remove task"><small><span class="glyphicon glyphicon-remove-circle"></span></small></a>' +
                  '</li>';
                }
          }
          document.getElementById("tasks").innerHTML=view;
          document.getElementById("message").innerHTML='<div id="hide" class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" onclick="close_alert()"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>Task successfully added!</div>';
        }
      }
    xmlhttp.open("POST","add_new",true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.setRequestHeader("Content-length", new_task.length);
    xmlhttp.setRequestHeader("Connection", "close");
    xmlhttp.send(new_task);
  }
}

function check_task(id){
  var check_task = "check_task="+id;
  var task = "task="+id;

  var xmlhttp;
  if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
    }
  else
    {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
  xmlhttp.onreadystatechange=function()
    {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {
          var response = JSON.parse(xmlhttp.responseText);
          var view ='<a class="check-task" href="#" onclick="uncheck_task(' + id + ');" title="Uncheck task"><span class="glyphicon glyphicon-check"></span> ' + response.task_name + ' </a> '+
                '<a class="remove-task" href="#" onclick="remove_task(' + id + ');" title="Remove task"><small><span class="glyphicon glyphicon-remove-circle"></span></small></a>';
        document.getElementById("task"+id).innerHTML=view;
      }
    }
  xmlhttp.open("POST","check_task",true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.setRequestHeader("Content-length", check_task.length);
  xmlhttp.setRequestHeader("Connection", "close");
  xmlhttp.send(check_task);
}

function uncheck_task(id){
  var uncheck_task = "uncheck_task="+id;
  var task = "task="+id;

  var xmlhttp;
  if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
    }
  else
    {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
  xmlhttp.onreadystatechange=function()
    {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {
          var response = JSON.parse(xmlhttp.responseText);

          var view ='<a class="check-task" href="#" onclick="check_task(' + id + ');" title="Check task"><span class="glyphicon glyphicon-unchecked"></span> ' + response.task_name + ' </a> '+
                '<a class="remove-task" href="#" onclick="remove_task(' + id + ');" title="Remove task"><small><span class="glyphicon glyphicon-remove-circle"></span></small></a>';
        document.getElementById("task"+id).innerHTML=view;
      }
    }
  xmlhttp.open("POST","uncheck_task",true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.setRequestHeader("Content-length", check_task.length);
  xmlhttp.setRequestHeader("Connection", "close");
  xmlhttp.send(uncheck_task);
}

function remove_task(id){
  auto_close();
  var request = "remove_task="+id;
  var taskid = "task"+id;

  var xmlhttp;
  if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
    }
  else
    {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
  xmlhttp.onreadystatechange=function()
    {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {
        document.getElementById(taskid).innerHTML="";//xmlhttp.responseText;
        document.getElementById("message").innerHTML='<div id="hide" class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" onclick="close_alert()"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>Task successfully deleted!</div>';
      }
    }
  xmlhttp.open("POST","remove_task",true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.setRequestHeader("Content-length", request.length);
  xmlhttp.setRequestHeader("Connection", "close");
  xmlhttp.send(request);
}

function close_alert(){
  document.getElementById("hide").style.opacity = 0.99;
  var fade = function() {
    document.getElementById("hide").style.opacity = document.getElementById("hide").style.opacity - 0.018;
    if (document.getElementById("hide").style.opacity >= 0) {
      (window.requestAnimationFrame && requestAnimationFrame(fade)) || setTimeout(fade, 10)
    } 
  if (document.getElementById("hide").style.opacity<=0) { document.getElementById("hide").style.display = 'none'; return; }
  };
  fade();
}

function auto_close(){
  delay=setTimeout(function() { close_alert(); }, 5000);
  setTimeout(function() { clearTimeout(delay); }, 5000);
  
}