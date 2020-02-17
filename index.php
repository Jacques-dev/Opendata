


<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link href="https://fonts.googleapis.com/css?family=Exo+2&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="Style.css"/>
    <link rel="stylesheet" type="text/css" href="Nav.css"/>
    <link rel="stylesheet" type="text/css" href="Menu.css"/>
    <link rel="stylesheet" type="text/css" href="SearchBox.css"/>
    <link rel="stylesheet" type="text/css" href="Filters.css"/>

    <script type="text/javascript" src="js/jquery.js"></script>

    <title>Make Your Life Plans</title>
  </head>

  <body>
    
    <nav>
      <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="#">About</a>
        <a href="#">Services</a>
        <a href="#">Clients</a>
        <a href="#">Contact</a>
      </div>

      <span id="burger" onclick="openNav()">&#9776;</span>
      
      <h id="navTitle">MYLP</h>
      
      <div class="container">
        <input type="text" placeholder="Search...">
        <div class="search"></div>
      </div>
    </nav>  
  
    <main>
      <filters>
        <div class="dropdown">
          <button class="dropbtn">Dropdown</button>
          <div class="dropdown-content">
            <a href="#">Link 1</a>
            <a href="#">Link 2</a>
            <a href="#">Link 3</a>
          </div>
        </div>
        
        <div class="dropdown">
          <button class="dropbtn">Dropdown</button>
          <div class="dropdown-content">
            <a href="#">Link 1</a>
            <a href="#">Link 2</a>
            <a href="#">Link 3</a>
          </div>
        </div>
        
        <div class="dropdown">
          <button class="dropbtn">Dropdown</button>
          <div class="dropdown-content">
            <a href="#">Link 1</a>
            <a href="#">Link 2</a>
            <a href="#">Link 3</a>
          </div>
        </div>
      </filters>
      
      <results>
        <div>
          <map>

          </map>

          <list>

          </list>
        </div>
      </results>
      
      <info>
        
      </info>
      
    </main>
  </body>
  
  <script>
    function openNav() {
      document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
    }
  </script>
  
</html>
