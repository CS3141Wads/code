<!DOCTYPE html>
<html>
  <head>

  </head>

  <body>
    <!-- Tab links -->
    <div class="tab">
      <button class="tablinks" onclick="openCity(event, 'London')">Players</button>
      <button class="tablinks" onclick="openCity(event, 'Paris')">Goalies</button>
    </div>

    <!-- Tab content -->
    <div id="London" class="tabcontent">
      <h3>Players</h3>
      <p>These are the players.</p>
    </div>

    <div id="Paris" class="tabcontent">
      <h3>Goalies</h3>
      <p>These are the goalies.</p>
    </div>
  </body>

  <style>
    /* Style the tab */
    .tab {
     overflow: hidden;
     border: 1px solid #ccc;
     background-color: #f1f1f1;
    }

    /* Style the buttons that are used to open the tab content */
    .tab button {
     background-color: inherit;
     float: left;
     border: none;
     outline: none;
     cursor: pointer;
     padding: 14px 16px;
     transition: 0.3s;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
     background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab button.active {
     background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
     display: none;
     padding: 6px 12px;
     border: 1px solid #ccc;
     border-top: none;
    }
  </style>

  <script>
    function openCity(evt, cityName) {
      // Declare all variables
      var i, tabcontent, tablinks;

      // Get all elements with class="tabcontent" and hide them
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
          tabcontent[i].style.display = "none";
      }

      // Get all elements with class="tablinks" and remove the class "active"
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
          tablinks[i].className = tablinks[i].className.replace(" active", "");
      }

      // Show the current tab, and add an "active" class to the button that opened the tab
      document.getElementById(cityName).style.display = "block";
      evt.currentTarget.className += " active";
    }
  </script>
</html>
