<html>
<head>
<title>Print Test Page</title>
<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
</head>
<body>
<div id="printableArea">
      <h1>Print me</h1>
</div>

<input type="button" onclick="printDiv('printableArea')" value="print a div!" />
</body>
</html>