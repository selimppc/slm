<script>
    $('#i_submit').click( function() {
        //check whether browser fully supports all File API
        if (window.File && window.FileReader && window.FileList && window.Blob)
        {
            //get the file size and file type from file input field
            var fsize = $('#signature')[0].files[0].size;

            if(fsize>100000) //do something if file size more than 1 mb (1048576)
            {
//                alert(fsize +" bites\nToo big!");
                alert("Max image size is 100kb. Please check your image size.");
                return false;
            }
        }else{
            alert("Please upgrade your browser, because your current browser lacks some new features we need!");
        }
    });
</script>