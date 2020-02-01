function like(){
    var src = event.target.src;
    var from = src.search('img');
    var to = src.length;
    src = src.substring(from,to);
    var login = event.target.getAttribute("id");
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == XMLHttpRequest.DONE ) {
         if (xmlhttp.status == 200 || xmlhttp.status == 201) {
           document.getElementById("alb_web").innerHTML = xmlhttp.responseText;
         }
         else
            alert('Shit happens');
      }
  }
  xmlhttp.open("POST", "delete.php", true);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.send("del=" + src + "&login=" + login);
}