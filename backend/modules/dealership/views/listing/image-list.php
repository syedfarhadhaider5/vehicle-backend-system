<?php

use kartik\sortinput\SortableInput;
use kartik\sortable\Sortable;

$images = \common\models\Images::find()->where("vehicle_id='" . $id . "'")->orderBy("image_order")->all();
$items = [];
foreach ($images as $image) {
    $items[$image->id] = [
        'content' => '<div class="grid-item" ><img src="' . $image->image_path . '" class="car-img"  /><div class="statusToggle" style=" width: 100%; display: flex;  justify-content: space-around;">
    <div class="custom-control custom-switch  " >
        <input type="checkbox" class="custom-control-input banners" value="' . $image->is_banner . '" onchange="Banner(' . $image->id . ',this.value,this.id)" id="b' . $image->id . '"  >
        <label class="custom-control-label" for="b' . $image->id . '">
        </label>
    </div>
    <a href="javascript:void(0)" ><i class="fas fa-trash-alt  text-danger" onclick="Delete(' . $image->id . ')"></i> </a>
</div> </div>'
    ];
}
echo SortableInput::widget([
    'name' => 'sort_list_2',

    'items' => $items,
    'hideInput' => true,
    'options' => ['class' => 'form-control', 'readonly' => true]
]);
?>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $("#w0").on("change", function () {
            Sort();
        });
        $('#wfile').on('filebatchuploadcomplete', function (event, previewId, index, fileId) {
            setTimeout(location.reload.bind(location), 500);
        });
        checkbox();
    });

    function checkbox()
    {
        var chbox= document.getElementsByClassName("banners");
        for (var x = 0; x < chbox.length; x++)
        {
            if (chbox[x].value==1)
                chbox[x].checked = true;
            else
                chbox[x].checked = false;
        }
    }
    function Sort() {
        var array = $('#w0').val();
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function () {
            $(document).Toasts("Updated", {
                icon: "fas fa-exclamation-triangle",
                class: "bg-success m-5",
                autohide: true,
                delay: 5000,
                title: "Success",
                body: "Images Order Updated!"
            });
            //document.getElementById("image-list").innerHTML = this.responseText;
        }
        xmlhttp.open("GET", "<?php echo Yii::$app->urlManager->createUrl('dealership/listing/image-sort?id=' . $_GET['id']);?>&sort=" + array);
        xmlhttp.send();
    }

    function Delete(id) {
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function () {
            $(document).Toasts("Updated", {
                icon: "fas fa-exclamation-triangle",
                class: "bg-success m-5",
                autohide: true,
                delay: 5000,
                title: "Success",
                body: "Images Order Updated!"
            });
            setTimeout(location.reload.bind(location), 1000);
        }
        xmlhttp.open("GET", "<?php echo Yii::$app->urlManager->createUrl('dealership/listing/delete-image?id=' . $_GET['id']);?>&imgid=" + id);
        xmlhttp.send();
    }

    function Banner(id, value, banr) {

         var chkbox=document.getElementById(banr);
         if(chkbox.checked)
         {
             value=1;
         }
         else
         {
             value=0;
         }
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function () {
            $(document).Toasts("Updated", {
                icon: "fas fa-exclamation-triangle",
                class: "bg-success m-5",
                autohide: true,
                delay: 5000,
                title: "Success",
                body: "Images Banner Selected!"
            });
            $('.banners').prop('checked', false);
            $('.banners').val('0');
            $('#' + banr).val(value);
            checkbox();
            // if(value==1)
            // {
            //
            //      $('#' + banr).prop('checked', true);
            //      $('#' + banr).val('1');
            // }
            // else {
            //     $('#' + banr).prop('checked', false);
            //     $('#' + banr).val('0');
            // }


            //document.getElementById("image-list").innerHTML=this.responseText;
        }
        xmlhttp.open("GET", "<?php echo Yii::$app->urlManager->createUrl('dealership/listing/set-banner?vehicle=' . $_GET['id']);?>&id=" + id + "&value=" + value);
        xmlhttp.send();
    }
</script>