<?php include_once("header.php"); ?>
<?php include_once("navigator.php"); ?>



    <div class="container-fluid">
        <div class="row">
            <?php include_once("sidebar.php"); ?>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 class="page-header">Offer Completion Rate:</h1>

                <div id="showData"></div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function(){
            setInterval(function(){ // เขียนฟังก์ชัน javascript ให้ทำงานทุก ๆ 30 วินาที
                // 1 วินาที่ เท่า 1000
                // คำสั่งที่ต้องการให้ทำงาน ทุก ๆ 3 วินาที
                var getData=$.ajax({ // ใช้ ajax ด้วย jQuery ดึงข้อมูลจากฐานข้อมูล
                    url:"contact_history_feed.php",
                    data:"rev=1",
                    async:false,
                    success:function(getData){
                        $("div#showData").html(getData); // ส่วนที่ 3 นำข้อมูลมาแสดง
                    }
                }).responseText;
            },3000);
        });
    </script>
<?php include_once("footer.php"); ?>