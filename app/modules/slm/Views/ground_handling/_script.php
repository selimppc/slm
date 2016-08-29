<script>
    $('#i_submit').click( function() {
        //check whether browser fully supports all File API
        if (window.File && window.FileReader && window.FileList && window.Blob)
        {
            //get the file size and file type from file input field
            /*if( document.getElementById("attachment").files.length == 0 ){
             alert("no files selected");
             return false;
             }*/

            var attachmentSize = 0;
            if ( $('#attachment')[0].files[0] !== undefined ) {
                attachmentSize = $('#attachment')[0].files[0].size; //---- for Attachment File
                console.log('yes');
            }else{
                console.log('No');
            }

            //var attachmentSize = $('#attachment')[0].files[0].size; //---- for Attachment File
            if(attachmentSize>300000)
            {
                alert("Max image size is 300kb. Please check your image size.");
                return false;
            }

        }else{
            alert("Please upgrade your browser, because your current browser lacks some new features we need!");
        }
    });
</script>