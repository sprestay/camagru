<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
                <script>
            navigator.getUserMedia(
    {
        video: true
    },
    function(stream){
       webcam.srcObject=stream;
        webcam.play();
    },
    function(err){
        console.error(err);
    }
);

function takeSnapshot(){
    var hidden_canvas = document.getElementById('canvas'),
        video = document.getElementById('webcam'),
        image = document.getElementById('photo'),

        // Получаем размер видео элемента.
        width = video.videoWidth,
        height = video.videoHeight,

        // Объект для работы с canvas.
        context = hidden_canvas.getContext('2d');

        hidden_canvas.width = width;
        hidden_canvas.height = height;

        // Отрисовка текущего кадра с video в canvas.
        context.drawImage(video, 0, 0, width, height);

        var imageDataURL = hidden_canvas.toDataURL();
        document.getElementById("push").value = imageDataURL;   
}
        </script>
        <form action="savePNG.php" method="POST">
            <div class="web">
                <video autoplay id="webcam"></video>
                <?php
                echo "<img src='$_GET[mask]' class='mask_style'>";
                ?>
                <input type="hidden" id="push" name="img"><br>
                <?php
                if ($_GET[mask])
                {
                    echo "<input type='image' name='picture' class='shoot' src='http://pngimg.com/uploads/instagram/instagram_PNG11.png' onclick='takeSnapshot()'>";
                    echo "<input type='hidden' id='mask_t' name='mask' value=" . $_GET[mask] . ">";
                }
                ?>
            </div>
        </form>
        <canvas id="canvas"></canvas>
    </body>
</html>