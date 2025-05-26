
<!DOCTYPE html>
<html>
<head>
  <title>Dashboard AIM</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <style>
    html, body {
      margin: 0; padding: 0; height: 100%; font-family: Arial, sans-serif;
      background-color: #1f2d3d; overflow: hidden;
    }

    /* Container logo + toggle sidebar di kiri atas */
    .top-left-bar {
      position: fixed;
      top: 10px;
      left: 10px;
      display: flex;
      align-items: center;
      gap: 10px;
      z-index: 1300;
    }

    .top-left-bar img.logo {
      width: 140px;
      height: auto;
      cursor: pointer;
      user-select: none;
    }

    .sidebar-toggle {
      width: 36px;
      height: 36px;
      background-color: #34495e;
      color: #ecf0f1;
      border-radius: 4px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      font-size: 18px;
      box-shadow: 0 0 8px rgba(0,0,0,0.3);
      transition: background-color 0.2s;
      user-select: none;
    }
    .sidebar-toggle:hover {
      background-color: #3b5998;
    }

    /* Sidebar */
    .sidebar {
      position: absolute;
      top: 60px;
      left: 50px;
      width: 250px;
      height: calc(100vh - 60px);
      background-color: rgba(44, 62, 80, 0.95);
      display: flex;
      flex-direction: column;
      padding-top: 0;
      z-index: 1100;
      box-sizing: border-box;
      transition: transform 0.3s ease;
      backdrop-filter: saturate(180%) blur(10px);
      border-top-left-radius: 8px;
      border-bottom-left-radius: 8px;
      box-shadow: 2px 0 8px rgba(0,0,0,0.5);
    }

    .sidebar.hidden {
      transform: translateX(-300px);
    }

    /* Hapus logo dalam sidebar */
    /* .sidebar-logo {
      display: none;
    } */

    .menu-item {
      padding: 12px 20px;
      cursor: pointer;
      transition: background-color 0.2s;
      color: #cfd8dc;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .menu-item:hover {
      background-color: #34495e;
    }

    .expandable::after {
      content: '\f0da';
      font-family: 'Font Awesome 6 Free';
      font-weight: 900;
      margin-left: auto;
      transition: transform 0.2s;
    }

    .active::after {
      transform: rotate(90deg);
    }

    .submenu {
      background-color: #32475b;
      display: none;
      flex-direction: column;
      padding-left: 30px;
    }

    .submenu a {
      color: #bdc3c7;
      padding: 8px 0;
      text-decoration: none;
      font-size: 14px;
    }

    .submenu a:hover {
      text-decoration: underline;
    }

    .top-bar {
      position: fixed;
      top: 10px;
      right: 10px;
      left: 56px;
      display: flex;
      align-items: center;
      justify-content: flex-end;
      z-index: 1200;
      gap: 10px;
    }

    .search-box {
      padding: 6px 10px;
      border-radius: 4px;
      border: none;
      font-size: 14px;
      width: 200px;
    }

    .user-dropdown {
      position: relative;
      background-color: #34495e;
      border-radius: 8px;
      padding: 6px 10px;
      color: white;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .user-dropdown img {
      width: 24px;
      height: 24px;
      border-radius: 50%;
      object-fit: cover;
    }

    .dropdown-menu {
      display: none;
      position: absolute;
      top: 40px;
      right: 0;
      background-color: #2c3e50;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      border-radius: 4px;
      overflow: hidden;
      z-index: 1200;
      min-width: 140px;
    }

    .dropdown-menu a {
      display: block;
      padding: 10px 16px;
      color: white;
      text-decoration: none;
    }

    .dropdown-menu a:hover {
      background-color: #1f2d3d;
    }

    .info-box {
      position: fixed;
      top: 70px;
      right: 10px;
      background: white;
      padding: 10px;
      border: 2px solid #444;
      border-radius: 8px;
      z-index: 1000;
      width: 220px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.3);
    }

    .info-box img {
      width: 20%;
      border-radius: 4px;
    }

    .info-box h4 { margin: 10px 0 5px; }
    .info-box p { margin: 0; font-size: 14px; }

    #map {
      position: absolute;
      top: 60px;
      left: 0;
      right: 0;
      bottom: 0px;
      z-index: 1;
    }

    .video-container {
      position: fixed;
      bottom: 10px;
      left: 310px;
      right: 10px;
      display: flex;
      justify-content: space-around;
      background-color: #f0f0f0;
      padding: 5px 10px;
      box-sizing: border-box;
      border-radius: 8px;
      box-shadow: 0 0 6px rgba(0,0,0,0.15);
      z-index: 1000;
      transition: left 0.3s ease;
    }

    .video-container.collapsed {
      left: 10px;
    }

    .video-container.hidden {
      display: none !important;
    }

    video {
      width: 32%;
      border: 2px solid #ccc;
      border-radius: 8px;
      object-fit: cover;
    }

    .video-toggle {
      position: fixed;
      bottom: 10px;
      right: 10px;
      width: 36px;
      height: 36px;
      background-color: #34495e;
      color: #ecf0f1;
      border-radius: 4px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      z-index: 1300;
      font-size: 18px;
      box-shadow: 0 0 8px rgba(0,0,0,0.3);
      transition: background-color 0.2s;
    }
    .video-toggle:hover {
      background-color: #3b5998;
    }
  </style>
</head>
<body>

<!-- Logo + Toggle sidebar di kiri atas -->
<div class="top-left-bar">
  <img src="https://aim.sandboxxplore.com/public/assets/images/logo/nbid_new_logo_inside.png" alt="NBID Logo" class="logo" />
  <div class="sidebar-toggle" onclick="toggleSidebar()" title="Toggle Menu">
    <i class="fas fa-bars"></i>
  </div>
</div>

<!-- Sidebar tanpa logo -->
<div class="sidebar" id="sidebar">
  <div class="menu-item" onclick="window.location.href='https://aim.sandboxxplore.com/dashmaps.php'">Dashboard</div>
  <!-- <div class="menu-item" onclick="window.location.href='https://aim.sandboxxplore.com/cctv_surveilance/cctv_surveilance_menu'">CCTV Surveillance</div> -->
  <div class="menu-item" onclick="window.location.href='https://aim.sandboxxplore.com/job_order/job_order_menu'">Job Order</div>
  <div class="menu-item" onclick="window.location.href='https://aim.sandboxxplore.com/job_order/job_order_summary_menu'">Order Summary</div>
  <div class="menu-item" onclick="window.location.href='https://aim.sandboxxplore.com/job_order/job_order_detail_menu'">Order Detail</div>
  <!-- <div class="menu-item expandable" onclick="toggleSubmenu(this)">
    <i class="fas fa-table"></i> Master Data
  </div>
  <div class="submenu">
    <a href="http://localhost/_aim/master/master_mother_vessel_menu">Mother Vessel</a>
    <a href="http://localhost/_aim/master/master_floating_crane_menu">Floating Crane</a>
    <a href="http://localhost/_aim/master/master_cctv_menu">CCTV</a>
    <a href="http://localhost/_aim/master/master_activity_menu">Activity</a>
  </div>
  <div class="menu-item">General System</div> -->
</div>

<div class="video-toggle" onclick="toggleVideos()" title="Toggle Videos">
  <i class="fas fa-video"></i>
</div>

<div class="top-bar">
  <!-- <input class="search-box" type="text" placeholder="Search..." /> -->
  <div class="user-dropdown" id="userDropdown">
    <!-- <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User" /> -->
    <i class="fas fa-user-circle"></i> Admin
    <div class="dropdown-menu">
      <a href="https://aim.sandboxxplore.com/reset_password" id="profileLink"><i class="fas fa-user"></i> Reset Password</a>
      <a href="https://aim.sandboxxplore.com/login/logout" id="logoutLink"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
  </div>
</div>

<div class="info-box" id="infoBox">
  <!-- <img src="https://via.placeholder.com/200x100?text=CCTV+1" alt="CCTV Location" /> -->
  <img src="https://aim.sandboxxplore.com/public/assets/images/crane.png" alt="CCTV Location" />
  <h4>FC Avant Grade</h4>
  <p>Live View: cctv FC Avant Grade</p>
  <button type="button" class="btn btn-primary" onclick="getDetailnew()">Dashboard</button>
  
</div>

<div id="map"></div>

<div class="video-container" id="videoContainer">
  <video id="video1" controls muted></video>
  <video id="video2" controls muted></video>
  <video id="video3" controls muted></video>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
<script>
  // Initialize Map
  //var map = L.map('map').setView([-6.1754, 106.8272], 13);
  /*var map = L.map('map').setView([-3.6921028591350216, 114.46377489871408], 13);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
  }).addTo(map);*/


  var map = L.map('map').setView([-3.6921028591350216, 114.46377489871408], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '© OpenStreetMap contributors'
    }).addTo(map);
    L.marker([-3.6921028591350216, 114.46377489871408]).addTo(map)
      .bindPopup("<b>CCTV FC Avant Grade</b><br>Live monitoring area.")
      .openPopup();


  // Sidebar submenu toggle
  function toggleSubmenu(elem) {
    elem.classList.toggle('active');
    var submenu = elem.nextElementSibling;
    if (submenu.style.display === 'flex') {
      submenu.style.display = 'none';
    } else {
      submenu.style.display = 'flex';
    }
  }

  // Sidebar toggle
  function toggleSidebar() {
    var sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('hidden');

    // Adjust video container position based on sidebar visibility
    var videoContainer = document.getElementById('videoContainer');
    if (sidebar.classList.contains('hidden')) {
      videoContainer.style.left = '10px';
    } else {
      videoContainer.style.left = '310px';
    }
  }

  // Video toggle (show/hide video container)
  function toggleVideos() {
    var container = document.getElementById('videoContainer');
    if (container.classList.contains('hidden')) {
      container.classList.remove('hidden');
    } else {
      container.classList.add('hidden');
    }
  }

  // User dropdown toggle
  document.getElementById('userDropdown').addEventListener('click', function() {
    var menu = this.querySelector('.dropdown-menu');
    menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
  });

  // Close dropdown if clicked outside
  window.addEventListener('click', function(e) {
    var userDropdown = document.getElementById('userDropdown');
    if (!userDropdown.contains(e.target)) {
      userDropdown.querySelector('.dropdown-menu').style.display = 'none';
    }
  });

  // Video streaming URLs
  const videoSources = [
    'https://streamingcctv.gerbangdata.co.id/hls/demo-fc-0.m3u8',
    'https://streamingcctv.gerbangdata.co.id/hls/demo-fc-1.m3u8',
    'https://streamingcctv.gerbangdata.co.id/hls/demo-fc-2.m3u8'
  ];

  function setupHLS(videoElement, url) {
    if (Hls.isSupported()) {
      var hls = new Hls();
      hls.loadSource(url);
      hls.attachMedia(videoElement);
      hls.on(Hls.Events.MANIFEST_PARSED, function() {
        videoElement.play();
      });
    } else if (videoElement.canPlayType('application/vnd.apple.mpegurl')) {
      videoElement.src = url;
      videoElement.addEventListener('loadedmetadata', function() {
        videoElement.play();
      });
    }
  }

  // Initialize videos with HLS streams
  document.addEventListener('DOMContentLoaded', () => {
    for (let i = 0; i < 3; i++) {
      let video = document.getElementById('video' + (i+1));
      setupHLS(video, videoSources[i]);
    }
  });
</script>

</body>
</html>




<script type="text/javascript">


function getDetailnew(){ 
  //var idfc = $("#hdnfloating_crane").val();
  var idfc = 1;

  if(idfc == ''){
      alert("Choose Floating Crane");
  }else{
    var getUrl = window.location;
    var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

    //alert(getUrl);
    /*$('span.title_maps').html(loc);
    $('#modal-detail').modal('show');*/

    var link = document.createElement("a")
      //link.href = ''+baseUrl+'/dashboard/dashboard_detail_menu?id='+idfc+'&orderid=0'
      link.href = 'https://aim.sandboxxplore.com/dashboard/dashboard_detail_menu?id='+idfc+'&orderid=0'
      link.target = "_blank"
      link.click()
  } 
  
  
}



function tes(){
  alert('mmm');
}


</script>

