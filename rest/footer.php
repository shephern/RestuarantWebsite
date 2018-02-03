<footer align="middle" class="border">
    <ul>
            <li><?php echo 'Updated ' . date('F j, Y',filemtime($_SERVER['SCRIPT_FILENAME'])) ?></li>
            <li>&copy; 2015-<?php echo date('Y').' '.$author; ?></li>
        </ul>
</footer>

</main>
<!-- scripts go here -->
<script src="http://web.engr.oregonstate.edu/~shephern/rest/scripts/jquery-1.12.1.js"></script>
<script src="http://web.engr.oregonstate.edu/~shephern/rest/scripts/Magnific-Popup/magPopup.min.js"></script>
<script src="http://web.engr.oregonstate.edu/~shephern/rest/scripts/sorttable.js"></script>
<script src="http://web.engr.oregonstate.edu/~shephern/rest/scripts/loadMore.js"></script>
<script src="http://web.engr.oregonstate.edu/~shephern/rest/scripts/commVote.js"></script>
<script src="http://web.engr.oregonstate.edu/~shephern/rest/scripts/commentAjax.js"></script>
<script src="http://web.engr.oregonstate.edu/~shephern/rest/scripts/mapPopup.js"></script>
<script src="http://web.engr.oregonstate.edu/~shephern/rest/scripts/getUserGeo.js"></script>
<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>

</body>
</html>