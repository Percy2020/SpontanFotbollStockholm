<form method="post" action="create.php" enctype="multipart/form-data">
<div class="form-outline">
        <label class="form-label" for="message">Ladda upp</label>
        <input type="file" name="fileUpload" id="fileUpload" onchange="readURL(this);" >
        <img id="image1" src="#" alt="your image" class="img-fluid img-thumbnail" />
    </div>
    <div class="form-outline">
        <label class="form-label" for="message">Meddelande</label>
        <textarea class="form-control" id="message" name="message" rows="4"></textarea>
    </div>
    </br>
    <div class="form-group">
        <input class="btn btn-secondary btn-sm" type="submit" value="Publicera">
    </div>
    </br>
</form>
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                //$('#image1').attr('src', e.target.result);
                document.getElementById('image1').src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>