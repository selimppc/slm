<script>
    $('#i_submit').click( function() {
        //check whether browser fully supports all File API
        if (window.File && window.FileReader && window.FileList && window.Blob)
        {
            //get the file size and file type from file input field
            var attachmentSize = 0;
            var fsize = 0;

            if ( $('#attachment')[0].files[0] !== undefined ) {
                attachmentSize = $('#attachment')[0].files[0].size; //---- for Attachment File
                console.log('Att y');
            }else{
                console.log('Att N');
            }

            if ( $('#signature')[0].files[0] !== undefined ) {
                fsize = $('#signature')[0].files[0].size; // ---- for Signature File
                console.log('sign y');
            }else{
                console.log('Sign N');
            }


            if (fsize > 100000) //do something if file size more than 1 mb (1048576)
            {
                alert("Max image size is 100kb. Please check your image size.");
                return false;
            }


            if (attachmentSize > 300000)
            {
                alert("Max image size is 300kb. Please check your image size.");
                return false;
            }


        }else{
            alert("Please upgrade your browser, because your current browser lacks some new features we need!");
        }
    });
</script>