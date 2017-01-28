<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>change demo</title>
  <style>
  div {
    color: red;
  }
  </style>
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body>
 
<select name="sweets">
  <option>Chocolate</option>
  <option>Candy</option>
  <option>Taffy</option>
  <option>Caramel</option>
  <option>Fudge</option>
  <option>Cookie</option>
</select>
<input id="ganti">
 
<script>
$( "select" )
  .change(function () {
    var str = "";
    $( "select option:selected" ).each(function() {
      str += $( this ).text() + " ";
    });
    $( "#ganti" ).val( str );
  })
  .change();
</script>
 
</body>
</html>