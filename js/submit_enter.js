			var elem = document.getElementById("add-new-task-input");
			elem.onkeyup = function(e){
			    if(e.keyCode == 13){
			       add_new_task();
			    }
			}