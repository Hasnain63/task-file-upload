<html>

<head>
    <title>File Uploding</title>
    <link rel="stylesheet" type="text/css" href="style.css" />

    <script src="js/TimeStructure.js"></script>
    <script src="js/SizeStructure.js"></script>
    <script>
    var xhr, hUploadSpeed;

    function sendFile() {
        document.getElementById("serverresponse").innerHTML = ""; //clear previous server response

        var url = "upload.php";
        var formData = new FormData(document.getElementById("form1"));
        xhr = new XMLHttpRequest();

        xhr.upload.addEventListener('progress', uploadProgress, false);
        xhr.addEventListener('abort', uploadAbort, false);
        xhr.addEventListener('error', uploadError, false);
        xhr.addEventListener('load', uploadThrough, false);

        xhr.open("POST", url, true);

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("serverresponse").innerHTML = xhr.responseText;
            }
        }

        xhr.send(formData); //Send to server
        hUploadSpeed = setInterval(UploadSpeed, 1000); //per seconds
    }
    var i = new TimeStructure(); //creating a TimeStructure object
    var j = new SizeStructure(); //creating a SizeStructure object
    var uploaded = 0,
        prevUpload = 0,
        speed = 0,
        total = 0,
        remainingBytes = 0,
        timeRemaining = 0;

    function uploadProgress(e) {
        if (e.lengthComputable) {
            uploaded = e.loaded;
            total = e.total;
            //percentage
            var percentage = Math.round((e.loaded / e.total) * 100);
            document.getElementById('progress_percentage').innerHTML = percentage + '%';
            document.getElementById('progress').style.width = percentage + '%';

            document.getElementById("remainingbyte").innerHTML = j.BytesToStructuredString(e.total - e
                .loaded); //remaining bytes
            document.getElementById('uploadedbyte').innerHTML = j.BytesToStructuredString(e.loaded); //uploaded bytes
            document.getElementById('totalbyte').innerHTML = j.BytesToStructuredString(e.total); //total bytes
        }
    }

    function uploadAbort() {
        document.getElementById('progress_percentage').innerHTML = '0%';
        document.getElementById('progress').style.width = '0px';
        document.getElementById("serverresponse").innerHTML = "Upload canceled";
        xhr = null;
    }

    function uploadError() {
        document.getElementById('progress_percentage').innerHTML = '0%';
        document.getElementById('progress').style.width = '0px';
        document.getElementById("serverresponse").innerHTML = "An error occured.";
        clearInterval(hUploadSpeed);
        xhr = null;
    }

    function uploadThrough() {
        document.getElementById('progress_percentage').innerHTML = 'Upload completed!';
        UploadSpeed(); //flush
        clearInterval(hUploadSpeed);
        xhr = null;
    }

    function UploadSpeed() {
        //speed
        speed = uploaded - prevUpload;
        prevUpload = uploaded;
        document.getElementById("speed").innerHTML = j.SpeedToStructuredString(speed);
        //Calculating ETR
        remainingBytes = total - uploaded;
        timeRemaining = remainingBytes / speed;
        document.getElementById("ETR").innerHTML = i.SecondsToStructuredString(timeRemaining);
    }
    </script>
</head>

<body>
    <header>
        <h1>File Upload</h1>
    </header>
    <a id="showbutton" href="show_file.php">See All Files</a>
    <div class="container">
        <div class="row">

            <div class="col-md-6">

                <form id="form1" name="form1" enctype="multipart/form-data">

                    <input type="file" id="file1" name="file1">
                    <input type="button" id="showbutton" value="Upload" onclick="sendFile();" />
                </form>
            </div>
        </div>
        <div id="progress" style="margin: 10px 5px;"></div><br><br>

        <table border=1 width="100%">
            <tr>
                <td style="width:250px;">Percentage Completed:</td>
                <td><span id="progress_percentage">0%</span></td>
            </tr>
            <tr>
                <td>Speed:</td>
                <td><span id="speed">0 b/s</span></td>
            </tr>
            <tr>
                <td>Server response:</td>
                <td><span id="serverresponse"></span></td>
            </tr>
        </table>
    </div>
</body>

</html>