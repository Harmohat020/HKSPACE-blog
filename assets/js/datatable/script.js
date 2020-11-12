var head = document.getElementsByTagName('HEAD')[0];  
  
var link = document.createElement('link'); 
  
link.rel = 'stylesheet';  
link.type = 'text/css'; 
link.href = '../../assets/styles/users/overview/style.css';  

head.appendChild(link);  

$(document).ready(function() {
    $('#overview').DataTable( {
        "language": {
          "sInfo": "Showing _START_ to _END_ of _TOTAL_ records"
        }
    });
});
