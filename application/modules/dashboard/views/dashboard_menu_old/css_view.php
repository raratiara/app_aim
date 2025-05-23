<style type="text/css">
[class*="col-"] .chosen-container {
    width:98%!important;
}
[class*="col-"] .chosen-container .chosen-search input[type="text"] {
    padding:2px 4%!important;
    width:90%!important;
    margin:5px 2%;
}
[class*="col-"] .chosen-container .chosen-drop {
    width: 100%!important;
}

#refreshButton {
  position: absolute;
  top: 20px;
  right: 20px;
  padding: 10px;
  z-index: 400;
}


    .modal.left .modal-dialog,
    .modal.right .modal-dialog {
        position: fixed;
        margin: auto;
        width: 320px;
        height: 100%;
        -webkit-transform: translate3d(0%, 0, 0);
            -ms-transform: translate3d(0%, 0, 0);
             -o-transform: translate3d(0%, 0, 0);
                transform: translate3d(0%, 0, 0);
    }

    .modal.left .modal-content,
    .modal.right .modal-content {
        height: 100%;
        overflow-y: auto;
    }
    
    .modal.left .modal-body,
    .modal.right .modal-body {
        padding: 15px 15px 80px;
    }



        
/*Right*/
    .modal.right.fade .modal-dialog {
        right: -320px;
        -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
           -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
             -o-transition: opacity 0.3s linear, right 0.3s ease-out;
                transition: opacity 0.3s linear, right 0.3s ease-out;
    }
    .modal.right.fade.in .modal-dialog {
        right: 0;
    }

/* ----- MODAL STYLE ----- */
    .modal-content {
        border-radius: 0;
        border: none;
    }

    .modal-header {
        border-bottom-color: #EEEEEE;
        background-color: #FAFAFA;
    }

    .box {
      width: 300px;
      height: 150px;
      border: 2px solid #333;
      padding: 20px;
      background-color: #f9f9f9;
      box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
    }


     table, td {
        border: 1px solid black;
        border-collapse: collapse; /* Makes borders look clean */
        padding: 8px;
      }


      html, body {
      margin: 0;
      padding: 0;
      height: 100%;
      font-family: Arial, sans-serif;
    }

    #map {
      width: 100%;
      transition: height 0.3s ease;
    }

    .video-container {
      display: flex;
      justify-content: space-around;
      padding: 10px;
      background-color: #f0f0f0;
      margin-bottom: 20px;
      transition: all 0.3s ease;
    }

    video {
      width: 32%;
      border: 2px solid #ccc;
      border-radius: 8px;
    }

    .info-box {
      position: absolute;
      top: 10px;
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
      width: 100%;
      border-radius: 4px;
    }

    .info-box h4 {
      margin: 10px 0 5px;
    }

    .info-box p {
      margin: 0;
      font-size: 14px;
    }

    .toggle-button {
      position: absolute;
      bottom: 10px;
      left: 10px;
      z-index: 1000;
      background-color: white;
      border: 1px solid #444;
      padding: 8px 12px;
      border-radius: 5px;
      cursor: pointer;
      box-shadow: 0 2px 6px rgba(0,0,0,0.2);
      font-size: 14px;
    }




</style>